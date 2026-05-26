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



class B2BUserController extends Controller

{

    public function index(Request $request)
    {
        try {
            $B2BUsers = Users::where('Type', 2)->paginate(config('app.per_page'));

            return view('B2BUser.index', compact('B2BUsers'));
        } catch (\Throwable $th) {
            \Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function add()
    {
        try {
            $Mainparentids = Users::where(['Type' => 2, 'Main_parent_id' => 0])->get();
            return view('B2BUser.add', compact('Mainparentids'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function parent_id_mapping(Request $request)
    {
        $Main_parent_id = $request->Main_parent_id;

        $selectedParentId = $request->selectedParentId;
        $B2BUserid = $request->B2BUserid;
        $B2BUserid = is_array($B2BUserid) ? $B2BUserid : explode(',', $B2BUserid);

        if ($Main_parent_id) {
            // $parent_ids = Users::orderBy('Users_id', 'asc')
            //     ->where([
            //         'Main_parent_id' => $Main_parent_id,
            //         'Type' => 2,
            //         //'Parent_id' => 0
            //     ])
            //     ->whereNotIn('Users_id', $B2BUserid)
            //     ->get();
            $parent_ids = Users::where('Main_parent_id', $Main_parent_id)
                ->where('Type', 2)
                ->whereNotIn('Users_id', $B2BUserid)
                ->orderBy('Users_id', 'asc')
                ->get();

            if ($parent_ids->isNotEmpty()) {
                $html = "<option value=''>Select Parent</option>";

                foreach ($parent_ids as $parent_id) {
                    $selected = ($parent_id->Users_id == $selectedParentId) ? "selected" : "";
                    $html .= "<option value='" . $parent_id->Users_id . "' $selected>" . $parent_id->contact_person . "</option>";
                }

                return $html;
            }
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
                'Main_parent_id' => $request->Main_parent_id ?? 0,
                'Parent_id' => $request->parent_id ?? 0,
                'Type' => 2,
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

            $data = [
                'LoginId' => $request->email,
                'mobile' => $request->mobile,
                'contact_person' => $request->contact_person,
                "Password" => $request->password
            ];

            Mail::send('emails.B2BUseremail', ['data' => $data], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->subject($msg['Subject']);
            });
            DB::commit();
            Toastr::success('B2B User created successfully :)', 'Success');

            return redirect()->route('B2B_User.index');
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

    public function passwordupdate(Request $request)
    {
        $newpassword = $request->newpassword;
        $confirmpassword = $request->confirmpassword;

        if ($newpassword === $confirmpassword) {

            $B2BUsers =   DB::table('Users')
                ->where('Users_id', $request->b2buser_id)
                ->update([
                    'password' => Hash::make($confirmpassword),
                ]);
            if ($B2BUsers) {

                Toastr::success('B2B User password updated successfully.)', 'Success');

                return redirect()->route('B2B_User.index');
            } else {
                Toastr::success('B2B User not found.)', 'Success');

                return redirect()->route('B2B_User.index');
            }
        } else {
            return redirect()->route('B2B_User.index')->with('error', 'Password and confirm password do not match.');
        }
    }

    public function edit(Request $request, $id)

    {

        try {
            $Mainparentids = Users::where(['Type' => 2, 'Main_parent_id' => 0])->get();
            $data = Users::where('Users_id', $id)->first();
            return view('B2BUser.edit', compact('data', 'Mainparentids'));
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
                'edit_mobile' => 'required|unique:Users,mobile,' . $request->B2B_Users_id . ',Users_id',
                'edit_email' => 'required',
                'Address' => 'required',
            ]);
            Users::where(['Users_id' => $request->B2B_Users_id])->update([

                'company_name' => $request->edit_company_name,
                'contact_person' => $request->contact_person,
                'mobile' => $request->edit_mobile,
                'email' => $request->edit_email,
                'Address' => $request->Address,
                'Main_parent_id' => $request->Main_parent_id ?? 0,
                'Parent_id' => $request->parent_id ?? 0,
                // 'password' => Hash::make($request->edit_Password),
                'updated_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('B2B User updated successfully :)', 'Success');

            // return back();
            return redirect()->route('B2B_User.index');
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

            Users::where(['Type' => 2, 'iStatus' => 1, 'isDelete' => 0, 'Users_id' => $request->id])->delete();
            DB::commit();
            Toastr::success('B2B User deleted successfully :)', 'Success');
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

            Users::where('Type', 2)
                ->whereIn('Users_id', $ids)
                ->delete();

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
