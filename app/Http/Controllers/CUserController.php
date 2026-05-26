<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Plan;
use App\Models\MemberOrder;
use App\Models\CorporateOrder;
use App\Models\Member;

use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use Illuminate\Support\Facades\Mail;


class CUserController extends Controller

{

    public function index(Request $request)
    {
        try {
            $sessionUsers_id = session('Users_id');
            $CorporateOrders = CorporateOrder::with('plan', 'companyname')
                //->where('main_parent_id', 0)
                // ->where('parent_id', 0)
                ->where('iUserId', $sessionUsers_id)
                ->paginate(config('app.per_page'));
            //dd($CorporateOrders);
            return view('CUser.index', compact('CorporateOrders'));
        } catch (\Throwable $th) {
            \Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function Memberlist(Request $request, $orderid = null)
    {
        try {
            if ($orderid == '') {
                $Members = Member::paginate(config('app.per_page'));
            } else {
                $Members = Member::where('Order_id', $orderid)
                    ->paginate(config('app.per_page'));
            }

            return view('CUser.Memberlist', compact('Members'));
        } catch (\Throwable $th) {
            \Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
