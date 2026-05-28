<?php

namespace App\Http\Controllers;

use App\Models\CMSMaster;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PlanDetail;
use App\Models\Users;
use App\Models\LabTestMaster;
use App\Models\Ourclient;
use App\Models\LabTestCategory;
use App\Models\Testimonial;
use App\Models\Member;
use App\Models\FaqMaster;
use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cookie;



class FrontviewController extends Controller

{
    public function index(Request $request)
    {
        try {
            $plans = Plan::get();
            $LabTestCategorys = LabTestCategory::take(2)->get();
            $data = array();
            foreach ($LabTestCategorys as $labtestcat) {

                $LabTestMasters = LabTestMaster::where('lab_test_category_id', $labtestcat->Lab_Test_Category_id)->get();
                $labmaster = [];
                foreach ($LabTestMasters as $labtestmas) {
                    $labmaster[] = array(
                        'Test_Name' => $labtestmas->Test_Name,
                        'Lab_Test_Master_id' => $labtestmas->Lab_Test_Master_id,
                        'image' => $labtestmas->image,

                    );
                }

                $data[] = array(
                    'name' => $labtestcat->name,
                    'Lab_Test_Category_id' => $labtestcat->Lab_Test_Category_id,
                    'labmaster' =>  $labmaster,
                );
            }
            //dd($data);
            $Ourclients = Ourclient::take(12)->get();
            $testimonials = Testimonial::get();

            return view('frontview.index', compact('plans', 'LabTestMasters', 'Ourclients', 'data', 'testimonials'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }
    public function Plan(Request $request, $guid = null)
    {
        try {
            //$plans = Plan::get();
            //Cookie::queue('GUid', $guid, 60 * 24 * 365 * 5);
            // $g_uid = request()->cookie('GUid');
            $faqs = FaqMaster::where('type', 1)->get();
            $testimonials = Testimonial::get();
            return view('frontview.PackagesAll', compact('faqs', 'testimonials'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function PlanDetail(Request $request, $planid, $guid = null)
    {
        try {
            if ($guid) {
                Cookie::queue('GUid', $guid, 60 * 24 * 365 * 5);
            }
            $g_uid = $guid ?? $request->cookie('GUid');

            $plans = Plan::where('slugname', $planid)->first();
            if (!$plans) {
                Toastr::error('Plan not found.');
                return redirect()->back();
            }
            $plandetails = PlanDetail::with('service')->where('plan_id', $plans->id)->get();
            return view('frontview.PlanDetail', compact('plandetails', 'plans', 'g_uid'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function AboutUs(Request $request, $id = null)
    {
        // dd($id);
        // try {
        // $CMSMaster = CMSMaster::where('slugname', $id)->first();

        // if (!$CMSMaster) {
        //     abort(404);
        // }

        return view('frontview.AboutUs');
        // } catch (\Throwable $th) {
        //     Toastr::error('Error: ' . $th->getMessage());
        //     return redirect()->back()->withInput();
        // }
    }

    public function PartnerWithUs()
    {
        try {

            return view('frontview.PartnerWithUs');
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function Booking(Request $request, $planid)
    {
        try {
            $plans = Plan::where('slugname', $planid)->first();
            //dd($plans);
            $guid = request()->cookie('GUid');
            return view('frontview.Booking', compact('plans', 'guid'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function checkoutstore(Request $request)
    {
        // DB::beginTransaction();
        try {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:members,email',
                'mobile' => 'required|digits:10|unique:members,mobile',
                'address' => 'required',
                'state' => 'required',
                'city' => 'required',
                'pincode' => 'required'

            ], [
                'email.unique' => 'This email is already registered.',
                'mobile.unique' => 'This mobile number is already registered.',
            ]);


            $guid = Str::uuid();
            $Main_parent_id = 0;
            $Parent_id      = 0;
            $iOrderType     = 3; // default


            if ($request->Guid) {
                $users = Users::where('Guid', $request->Guid)->first();

                if ($users) {
                    $Main_parent_id = $users->Main_parent_id;
                    $Parent_id      = $users->Users_id;
                    $iOrderType     = 2; // 👉 If Guid found, set order type 3
                } else {
                    return back()->withErrors("Guid not found in Users table")->withInput();
                }
            }

            // $password = Str::password(12);
            // $hashedPassword = Hash::make($password);
            // $member = Member::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'mobile' => $request->mobile,
            //     'address' => $request->address,
            //     'state' => $request->state,
            //     'city' => $request->city,
            //     'pincode' => $request->pincode,
            //     'iStatus' => 1,
            //     'strIP' => $request->ip(),
            //     'created_at' => now(),
            //     'password' => $hashedPassword,
            // ]);

            $Order = array(
                'iUserId' => $Parent_id ?? '0',
                'memberid' => $member->id ?? '0',
                'iOrderType' => $iOrderType,
                'iPlanId' => $request->plan_id,
                'iExtraMember' => $request->extra_memeber,
                'iamountExtraMember' => $request->extra_amount_per_person,
                'iPlanMembers' => $request->plan_member,
                'PlanAmount' => $request->plan_amount,
                'NetAmount' => $request->net_amount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'main_parent_id' => $Main_parent_id ?? '0',
                'parent_id' => $Parent_id ?? '0',
                'Guid' => $guid,
                'Name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'created_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip()
            );
            $OrderId = DB::table('Corporate_Order')->insertGetId($Order);
            return redirect()->route('razorpay.index', $OrderId);
        } catch (\Throwable $th) {

            // Rollback & Return Error Message
            DB::rollBack();
            return redirect()->back()
                ->withErrors($th->getMessage())
                ->withInput();
        }
    }

    public function Partner_sendmail(Request $request)
    {
        try {
            $name = $request->name;
            $email = $request->email;
            $mobile = $request->mobile;
            $messageContent = $request->message;
            $subjectCode = $request->subject;

            switch ($subjectCode) {
                case 1:
                    $subject = 'Lab Partnership';
                    break;
                case 2:
                    $subject = 'Corporate Collaboration';
                    break;
                case 3:
                    $subject = 'Pharmacy Collaboration';
                    break;
                case 4:
                    $subject = 'Investment Opportunities';
                    break;
                case 5:
                    $subject = 'Other';
                    break;
                default:
                    $subject = 'Not Found';
            }

            $sendEmailDetails = DB::table('sendemaildetails')->where(['id' => 9])->first();

            $msg = [
                'FromMail' => $sendEmailDetails->strFromMail,
                'Title' => $sendEmailDetails->strTitle,
                'ToEmail' => $email, // You can change this to your admin email if needed
                'Subject' => $sendEmailDetails->strSubject ?? $subject,
            ];

            $data = [
                'Name' => $name,
                'Email' => $email,
                'Mobile' => $mobile,
                'Message' => $messageContent,
                'Subject' => $subject
            ];

            Mail::send('emails.partnerwithusemail', ['data' => $data], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->subject($msg['Subject']);
            });
            return redirect()->back();
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function B2BLogin(Request $request)
    {
        try {
            return view('frontview.B2bLogin');
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function CorporateLogin(Request $request)
    {
        try {
            return view('frontview.Admin');
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function AccessibleServices(Request $request)
    {
        try {

            $ourpartners = Ourclient::get();
            return view('frontview.AccessibleServices', compact('ourpartners'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function Service(Request $request)
    {
        try {
            return view('frontview.Service');
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function ContactUs(Request $request)
    {
        try {
            $faqs = FaqMaster::where('type', 2)->get();
            return view('frontview.ContactUs', compact('faqs'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function Corporate(Request $request)
    {
        try {
            $Ourclients = Ourclient::take(12)->get();
            return view('frontview.Corporate', compact('Ourclients'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function ContactUs_sendmail(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'mobile' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required',
                'terms' => 'accepted',
            ], [
                'terms.accepted' => 'Please accept Terms & Conditions.',
            ]);
            $name = $request->name;
            $email = $request->email;
            $mobile = $request->mobile;
            $messageContent = $request->message;
            $subject = $request->subject;
            $sendEmailDetails = DB::table('sendemaildetails')->where(['id' => 4])->first();

            $msg = [
                'FromMail' => $sendEmailDetails->strFromMail,
                'Title' => $sendEmailDetails->strTitle,
                'ToEmail' => 'ai.dev.laravel10@gmail.com',
                'Subject' => $sendEmailDetails->strSubject ?? $subject,
            ];

            $data = [
                'Name' => $name,
                'Email' => $email,
                'Mobile' => $mobile,
                'Message' => $messageContent,
                'Subject' => $subject
            ];

            Mail::send('emails.contactemail', ['data' => $data], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->subject($msg['Subject']);
            });
            return redirect()->back();
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
