<?php

namespace App\Http\Controllers;

use App\Models\AssociatedMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Users;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use App\Models\CorporateOrder;
use App\Models\Member;

class CorporateUserHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sessionUsers_id = session('Users_id');
        $CorporateOrders = CorporateOrder::where('iUserId', $sessionUsers_id)
            //->where('main_parent_id', 0)
            //->where('parent_id', 0)
            ->count();
        $orderIds = CorporateOrder::where('iUserId', $sessionUsers_id)
            // ->where('main_parent_id', 0)
            //->where('parent_id', 0)
            ->pluck('Corporate_Order_id');
        $member = Member::whereIn('Order_id', $orderIds)->count();

        return view('dashboard.home_cuser', compact('CorporateOrders', 'member'));
    }

    public function CUsergetProfile()
    {
        $sessionUsers_id = session('Users_id');

        $users = Users::where('Users_id',  $sessionUsers_id)->first();

        return view('Cuserprofile', compact('users'));
    }

    public function updateProfile(Request $request, $id)
    {

        $request->validate([

            'editmobile' => ['required', 'digits:10']


        ]);
        $data = array(
            "contact_person" => $request->editname,
            "company_name" => $request->editcompanyname,
            "mobile" => $request->editmobile,
            "email" => $request->editemail,
            "Address" => $request->editaddress
        );

        $user = Users::where('Users_id', $id)->update($data);
        if ($user) {
            Toastr::success('User proflie updated successfully :)', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Something went wrong :)', 'Error');
            return redirect()->back();
        }
    }

    public function changePassword(Request $request)
    {
        return view('dashboard.CuserChangepassword');
    }

    public function changePassword_update(Request $request)
    {
        DB::beginTransaction();
        try {
            $newPassword = $request->newPassword;
            $confirmPassword = $request->confirmPassword;

            $users = Users::where('Users_id',  $request->id)->first();

            if (!Hash::check($request->oldPassword, $users->password)) {
                Toastr::error('Old password does not match');
                return redirect()->back()->withInput();
            }

            if ($newPassword === $confirmPassword) {

                $users->password = Hash::make($request->newPassword);
                $users->save();

                DB::commit();

                Toastr::success('Password changed successfully');
                return redirect()->route('CUserlogout');
            } else {
                Toastr::error('new password and confirm password does not match');
                return redirect()->back()->withInput();
            }
        } catch (ValidationException $e) {
            DB::rollBack();
            Toastr::error('Validation Error: ' . implode(', ', $e->errors()));
            return redirect()->back()->withInput();
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
