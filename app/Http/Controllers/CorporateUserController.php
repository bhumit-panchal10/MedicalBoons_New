<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;
use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Validation\ValidationException;



class CorporateUserController extends Controller

{

    public function index(Request $request)
    {
        try {
            $CorporateUsers = Users::where('Type', 1)->paginate(config('app.per_page'));

            return view('CorporateUser.index', compact('CorporateUsers'));
        } catch (\Throwable $th) {
            \Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function add()
    {
        try {
            return view('CorporateUser.add');
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function passwordupdate(Request $request)
    {
        $newpassword = $request->newpassword;
        $confirmpassword = $request->confirmpassword;

        if ($newpassword === $confirmpassword) {

            $CorporateUsers =   DB::table('Users')
                ->where('Users_id', $request->corporateuser_id)
                ->update([
                    'password' => Hash::make($confirmpassword),
                ]);
            if ($CorporateUsers) {

                Toastr::success('Corporate password updated successfully.)', 'Success');

                return redirect()->route('Corporate_User.index');
            } else {
                Toastr::success('Corporate User not found.)', 'Success');

                return redirect()->route('Corporate_User.index');
            }
        } else {
            return redirect()->route('Corporate_User.index')->with('error', 'Password and confirm password do not match.');
        }
    }


    public function Resentmail(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $CorporateUsers = DB::table('Users')->where(['Users_id' => $id])->first();

            if (!$CorporateUsers) {
                Toastr::error('User not found', 'Error');
                return redirect()->back();
            }

            // 1. Generate a new random password
            $newPasswordPlain = Str::random(8);

            DB::table('Users')
                ->where('Users_id', $id)
                ->update([
                    'password' => Hash::make($newPasswordPlain),
                    'updated_at' => now(),
                ]);

            $sendEmailDetails = DB::table('sendemaildetails')->where(['id' => 9])->first();

            $msg = [
                'FromMail' => $sendEmailDetails->strFromMail,
                'Title' => $sendEmailDetails->strTitle,
                'ToEmail' => $CorporateUsers->email,
                'Subject' => $sendEmailDetails->strSubject,
            ];

            $data = [
                'LoginId' => $CorporateUsers->email,
                'contact_person' => $CorporateUsers->contact_person,
                'Password' => $newPasswordPlain, // send plain password to email
            ];

            Mail::send('emails.welcomemail', ['data' => $data], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->subject($msg['Subject']);
            });

            DB::commit();

            Toastr::success('Mail Sent Successfully:)', 'Success');
            return redirect()->route('Corporate_User.index');
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
            Toastr::error('Failed to send mail: ' . $th->getMessage(), 'Error');
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function store(Request $request)

    {
        DB::beginTransaction();

        try {
            $guid = Str::uuid();
            $request->validate([

                'company_name' => 'required',
                'contact_person' => 'required',
                //'mobile' => 'required',
                'mobile' => 'required|unique:Users,mobile',
                'email' => 'required',
                'Address' => 'required',
                'password' => 'required',
            ]);

            $Users = Users::create([

                'company_name' => $request->company_name,
                'contact_person' => $request->contact_person,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'Address' => $request->Address,
                'Type' => 1,
                'password' => Hash::make($request->password),
                'Guid' => $guid,
                'created_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);
            $sendEmailDetails = DB::table('sendemaildetails')->where(['id' => 9])->first();

            $msg = [
                'FromMail' => $sendEmailDetails->strFromMail,
                'Title' => $sendEmailDetails->strTitle,
                'ToEmail' => $request->email,
                'Subject' => $sendEmailDetails->strSubject,
            ];

            $data = array(
                'LoginId' => $request->email,
                'contact_person' => $request->contact_person,
                "Password" => $request->password
            );

            $mail = Mail::send('emails.welcomemail', ['data' => $data], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->subject($msg['Subject']);
            });
            DB::commit();
            Toastr::success('Corporate User created successfully :)', 'Success');

            return redirect()->route('Corporate_User.index');
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

    public function edit(Request $request, $id)

    {

        try {

            $data = Users::where('Users_id', $id)->first();
            return view('CorporateUser.edit', compact('data'));
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

                'edit_company_name' => 'required',
                'contact_person' => 'required',
                //'edit_mobile' => 'required',
                'edit_mobile' => 'required|unique:Users,mobile,' . $request->corporate_Users_id . ',Users_id',
                'edit_email' => 'required',
                'Address' => 'required',
            ]);
            Users::where(['Users_id' => $request->corporate_Users_id])->update([

                'company_name' => $request->edit_company_name,
                'contact_person' => $request->contact_person,
                'mobile' => $request->edit_mobile,
                'email' => $request->edit_email,
                'Address' => $request->Address,
                // 'password' => Hash::make($request->edit_Password),
                'updated_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Corporate User updated successfully :)', 'Success');

            // return back();
            return redirect()->route('Corporate_User.index');
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

            Users::where(['iStatus' => 1, 'isDelete' => 0, 'Users_id' => $request->id])->delete();
            DB::commit();
            Toastr::success('Associated Member deleted successfully :)', 'Success');
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

            $ids = $request->input('Users_ids', []);

            Users::whereIn('Users_id', $ids)->delete();

            Toastr::success('Corporate User deleted successfully :)', 'Success');

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
