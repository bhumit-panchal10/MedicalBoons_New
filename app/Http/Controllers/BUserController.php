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


class BUserController extends Controller

{

    public function index(Request $request)
    {
        try {
            $sessionUsers_id = session('Users_id'); //11
            $B2Bordersusers = CorporateOrder::with('plan', 'companyname', 'MainParent', 'Parent','member')
                ->where(function ($query) use ($sessionUsers_id) {
                    $query->where('main_parent_id', $sessionUsers_id)
                        ->orWhere('parent_id', $sessionUsers_id)
                        ->orWhere('iUserId', $sessionUsers_id);
                })
                ->paginate(config('app.per_page'));
            return view('BUser.index', compact('B2Bordersusers', 'sessionUsers_id'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function planlist(Request $request)
    {
        try {
            $sessionUsers_id = session('Users_id');

            $user = Users::where('Users_id', $sessionUsers_id)->first();
            $GUid = $user->Guid;
            $Plans = Plan::where('is_corporate',0)->paginate(config('app.per_page'));

            return view('BUser.plan', compact('Plans', 'GUid'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
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
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
