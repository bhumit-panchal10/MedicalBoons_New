<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Plan;
use App\Models\MemberOrder;
use App\Models\CorporateOrder;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class RetailCustomerController extends Controller
{
    public function index()
    {
        $members = Member::leftJoin('Corporate_Order', 'members.Order_id', '=', 'Corporate_Order.Corporate_Order_id')
            ->leftJoin('plans', 'Corporate_Order.iPlanId', '=', 'plans.id')
            ->select(
                'members.*',
                'Corporate_Order.Corporate_Order_id',
                'Corporate_Order.iPlanId',
                'Corporate_Order.start_date',
                'Corporate_Order.end_date',
                'Corporate_Order.NetAmount',
                'Corporate_Order.iExtraMember',
                'plans.name as plan_name'
            )
            ->where('Corporate_Order.admin_member_add', 1)
            ->orderBy('members.id', 'desc')
            ->paginate(10);

        return view('RetailCustomer.index', compact('members'));
    }

    public function add()
    {
        $plans = Plan::where('iStatus', 1)->get();

        return view('RetailCustomer.create', compact('plans'));
    }

    public function edit($id)
    {
        $member = Member::leftJoin('Corporate_Order', 'members.Order_id', '=', 'Corporate_Order.Corporate_Order_id')
            ->select(
                'members.*',
                'Corporate_Order.Corporate_Order_id',
                'Corporate_Order.iPlanId',
                'Corporate_Order.iExtraMember',
                'Corporate_Order.start_date',
                'Corporate_Order.end_date',
                'Corporate_Order.NetAmount'
            )
            ->where('members.id', $id)
            ->firstOrFail();

        $plans = Plan::where('iStatus', 1)->get();

        return view('RetailCustomer.edit', compact('member', 'plans'));
    }

    public function planDetails($id)
    {

        $plan = Plan::findOrFail($id);
        return response()->json([
            'id' => $plan->id,
            'name' => $plan->name,
            'amount' => $plan->amount ?? 0,
            'duration_in_days' => $plan->duration_in_days ?? 0,
            'no_of_members' => $plan->no_of_members ?? 0,
            'extra_amount_per_person' => $plan->extra_amount_per_person ?? 0,
            'wallet_balance' => $plan->wallet_balance ?? 0,
            'extra_amount_per_person_in_wallet' => $plan->extra_amount_per_person_in_wallet ?? 0,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'nullable|email|unique:members,email',
            'mobile'       => 'required|digits:10|unique:members,mobile',
            'address'      => 'required|string|max:500',
            'state'        => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'pincode'      => 'required|digits:6',
            'plan_id'      => 'required|exists:plans,id',
            'expiry_date'  => 'required|date',
            'extra_member' => 'nullable|integer|min:0',
        ], [
            'email.unique' => 'This email is already registered.',
            'mobile.unique' => 'This mobile number is already registered.',
        ]);

        DB::beginTransaction();

        // try {
        $plan = Plan::findOrFail($request->plan_id);

        $durationDays = (int) ($plan->duration_in_days ?? 0);

        if ($durationDays <= 0) {
            Toastr::error('Selected plan duration is not valid.', 'Error');
            return redirect()->back()->withInput();
        }

        $endDate = Carbon::parse($request->expiry_date);
        $startDate = $endDate->copy()->subDays($durationDays - 1);

        $extraMember = (int) ($request->extra_member ?? 0);

        $planAmount = (float) ($plan->amount ?? 0);
        $extraAmountPerPerson = (float) ($plan->extra_amount_per_person ?? 0);
        $netAmount = $planAmount + ($extraMember * $extraAmountPerPerson);

        $walletBalance = (float) ($plan->wallet_balance ?? 0);
        $extraWalletAmount = (float) ($plan->extra_amount_per_person_in_wallet ?? 0);
        $openingClosing = $walletBalance + ($extraWalletAmount * $extraMember);

        $password = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $hashedPassword = Hash::make($password);

        $guid = Str::uuid();

        $orderData = [
            'iUserId'             => 0,
            'memberid'            => 0,
            'iOrderType'          => 1,
            'iPlanId'             => $plan->id,
            'iExtraMember'        => $extraMember,
            'iamountExtraMember'  => $extraAmountPerPerson,
            'iPlanMembers'        => $plan->no_of_members ?? 0,
            'PlanAmount'          => $planAmount,
            'NetAmount'           => $netAmount,
            'start_date'          => $startDate->format('Y-m-d'),
            'end_date'            => $endDate->format('Y-m-d'),
            'main_parent_id'      => 0,
            'parent_id'           => 0,
            'admin_member_add'    => 1,
            'Guid'                => $guid,
            'Name'                => $request->name,
            'email'               => $request->email,
            'mobile'              => $request->mobile,
            'address'             => $request->address,
            'state'               => $request->state,
            'city'                => $request->city,
            'pincode'             => $request->pincode,
            'isPayment'           => 1,
            'created_at'          => now(),
            'strIP'               => $request->ip(),
        ];

        $orderId = DB::table('Corporate_Order')->insertGetId($orderData);

        $member = Member::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'mobile'     => $request->mobile,
            'state'      => $request->state,
            'city'       => $request->city,
            'address'    => $request->address,
            'pincode'    => $request->pincode,
            'Order_id'   => $orderId,
            'iStatus'    => 1,
            'strIP'      => $request->ip(),
            'password'   => $hashedPassword,
            'created_at' => now(),
        ]);

        DB::table('Corporate_Order')
            ->where('Corporate_Order_id', $orderId)
            ->update([
                'memberid' => $member->id,
                'updated_at' => now(),
            ]);

        MemberOrder::create([
            'Member_id' => $member->id,
            'Order_id'  => $orderId,
        ]);

        DB::table('ledger')->insert([
            'order_id'       => $orderId,
            'openingBalance' => $openingClosing,
            'cr'             => 0,
            'dr'             => 0,
            'closingBalance' => $openingClosing,
            'created_at'     => now(),
        ]);

        Payment::create([
            'oid'     => $orderId,
            'status'       => 'Success',
            'iPaymentType' => 2,
            'Remarks'      => 'Admin Created',
            'created_at'   => now(),
        ]);

        DB::commit();

        $this->sendMemberMail(
            $member,
            $plan,
            $password,
            $startDate,
            $endDate,
            $extraMember,
            $extraAmountPerPerson
        );

        Toastr::success('Member plan created successfully and mail sent.', 'Success');

        return redirect()->route('Retail_Customer.index');
        // } catch (\Throwable $e) {
        //     DB::rollBack();

        //     Log::error('Admin Member Plan Store Error: ' . $e->getMessage(), [
        //         'file' => $e->getFile(),
        //         'line' => $e->getLine(),
        //     ]);

        //     Toastr::error($e->getMessage(), 'Error');

        //     return redirect()->back()->withInput();
        // }
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'nullable|email|unique:members,email,' . $member->id,
            'mobile'       => 'required|digits:10|unique:members,mobile,' . $member->id,
            'address'      => 'required|string|max:500',
            'state'        => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'pincode'      => 'required|digits:6',
            'plan_id'      => 'required|exists:plans,id',
            'expiry_date'  => 'required|date',
            'extra_member' => 'nullable|integer|min:0',
        ]);

        DB::beginTransaction();

        try {
            $plan = Plan::findOrFail($request->plan_id);

            $durationDays = (int) ($plan->duration_in_days ?? 0);

            if ($durationDays <= 0) {
                Toastr::error('Selected plan duration is not valid.', 'Error');
                return redirect()->back()->withInput();
            }

            $endDate = Carbon::parse($request->expiry_date);
            $startDate = $endDate->copy()->subDays($durationDays - 1);

            $extraMember = (int) ($request->extra_member ?? 0);

            $planAmount = (float) ($plan->amount ?? 0);
            $extraAmountPerPerson = (float) ($plan->extra_amount_per_person ?? 0);
            $netAmount = $planAmount + ($extraMember * $extraAmountPerPerson);

            $walletBalance = (float) ($plan->wallet_balance ?? 0);
            $extraWalletAmount = (float) ($plan->extra_amount_per_person_in_wallet ?? 0);
            $openingClosing = $walletBalance + ($extraWalletAmount * $extraMember);

            $member->update([
                'name'       => $request->name,
                'email'      => $request->email,
                'mobile'     => $request->mobile,
                'state'      => $request->state,
                'city'       => $request->city,
                'address'    => $request->address,
                'pincode'    => $request->pincode,
                'updated_at' => now(),
            ]);

            $orderId = $member->Order_id;

            DB::table('Corporate_Order')
                ->where('Corporate_Order_id', $orderId)
                ->update([
                    'iPlanId'             => $plan->id,
                    'iExtraMember'        => $extraMember,
                    'iamountExtraMember'  => $extraAmountPerPerson,
                    'iPlanMembers'        => $plan->no_of_members ?? 0,
                    'PlanAmount'          => $planAmount,
                    'NetAmount'           => $netAmount,
                    'start_date'          => $startDate->format('Y-m-d'),
                    'end_date'            => $endDate->format('Y-m-d'),
                    'Name'                => $request->name,
                    'email'               => $request->email,
                    'mobile'              => $request->mobile,
                    'address'             => $request->address,
                    'state'               => $request->state,
                    'city'                => $request->city,
                    'pincode'             => $request->pincode,
                    'updated_at'          => now(),
                ]);

            DB::table('ledger')
                ->where('order_id', $orderId)
                ->update([
                    'openingBalance' => $openingClosing,
                    'closingBalance' => $openingClosing,
                    'updated_at'     => now(),
                ]);

            DB::commit();

            Toastr::success('Member plan updated successfully.', 'Success');

            return redirect()->route('RetailCustomer.index');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Admin Member Plan Update Error: ' . $e->getMessage());

            Toastr::error($e->getMessage(), 'Error');

            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $member = Member::findOrFail($id);
            $orderId = $member->Order_id;

            DB::table('ledger')->where('order_id', $orderId)->delete();

            DB::table('Member_Order')
                ->where('Member_id', $member->id)
                ->delete();

            DB::table('card_payment')
                ->where('oid', $orderId)
                ->delete();

            $member->delete();

            DB::table('Corporate_Order')
                ->where('Corporate_Order_id', $orderId)
                ->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully.'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    private function sendMemberMail($member, $plan, $password, $startDate, $endDate, $extraMember, $extraAmountPerPerson)
    {
        try {
            if (!$member->email) {
                return false;
            }

            $sendEmailDetails = DB::table('sendemaildetails')->where('id', 9)->first();

            if (!$sendEmailDetails) {
                return false;
            }

            $msg = [
                'FromMail' => $sendEmailDetails->strFromMail,
                'Title'    => $sendEmailDetails->strTitle,
                'ToEmail'  => $member->email,
                'Subject'  => $sendEmailDetails->strSubject,
            ];

            $data = [
                'Mobile'              => $member->mobile,
                'iExtraMember'        => $extraMember,
                'iamountExtraMember'  => $extraAmountPerPerson,
                'contact_person'      => $member->name ?? '',
                'Password'            => $password,
                'plan_name'           => $plan->name ?? '',
                'plan_amount'         => $plan->amount ?? 0,
                'plan_no_of_members'  => $plan->no_of_members ?? 0,
                'start_date'          => $startDate->format('d-m-Y'),
                'end_date'            => $endDate->format('d-m-Y'),
                'app_link'            => 'https://play.google.com/store/apps/details?id=com.apollo.medical_boons',
            ];

            Mail::send('emails.Memberemail', ['data' => $data], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->subject($msg['Subject']);
            });

            return true;
        } catch (\Throwable $e) {
            Log::error('Admin Member Mail Error: ' . $e->getMessage());
            return false;
        }
    }
}
