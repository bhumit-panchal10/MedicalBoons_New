<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Plan;
use App\Models\MemberOrder;
use App\Models\Member;
use App\Models\CorporateOrder;

use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use Illuminate\Support\Facades\Mail;


class MemberController extends Controller

{

    public function index(Request $request, $orderid = null)
    {
        try {
            $Members = Member::where('Order_id', $orderid)->paginate(config('app.per_page'));
            return view('Member.index', compact('Members', 'orderid'));
        } catch (\Throwable $th) {
            \Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function add($orderid = null)
    {
        try {
            return view('Member.add', compact('orderid'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }



    public function Memberstore(Request $request)
    {
        DB::beginTransaction();

        try {
            $CorporateOrder = CorporateOrder::where('Corporate_Order_id', $request->orderid)->first();
            $Membercountorderwise = MemberOrder::where('Order_id', $request->orderid)->count();

            if ($Membercountorderwise <= $CorporateOrder->iExtraMember) {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:members,email',
                    'mobile' => 'required',
                    'state' => 'required',
                    'city' => 'required',
                    'address' => 'required',
                    'pincode' => 'required',
                ], [
                    'email.unique' => 'This email address is already registered.',
                ]);

                // Check if mobile number exists
                $existingMember = Member::where('mobile', $request->mobile)->first();

                if ($existingMember) {
                    DB::rollBack();
                    Toastr::error('Member with this mobile number already exists. No email sent.', 'Error');
                    return redirect()->back()->withInput();
                }

                $password = Str::password(12);
                $hashedPassword = Hash::make($password);
                $Member = Member::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
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
                    'LoginId' => $request->email,
                    'contact_person' => $request->name,
                    "Password" => $password
                ];

                Mail::send('emails.Memberemail', ['data' => $data], function ($message) use ($msg) {
                    $message->from($msg['FromMail'], $msg['Title']);
                    $message->to($msg['ToEmail'])->subject($msg['Subject']);
                });
            } else {
                DB::rollBack();
                Toastr::error('Your member limit is over!', 'Error');
                return redirect()->back()->withInput();
            }

            DB::commit();
            Toastr::success('Member created successfully :)', 'Success');
            return redirect()->route('Member.index', $request->orderid);
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





    public function edit(Request $request, $id = null, $orderid = null)
    {
        try {


            $data = Member::where('id', $id)->first();
            return view('Member.edit', compact('data', 'id', 'orderid'));
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
                'name' => 'required',
                'email' => 'required|email|unique:members,email',
                'mobile' => 'required',
                'state' => 'required',
                'city' => 'required',
                'address' => 'required',
                'pincode' => 'required',
            ], [
                'email.unique' => 'This email address is already registered.',
            ]);
            Member::where(['id' => $request->Memberid])->update([

                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'pincode' => $request->pincode,

            ]);
            DB::commit();
            Toastr::success('Member updated successfully :)', 'Success');

            // return back();
            return redirect()->route('Member.index', $request->orderid);
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

            Member::where(['iStatus' => 1, 'isDelete' => 0, 'id' => $request->id])->delete();
            MemberOrder::where(['Member_id' => $request->id])->delete();

            DB::commit();
            Toastr::success('Member deleted successfully :)', 'Success');
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
        $ids = $request->input('Member_ids', []);

        if (empty($ids)) {
            Toastr::warning('No members selected for deletion.', 'Warning');
            return back();
        }

        DB::beginTransaction();

        try {
            // Delete related member orders first
            MemberOrder::whereIn('Member_id', $ids)->delete();

            // Then delete members
            Member::whereIn('id', $ids)->delete();

            DB::commit();

            Toastr::success('Member(s) deleted successfully :)', 'Success');
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
