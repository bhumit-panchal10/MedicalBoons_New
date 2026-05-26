<?php

namespace App\Http\Controllers\B2BUserAuth;

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
use App\Models\CorporateOrder;

use Brian2694\Toastr\Facades\Toastr;


class B2BUserLoginController extends Controller
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
    public function B2Blogin()
    {
        return view('B2bUserauth.login');
    }

    /** login page to check database table users */
    public function B2BUloginstore(Request $request)
    {
        $request->validate([
            'mobile'    => 'required',
            'password'  => 'required',
        ]);

        try {
            $mobile = $request->mobile;
            $password = $request->password;

            if ($mobile == '' && $password == '') {

                return redirect()->route('B2B.login')->with('error', 'Please Enter Mobile and password');
            } else {
                $B2BUser = Users::where('mobile', trim($request->mobile))->where(['iStatus' => 1, 'isDelete' => 0, 'Type' => 2])->first();

                if (!$B2BUser || !Hash::check($request->password, $B2BUser->password)) {
                    Toastr::error('Invalid Mobile or Password', 'Error');
                    return redirect()->route('B2B.login');
                } else {
                    $request->session()->put('Users_id', $B2BUser->Users_id);
                    $request->session()->put('strCompany', $B2BUser->company_name);
                    $request->session()->put('Mobile', $B2BUser->mobile);
                    $request->session()->put('Email', $B2BUser->email);
                    $request->session()->put('ContactPerson', $B2BUser->contact_person);
                    $request->session()->put('Type', $B2BUser->Type);

                    Toastr::success('Login successful :)', 'Success');
                    return redirect()->route('B2BUserHome');
                }
            }
        } catch (\Exception $e) {
            Toastr::error('Login failed. Please try again :)', 'Error');
            return redirect()->back()->withInput();
        }
    }

    /** page logout */
    public function BUserlogoutpage()
    {
        return view('B2bUserauth.logout');
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
