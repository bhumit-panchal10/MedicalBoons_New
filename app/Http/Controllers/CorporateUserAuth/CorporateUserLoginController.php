<?php

namespace App\Http\Controllers\CorporateUserAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use App\Models\Users;
use Brian2694\Toastr\Facades\Toastr;


class CorporateUserLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin.php';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /** index login page */
    public function login()
    {
        return view('CorporateUserauth.login');
    }

    /** login page to check database table users */
    public function loginstore(Request $request)
    {


        $request->validate([
            'mobile'    => 'required',
            'password'  => 'required',
        ]);


        try {
            $mobile = $request->mobile;
            $password = $request->password;

            if ($mobile == '' && $password == '') {

                return redirect()->route('corporate.login')->with('error', 'Please Enter Mobile and password');
            } else {

                $CorporateUser = Users::where('mobile', trim($request->mobile))->where(['iStatus' => 1, 'isDelete' => 0, 'Type' => 1])->first();
                if (!$CorporateUser || !Hash::check($request->password, $CorporateUser->password)) {

                    Toastr::error('Invalid Mobile or Password', 'Error');
                    return redirect()->route('corporate.login');
                } else {

                    $request->session()->put('Users_id', $CorporateUser->Users_id);
                    $request->session()->put('strCompany', $CorporateUser->company_name);
                    $request->session()->put('Mobile', $CorporateUser->mobile);
                    $request->session()->put('Email', $CorporateUser->email);
                    $request->session()->put('ContactPerson', $CorporateUser->contact_person);
                    $request->session()->put('Type', $CorporateUser->Type);

                    Toastr::success('Login successful :)', 'Success');
                    return redirect()->route('CUserHome');
                }
            }
        } catch (\Exception $e) {
            Toastr::error('Login failed. Please try again :)', 'Error');
            return redirect()->back()->withInput();
        }
    }

    /** page logout */
    public function CUserlogoutpage()
    {
        return view('CorporateUserauth.logout');
    }

    /** logout and forget session */
    public function CUserlogout(Request $request)
    {

        $request->session()->flush();
        Auth::logout();
        Toastr::success('Logout successfully :)', 'Success');
        return redirect('logout');
    }
}
