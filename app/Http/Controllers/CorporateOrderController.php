<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Plan;
use App\Models\MemberOrder;
use App\Models\CorporateOrder;
use App\Models\Member;
use App\Models\LabReportRequestMaster;

use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class CorporateOrderController extends Controller

{

    public function payment_receipt_pdf(Request $request, $id)
    {
        try {

            $CorporateOrder = CorporateOrder::with('plan', 'companyname')->where('Corporate_Order_id', $id)->first();
            return view('pdf.payment_receipt', compact('CorporateOrder'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function invoice_update(Request $request)
    {
        try {

            $request->validate([
                'invoice_no' => 'required|unique:Corporate_Order,invoice_no,' . $request->order_id . ',Corporate_Order_id',
            ]);
            $CorporateOrder = CorporateOrder::where('Corporate_Order_id', $request->order_id)->update(['invoice_no' => $request->invoice_no]);
            Toastr::success('Invoice updated successfully');
            return redirect()->back()->withInput();
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function index(Request $request)
    {
        try {
            $CorporateOrders = CorporateOrder::with('plan', 'companyname')
                ->where('iOrderType', 1)
                ->orderBy('Corporate_Order_id', 'desc')
                ->paginate(config('app.per_page'));
            return view('CorporateOrder.index', compact('CorporateOrders'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function RetailOrderlist(Request $request)
    {
        try {
            $CorporateOrders = CorporateOrder::with('plan', 'companyname')
                ->where('iOrderType', 3)
                ->orderBy('Corporate_Order_id', 'desc')
                ->paginate(config('app.per_page'));
            return view('CorporateOrder.retail_list', compact('CorporateOrders'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function RetailRegistrationForm()
    {
        try {
            $plans = Plan::orderBy('name')->get();
            return view('CorporateOrder.retail_registration', compact('plans'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function RetailRegistrationStore(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'mobile' => 'required|digits:10',
                'address' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required',
                'plan_id' => 'required|exists:plans,id',
                'plan_amount' => 'required|numeric|min:0',
                'plan_member' => 'required|numeric|min:0',
                'extra_amount_per_person' => 'required|numeric|min:0',
                'extra_memeber' => 'nullable|numeric|min:0',
                'net_amount' => 'required|numeric|min:0',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            $plan = Plan::where('id', $request->plan_id)->firstOrFail();
            $orderGuid = Str::uuid();
            $isRenew = false;
            $generatedPassword = null;

            $member = Member::where('mobile', $request->mobile)->first();

            if ($member) {
                $isRenew = true;

                if ($member->email !== $request->email) {
                    $emailInUse = Member::where('email', $request->email)
                        ->where('id', '!=', $member->id)
                        ->exists();
                    if ($emailInUse) {
                        throw new \Exception('This email is already registered with another member.');
                    }
                }

                $member->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'state' => $request->state,
                    'city' => $request->city,
                    'address' => $request->address,
                    'pincode' => $request->pincode,
                ]);
            } else {
                $emailInUse = Member::where('email', $request->email)->exists();
                if ($emailInUse) {
                    throw new \Exception('This email is already registered.');
                }

                $generatedPassword = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $member = Member::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'state' => $request->state,
                    'city' => $request->city,
                    'address' => $request->address,
                    'pincode' => $request->pincode,
                    'password' => Hash::make($generatedPassword),
                ]);
            }

            $startDate = Carbon::parse($request->start_date);
            $latestOrder = CorporateOrder::where('memberid', $member->id)
                ->where('isPayment', 1)
                ->orderBy('end_date', 'desc')
                ->first();
            if ($latestOrder && $latestOrder->end_date) {
                $latestEndDate = Carbon::parse($latestOrder->end_date);
                if ($latestEndDate->greaterThanOrEqualTo(Carbon::today())) {
                    $startDate = $latestEndDate->copy()->addDay();
                    $isRenew = true;
                }
            }

            $endDate = Carbon::parse($request->end_date);
            if (!empty($plan->duration_in_days) && (int) $plan->duration_in_days > 0) {
                $endDate = $startDate->copy()->addDays(((int) $plan->duration_in_days) - 1);
            }

            $orderData = [
                'iUserId' => 0,
                'memberid' => $member->id,
                'iOrderType' => 3,
                'iPlanId' => $request->plan_id,
                'iExtraMember' => $request->extra_memeber ?? 0,
                'iamountExtraMember' => $request->extra_amount_per_person ?? 0,
                'iPlanMembers' => $request->plan_member ?? 0,
                'PlanAmount' => $request->plan_amount ?? 0,
                'NetAmount' => $request->net_amount ?? 0,
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'main_parent_id' => 0,
                'parent_id' => 0,
                'Guid' => $orderGuid,
                'Name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'isPayment' => 1,
                'created_at' => now(),
                'strIP' => $request->ip(),
            ];

            $orderId = DB::table('Corporate_Order')->insertGetId($orderData);
            CorporateOrder::where('Corporate_Order_id', $orderId)->update(['memberid' => $member->id]);

            MemberOrder::create([
                'Member_id' => $member->id,
                'Order_id' => $orderId,
            ]);

            $walletbal = $plan->wallet_balance ?? 0;
            $extraWalletAmount = $plan->extra_amount_per_person_in_wallet ?? 0;
            $openingclosing = $walletbal + (($request->extra_memeber ?? 0) * $extraWalletAmount);

            DB::table('ledger')->insert([
                'order_id' => $orderId,
                'openingBalance' => $openingclosing,
                'cr' => 0,
                'dr' => 0,
                'closingBalance' => $openingclosing,
                'created_at' => now(),
            ]);

            $sendEmailDetails = DB::table('sendemaildetails')->where(['id' => 9])->first();
            if ($sendEmailDetails && $member->email) {
                $msg = [
                    'FromMail' => $sendEmailDetails->strFromMail,
                    'Title' => $sendEmailDetails->strTitle,
                    'ToEmail' => $member->email,
                    'Subject' => $sendEmailDetails->strSubject,
                ];

                $mailData = [
                    'Mobile' => $member->mobile,
                    'iExtraMember' => $request->extra_memeber ?? 0,
                    'iamountExtraMember' => $request->extra_amount_per_person ?? 0,
                    'contact_person' => $member->name ?? '',
                    'Password' => $generatedPassword ?? 'Already Created',
                    'plan_name' => $plan->name ?? '',
                    'plan_amount' => $request->plan_amount ?? 0,
                    'plan_no_of_members' => $request->plan_member ?? 0,
                    'start_date' => $startDate->format('d-m-Y'),
                    'end_date' => $endDate->format('d-m-Y'),
                    'app_link' => 'https://play.google.com/store/apps/details?id=com.apollo.medical_boons',
                ];

                Mail::send('emails.Memberemail', ['data' => $mailData], function ($message) use ($msg) {
                    $message->from($msg['FromMail'], $msg['Title']);
                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                });
            }

            DB::commit();
            Toastr::success($isRenew ? 'Plan renewed and customer updated successfully.' : 'Customer registration saved successfully.');
            return redirect()->route('Corporate_Order.RetailOrderlist');
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function appoitment_or_labdisplay(Request $request)
    {
        try {

            $memberid = $request->member_id;
            $appointments = LabReportRequestMaster::with('member', 'AssociatedMember', 'labreqmasterdetail.family_member')->where(['appointments_flag' => 1, 'member_id' => $memberid])->paginate(config('app.per_page'));
            $LabReportinquirys = LabReportRequestMaster::with('labreqmasterdetail', 'lab', 'member')->where(['appointments_flag' => 2, 'member_id' => $memberid])->paginate(config('app.per_page'));

            return view('CorporateOrder.AppoitmentORLablist', compact('appointments', 'LabReportinquirys'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function B2BOrderlist(Request $request)
    {
        try {
            $CorporateOrders = CorporateOrder::with('plan', 'companyname', 'member')
                ->where('iOrderType', 2)
                ->orderBy('Corporate_Order_id', 'desc')
                ->paginate(config('app.per_page'));
            return view('CorporateOrder.B2BUser_list', compact('CorporateOrders'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function add()
    {
        try {
            $Companyname = Users::where(['Type' => 1])->get();
            $Plans = Plan::where('is_corporate', 1)->get();
            $Mainparentids = Users::where(['Type' => 2, 'Main_parent_id' => 0])->get();

            return view('CorporateOrder.add', compact('Companyname', 'Plans', 'Mainparentids'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function CorporateOrderMemberRegistration($guid)
    {
        try {
            $Companyname = CorporateOrder::with('companyname')->where('Guid', $guid)->first();
            return view('register', compact('Companyname', 'guid'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function Memberstore(Request $request, $guid)
    {
        DB::beginTransaction();

        // try {

        Validator::extend('mobile_no', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[6-9][0-9]{9}$/', $value);
        }, 'The :attribute must be a valid 10-digit Indian mobile number.');

        $CorporateOrder = CorporateOrder::where('Guid', $guid)->first();
        $orderid = $CorporateOrder->Corporate_Order_id ?? 0;

        $Membercountorderwise = MemberOrder::where('Order_id', $orderid)->count();
        if ($Membercountorderwise < $CorporateOrder->iExtraMember) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'mobile_no' => 'required|mobile_no|unique:members,mobile',
                'state' => 'required',
                'city' => 'required',
                'address' => 'required',
                'pincode' => 'required',
            ], [
                'mobile_no.unique' => 'This mobile no is already registered.',
            ]);


            // Check if mobile number exists
            $existingMember = Member::where('mobile', $request->mobile_no)->first();

            if ($existingMember) {
                DB::rollBack();
                return redirect()->back()->withInput('error', 'Member with this mobile number already exists. No email sent.');
            }

            $password = Str::password(12);
            $hashedPassword = Hash::make($password);
            $Member = Member::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile_no,
                'state' => $request->state ?? 0,
                'city' => $request->city ?? 0,
                'address' => $request->address ?? 0,
                'pincode' => $request->pincode ?? 0,
                'Order_id' => $CorporateOrder->Corporate_Order_id,
                'password' => $hashedPassword,

            ]);

            $Memberorder = MemberOrder::create([
                'Member_id' => $Member->id,
                'Order_id' => $CorporateOrder->Corporate_Order_id,
            ]);

            // Send email only if the mobile number is new
            $sendEmailDetails = DB::table('sendemaildetails')->where(['id' => 9])->first();

            $msg = [
                'FromMail' => $sendEmailDetails->strFromMail,
                'Title' => $sendEmailDetails->strTitle,
                'ToEmail' => $request->email,
                'Subject' => $sendEmailDetails->strSubject,
            ];


            $data = [
                'Mobile' => $request->mobile_no,
                'contact_person' => $request->name,
                "Password" => $password
            ];

            Mail::send('emails.Memberemail', ['data' => $data], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->subject($msg['Subject']);
            });
        } else {
            DB::rollBack();
            //return redirect()->back()->withInput('error','Your member limit is over!');
            return redirect()->back()->with('error', 'Your member limit is over!')->withInput();
        }
        $planid = $CorporateOrder->iPlanId;
        $ExtraMember = $CorporateOrder->iExtraMember;

        $plan = Plan::where('id', $planid)->first();
        $walletbal = $plan->wallet_balance ?? 0;
        $Extra_amount_per_person_in_wallet = $plan->extra_amount_per_person_in_wallet;

        $calculate_extra_amountin_wallet = $Extra_amount_per_person_in_wallet * $ExtraMember;
        $openingclosing = $walletbal + $calculate_extra_amountin_wallet;

        DB::table('ledger')->insert([
            'order_id' => $CorporateOrder->Corporate_Order_id,
            'openingBalance' => $openingclosing,
            'cr' => 0,
            'dr' => 0,
            'closingBalance' => $openingclosing,
            'created_at' => now(),
        ]);

        DB::commit();
        return redirect()->back()->with('success', 'Member created successfully');

        return redirect()->route('CorporateOrderMemberRegistration', $guid);
        // } catch (ValidationException $e) {
        //     DB::rollBack();
        //     $errors = $e->errors();
        //     $errorMessages = [];
        //     foreach ($errors as $field => $messages) {
        //         foreach ($messages as $message) {
        //             $errorMessages[] = $message;
        //         }
        //     }
        //     $errorMessageString = implode(', ', $errorMessages);
        //     Toastr::error($errorMessageString, 'Error');
        //     return redirect()->back()->withInput();
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     Toastr::error('Failed to create area: ' . $th->getMessage(), 'Error');
        //     return redirect()->back()->withInput()->with('error', $th->getMessage());
        // }
    }


    public function store(Request $request)

    {
        DB::beginTransaction();

        try {
            $guid = Str::uuid();

            $request->validate([

                'iamountExtraMember' => 'required',
                'PlanAmount' => 'required',
                'NetAmount' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            $CorporateOrder = CorporateOrder::create([

                'iUserId' => $request->User_id,
                'Guid' => $guid,
                'iOrderType' => 1,
                'iPlanMembers' => $request->no_of_member,
                'iPlanId' => $request->Plan_id,
                'main_parent_id' => $request->Main_parent_id ?? 0,
                'parent_id' => $request->parent_id ?? 0,
                'iExtraMember' => $request->iExtraMember,
                'iamountExtraMember' => $request->iamountExtraMember ?? 0,
                'PlanAmount' => $request->PlanAmount ?? 0,
                'NetAmount' => $request->NetAmount ?? 0,
                'start_date' => $request->start_date ?? 0,
                'end_date' => $request->end_date ?? 0,
                'created_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Corporate created successfully :)', 'Success');

            return redirect()->route('Corporate_Order.index');
        } catch (ValidationException $e) {

            DB::rollBack();

            $errors = $e->errors();

            $errorMessages = [];
            foreach ($errors as $field => $messages) {

                foreach ($messages as $message) {

                    $errorMessages[] = $message;
                }
            }
            $errorMessageString = implode(', ', $errorMessages);
            Toastr::error($errorMessageString, 'Error');

            return redirect()->back()->withInput();
        } catch (\Throwable $th) {

            DB::rollBack();

            Toastr::error('Failed to create area: ' . $th->getMessage(), 'Error');

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function parent_id_mapping(Request $request)
    {
        $Main_parent_id = $request->Main_parent_id;
        $selectedParentId = $request->selectedParentId;

        if ($Main_parent_id) {
            $parent_ids = Users::where('Main_parent_id', $Main_parent_id)
                ->where('Type', 2)
                ->orderBy('Users_id', 'asc')
                ->get();

            $html = "<option value=''>Select Parent</option>";

            foreach ($parent_ids as $parent_id) {
                $selected = ($parent_id->Users_id == $selectedParentId) ? "selected" : "";
                $html .= "<option value='" . $parent_id->Users_id . "' $selected>" . $parent_id->contact_person . "</option>";
            }

            return $html;
        }

        return "<option value=''>Select Parent</option>";
    }


    public function edit(Request $request, $id)
    {
        try {
            $Mainparentids = Users::where(['Type' => 2, 'Main_parent_id' => 0])->get();
            $Companyname = Users::where(['Type' => 1])->get();
            $Plans = Plan::where('is_corporate', 1)->get();
            $data = CorporateOrder::where('Corporate_Order_id', $id)->first();
            return view('CorporateOrder.edit', compact('data', 'Companyname', 'Plans', 'Mainparentids'));
        } catch (\Throwable $th) {

            // Rollback and return with Error

            DB::rollBack();

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }



    public function update(Request $request)

    {
        DB::beginTransaction();

        try {


            $request->validate([

                'iamountExtraMember' => 'required',
                'PlanAmount' => 'required',
                'NetAmount' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            CorporateOrder::where(['Corporate_Order_id' => $request->Corporate_Order_id])->update([

                'iUserId' => $request->User_id,
                'iPlanMembers' => $request->no_of_member,
                'iPlanId' => $request->Plan_id,
                'iExtraMember' => $request->iExtraMember,
                'iamountExtraMember' => $request->iamountExtraMember ?? 0,
                'PlanAmount' => $request->PlanAmount ?? 0,
                'main_parent_id' => $request->Main_parent_id ?? 0,
                'parent_id' => $request->parent_id ?? 0,
                'NetAmount' => $request->NetAmount ?? 0,
                'start_date' => $request->start_date ?? 0,
                'end_date' => $request->end_date ?? 0,
                'updated_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Corporate Order updated successfully :)', 'Success');

            // return back();
            return redirect()->route('Corporate_Order.index');
        } catch (ValidationException $e) {

            DB::rollBack();

            $errors = $e->errors(); // Get the errors array

            $errorMessages = []; // Initialize an array to hold error messages



            // Loop through the errors array and flatten the error messages

            foreach ($errors as $field => $messages) {

                foreach ($messages as $message) {

                    $errorMessages[] = $message;
                }
            }



            // Join all error messages into a single string

            $errorMessageString = implode(', ', $errorMessages);



            Toastr::error($errorMessageString, 'Error');

            return redirect()->back()->withInput();
        } catch (\Throwable $th) {

            DB::rollBack();

            Toastr::error('Error: ' . $th->getMessage());

            return redirect()->back()->withInput();
        }
    }



    public function delete(Request $request)

    {

        DB::beginTransaction();
        try {

            CorporateOrder::where(['iStatus' => 1, 'isDelete' => 0, 'Corporate_Order_id' => $request->id])->delete();
            DB::commit();
            Toastr::success('Corporate Order deleted successfully :)', 'Success');
            return response()->json(['success' => true]);
        } catch (ValidationException $e) {

            DB::rollBack();

            Toastr::error(implode(', ', $e->errors()));

            return redirect()->back()->withInput();
        } catch (\Throwable $th) {

            DB::rollBack();

            Toastr::error('Error: ' . $th->getMessage());

            return redirect()->back()->withInput();
        }
    }



    public function deleteselected(Request $request)

    {

        try {

            $ids = $request->input('Corporate_Order_ids', []);

            CorporateOrder::whereIn('Corporate_Order_id', $ids)
                ->delete();

            Toastr::success('Corporate Order deleted successfully :)', 'Success');

            return back();
        } catch (ValidationException $e) {

            DB::rollBack();

            Toastr::error(implode(', ', $e->errors()));

            return redirect()->back()->withInput();
        } catch (\Throwable $th) {

            DB::rollBack();

            Toastr::error('Error: ' . $th->getMessage());

            return redirect()->back()->withInput();
        }
    }
}
