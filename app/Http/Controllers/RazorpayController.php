<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Razorpay\Api\Api;
use Redirect, Response;
use App\Models\CorporateOrder;
use Illuminate\Support\Facades\Mail;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\State;
use App\Models\Ledger;
use App\Models\Customer;
use App\Models\ProductAttributes;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\MemberOrder;
use App\Models\Plan;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;


class RazorpayController extends Controller
{
    public function index($id)
    {

        $Order = CorporateOrder::where("Corporate_Order_id", $id)->where(['iStatus' => 1, 'isDelete' => 0])->first();

        $price = $Order->NetAmount;

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        //dd(config('services.razorpay.secret'));
        $OrderAmount = $price * 100;
        $orderData = [
            'receipt'         => $id . '-' . date('dmYHis'),
            'amount'          => $OrderAmount,
            'currency'        => 'INR',
        ];

        $razorpayOrder = $api->order->create($orderData);
        $orderId = $razorpayOrder['id'];
        $data = array(
            'order_id' => $orderId,
            'oid' => $id,
            'amount' => $price,
            'currency' => 'INR',
            'receipt' => $razorpayOrder['receipt'],
        );

        Payment::insert($data);
        // dd($Order); frontview.dataFrom
        return view('razorpay', compact('Order', 'orderId'));
    }

    public function razorPaySuccess(Request $request)
    {
        try {

            $orderId = $request->orderId;

            $CorporateOrder = CorporateOrder::where("Corporate_Order_id", $request->orderid)->first();

            $planid = $CorporateOrder->iPlanId;
            $ExtraMember = $CorporateOrder->iExtraMember;

            $plan = Plan::where('id', $planid)->first();
            $walletbal = $plan->wallet_balance ?? 0;
            $Extra_amount_per_person_in_wallet = $plan->extra_amount_per_person_in_wallet;

            $calculate_extra_amountin_wallet = $Extra_amount_per_person_in_wallet * $ExtraMember;
            $openingclosing = $walletbal + $calculate_extra_amountin_wallet;

            DB::table('ledger')->insert([
                'order_id' => $request->orderid,
                'openingBalance' => $openingclosing,
                'cr' => 0,
                'dr' => 0,
                'closingBalance' => $openingclosing,
                'created_at' => now(),
            ]);

            $data = [

                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'razorpay_order_id' => $request->razorpay_order_id,

            ];
            Payment::where('order_id', $orderId)->update($data);

            $stringdata = $orderId . '|' . $request->razorpay_payment_id;

            $generated_signature = hash_hmac('sha256', $stringdata, config('services.razorpay.secret'));

            $razorpay_signature = $request->razorpay_signature;

            if ($generated_signature == $razorpay_signature) {
                $updateData = Payment::where('order_id', $orderId)->update([
                    'status' => 'Success',
                    'iPaymentType' => 1,
                    "Remarks" => "Online Payment"
                ]);
                if ($updateData) {
                    $updateProfileData = array(
                        'isPayment' => 1
                    );
                    CorporateOrder::where("Corporate_Order_id", $request->orderid)->update($updateProfileData);
                }

                $existingMember = Member::where('mobile', $CorporateOrder->mobile)->first();


                if ($existingMember) {
                    DB::rollBack();
                    Toastr::error('Member with this mobile number already exists. No email sent.', 'Error');
                    //return redirect()->back()->withInput();
                }

                // dd($existingMember);
               // $password = Str::password(12);
                $password = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $hashedPassword = Hash::make($password);
                $Member = Member::create([
                    'name' => $CorporateOrder->Name,
                    'email' => $CorporateOrder->email,
                    'mobile' => $CorporateOrder->mobile,
                    'state' => $CorporateOrder->state ?? 0,
                    'city' => $CorporateOrder->city ?? 0,
                    'address' => $CorporateOrder->address ?? 0,
                    'pincode' => $CorporateOrder->pincode ?? 0,
                    'Order_id' => $CorporateOrder->Corporate_Order_id,
                    'password' => $hashedPassword,

                ]);

                $Memberorder = MemberOrder::create([
                    'Member_id' => $Member->id,
                    'Order_id' => $CorporateOrder->Corporate_Order_id,
                ]);
                $CorporateOrder->update(['memberid' => $Member->id]);

                // Send email only if the mobile number is new
                $sendEmailDetails = DB::table('sendemaildetails')->where(['id' => 9])->first();

                $msg = [
                    'FromMail' => $sendEmailDetails->strFromMail,
                    'Title' => $sendEmailDetails->strTitle,
                    'ToEmail' => $CorporateOrder->email,
                    'Subject' => $sendEmailDetails->strSubject,
                ];


                $data = [
                    'Mobile' => $CorporateOrder->mobile,
                    'iExtraMember' => $CorporateOrder->iExtraMember,
                    'iamountExtraMember' => $CorporateOrder->iamountExtraMember,
                    'contact_person' => $CorporateOrder->Name ?? '',
                    "Password" => $password,
                    'plan_name' => $plan->name ?? '',
                    'plan_amount' => $plan->amount ?? 0,
                    'plan_no_of_members' => $plan->no_of_members ?? 0,
                    'start_date' => date('d-m-Y', strtotime($CorporateOrder->start_date)) ?? '',
                    'end_date' => date('d-m-Y', strtotime($CorporateOrder->end_date)) ?? '',
                    'app_link' => 'https://play.google.com/store/apps/details?id=com.apollo.medical_boons',
                ];


                Mail::send('emails.Memberemail', ['data' => $data], function ($message) use ($msg) {
                    $message->from($msg['FromMail'], $msg['Title']);
                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                });
                $ORDER_ID = $request->orderid;

                return $ORDER_ID;
            } else {
                $updateData = Payment::where('oid', $orderId)->update(['status' => 'Fail']);
                return 0;
                // $arr = array('msg' => 'Payment Faild', 'status' => false);
                // return Response()->json($arr);
            }
        } catch (\Throwable $e) {
            Log::error('RazorPay Payment Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            // Optionally show a friendly error
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong while processing your payment.'
            ], 500);
        }
    }

    public function RazorThankYou(Request $request, $id)
    {
        // return view('thankyouPage');
        //$Order = CorporateOrder::where("Corporate_Order_id", $id)->first();
        return view('thankyouPage');
    }

    public function RazorFail($orderid = null)
    {
        if ($orderid) {
            // Update isPayment in orders table
            CorporateOrder::where('Corporate_Order_id', $orderid)->update(['isPayment' => 0]);

            // Optionally update payment status
            Payment::where('order_id', $orderid)->update(['status' => 'Failed']);
        }
        return view('paymentFail');
    }
}
