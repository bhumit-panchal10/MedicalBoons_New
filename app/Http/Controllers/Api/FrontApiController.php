<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssociatedMember;
use App\Models\Services;
use App\Models\Banner;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use GuzzleHttp\Client;
use App\Models\BaseURL;
use App\Models\CorporateOrder;
use App\Models\LabTestCategory;
use App\Models\LabTestMaster;
use App\Models\LabTestRportAmount;
use App\Models\LabReportRequestMaster;
use App\Models\LabReportRequestdetail;
use Razorpay\Api\Api;
use App\Models\FamilyMember;

use App\Models\Payment;
use App\Models\LabMaster;
use App\Models\LabReportRequestTemp;
use App\Models\Ledger;
use App\Models\Member;
use App\Models\Plan;
use App\Models\SubService;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class FrontApiController extends Controller
{


    public function servicelist(Request $request)
    {
        try {
            $listOfservice = Services::select(
                "id",
                "name",
                "description",
                "photo"
            )->where(['iStatus' => 1, 'isDelete' => 0])
                ->orderBy('name', 'asc')
                ->get();

            // Map photo URL
            $listOfservice = $listOfservice->map(function ($service) {
                $service->photo = $service->photo
                    ? url('/upload/Service/' . $service->photo)
                    : null;
                return $service;
            });

            return response()->json([
                'success' => true,
                'message' => "successfully fetched ServiceList...",
                'data' => $listOfservice,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function Bannerlist(Request $request)
    {
        try {
            $listOfbanner = Banner::select(
                "id",
                "title",
                "image"
            )
                ->orderBy('title', 'asc')
                ->get();

            // Map photo URL
            $listOfbanner = $listOfbanner->map(function ($banner) {
                $banner->image = $banner->image
                    ? url('/upload/Banner/' . $banner->image)
                    : null;
                return $banner;
            });

            return response()->json([
                'success' => true,
                'message' => "successfully fetched BannerList...",
                'data' => $listOfbanner,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function Planoverview(Request $request)
    {
        try {
            $request->validate([
                'member_id' => 'required'
            ]);
            $member = Member::where('id', $request->member_id)->first();
            if (!$member) {
                return response()->json(['success' => false, 'message' => 'Member not found'], 404);
            }

            $orderId  = $member->Order_id;
            $order = CorporateOrder::with('plan')->where('Corporate_Order_id', $orderId)->get();
            
            $LabReportRequestMasters = LabReportRequestMaster::where('member_id', $request->member_id)->get();  // Use get() for multiple records
            $usedwalletbalance = $LabReportRequestMasters->sum('discount_amount');  // Sum all discount_amount values

            
            $formatted = $order->map(function ($item) use ($usedwalletbalance) {
                $expiryDate = $item->end_date;
                $planFlag = ($expiryDate && $expiryDate >= now()->toDateString()) ? 1 : 0;
                $extraMember = $item->iExtraMember ?? 0;
                $extraMemberwalletbal = $item->plan->extra_amount_per_person_in_wallet ?? 0;
                $extramemamount = $extraMember * $extraMemberwalletbal;

                return [
                    'name' => $item->plan->name ?? null,
                    'wallet_balance' => $item->plan->wallet_balance + $extramemamount ?? null,
                    'Order_id' => $item->Corporate_Order_id,
                    'expiry_date' => $item->end_date ?? null,
                    'plan_flag' => $planFlag,
                    'plan_detail_pdf' => $item->plan && $item->plan->plan_detail_pdf
                        ? 'https://medicalboons.com/upload/plan-detail-pdf/' . $item->plan->plan_detail_pdf
                        : null,
                    'used_wallet_balance' => $usedwalletbalance,  // Include the total wallet balance
                ];
            })->first();
            return response()->json([
                'success' => true,
                'message' => "successfully fetched plan...",
                'data' => $formatted

            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function Plandashboard(Request $request)
    {
        try {
            $request->validate([
                'member_id' => 'required',
                'Order_id' => 'required',
            ]);
            $member = Member::where('id', $request->member_id)->first();
            if (!$member) {
                return response()->json(['success' => false, 'message' => 'Member not found'], 404);
            }

            $Appoitment = LabReportRequestMaster::where('member_id', $request->member_id)->count();
            $balances = DB::table('ledger')
                ->select([
                    DB::raw('(SELECT openingBalance FROM ledger AS l WHERE l.id = (SELECT MIN(id) FROM ledger WHERE order_id = ' . $request->Order_id . ')) AS openingBalance'),
                    DB::raw('(SELECT closingBalance FROM ledger AS l1 WHERE l1.id = (SELECT MAX(id) FROM ledger WHERE order_id = ' . $request->Order_id . ')) AS closingBalance')
                ])
                ->where('order_id', $request->Order_id)
                ->orderByDesc('id')
                ->limit(1)
                ->first();

            return response()->json([
                'success' => true,
                'message' => "successfully fetched listOffamilymemb...",
                'wallet_balance' => $balances->openingBalance ?? '0',
                'last_wallet_balance' => $balances->closingBalance ?? '0',
                'Appoitment' => $Appoitment ?? '0',

            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function SubService(Request $request)
    {
        try {
            $request->validate([
                'service_id' => 'required'
            ]);
            $listOfsubservice = SubService::where('service_id', $request->service_id)->get();

            return response()->json([
                'success' => true,
                'message' => "successfully fetched listOfsubservice...",
                'data' => $listOfsubservice,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function AssociatedMember(Request $request)
    {
        try {
            
            $request->validate([
                'subservice_id' => 'nullable',
            ]);
    
            $listOfAssociatedMember = AssociatedMember::with('subservices')
                ->where('sub_service_id', $request->subservice_id)
                ->get();
            if ($listOfAssociatedMember->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No associated members found.',
                ], 404);
            }

            $data = [];
            foreach ($listOfAssociatedMember as $member) {
                $data[] = [
                    "id" => $member->id,
                    "service_id" => $member->service_id,
                    "sub_service_id" => $member->sub_service_id,
                    "dr_name" => $member->dr_name,
                    "degree" => $member->degree,
                    "address_1" => $member->address_1,
                    "address_2" => $member->address_2,
                    "about_dr_or_clinic" => $member->about_dr_or_clinic,
                ];
            }
    
    
            return response()->json([
                'success' => true,
                'message' => "Successfully fetched associated members.",
                'data' => $data,
            ], 200);
    
        } catch (\Throwable $th) {
            
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    public function ExtraMemberamountcalculate(Request $request)
    {
        try {

            $request->validate([
                'plan_amount' => 'required',
                'Extra_Member' => 'required',
                'extra_amount_per_person' => 'required',
            ]);

            $extraamount = $request->extra_amount_per_person * $request->Extra_Member;
            $netamount = $request->plan_amount + $extraamount;
            return response()->json([
                'success' => true,
                'message' => "successfully fetched NetAmount...",
                'NetAmount' => $netamount,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    public function Lablist(Request $request)
    {
        try {

            $listofLab = LabMaster::get();
            return response()->json([
                'success' => true,
                'message' => "successfully fetched listofLab...",
                'data' => $listofLab,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function Planlist(Request $request)
    {
        try {
            $request->validate([
                'member_id' => 'required'
            ]);

            // Fetch member
            $Member = Member::where('id', $request->member_id)->first();
            if (!$Member) {
                return response()->json([
                    'success' => false,
                    'message' => 'Member not found'
                ], 404);
            }

            $orderid = $Member->Order_id;
            // Get Corporate Order
            $CorporateOrder = CorporateOrder::where('Corporate_Order_id', $orderid)->first();
            if (!$CorporateOrder) {
                return response()->json([
                    'success' => false,
                    'message' => 'Corporate order not found'
                ], 404);
            }

            // Get Plan
            $Plan = Plan::get();
            if (!$Plan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Plan not found'
                ], 404);
            }

            // Prepare single item array as list
           $data = $Plan->map(function ($p) use ($CorporateOrder) {
            return [
                'id' => $p->id,
                'sequence_no' => $p->sequence_no,
                'name' => $p->name,
                'amount' => $p->amount,
                'duration_in_days' => $p->duration_in_days,
                'plan_image' => 'https://medicalboons.com/upload/plan-images/'.$p->plan_image ?? '',
                'plan_detail_pdf' => $p->plan_detail_pdf ? 'https://medicalboons.com/upload/plan-detail-pdf/'.$p->plan_detail_pdf : '',

                'no_of_members' => $p->no_of_members,
                'terms_and_condition' => $p->terms_and_condition,
                'wallet_balance' => $p->wallet_balance,
                'extra_amount_per_person' => $p->extra_amount_per_person,
                'extra_amount_per_person_in_wallet' => $p->extra_amount_per_person_in_wallet,
                'lab_max_applicable_amount_each_time' => $p->lab_max_applicable_amount_each_time,
                'lab_minimum_order_value' => $p->lab_minimum_order_value,
                'lab_special_terms_and_condition' => $p->lab_special_terms_and_condition,
                'iStatus' => $p->iStatus,
                'isDelete' => $p->isDelete,
                'created_at' => $p->created_at,
                'updated_at' => $p->updated_at,
                'strIP' => $p->strIP,
                'slugname' => $p->slugname,
        
                // same order fields for each item
                'start_date'  => $CorporateOrder->start_date,
                'end_date'    => $CorporateOrder->end_date,
                'iExtraMember'=> $CorporateOrder->iExtraMember ?? 0,
            ];
        })->values();

            return response()->json([
                'success' => true,
                'message' => 'Successfully fetched plan...',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }
    }


    public function LabTestCategory(Request $request)
    {
        try {
            $listOflabtestcategory = LabTestCategory::select(
                "Lab_Test_Category_id",
                "name",
                "display_priority",
                "description"
            )->where(['iStatus' => 1, 'isDelete' => 0])
                ->orderBy('name', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'message' => "successfully fetched ServiceList...",
                'data' => $listOflabtestcategory,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function familyMemberlist(Request $request)
    {
        try {
            $request->validate([
                'member_id' => 'required'
            ]);
            $listOffamilymemb = FamilyMember::where(['member_id' => $request->member_id,'active_inactive' => 0])->get();

            return response()->json([
                'success' => true,
                'message' => "successfully fetched listOffamilymemb...",
                'data' => $listOffamilymemb,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function searchLabTests(Request $request)
    {
        try {
            $query = LabTestMaster::with('labcategory')
                ->where('isDelete', 0); // Only non-deleted records

            // Filter by category if provided
            if ($request->has('lab_test_category_id') && !empty($request->lab_test_category_id)) {
                $query->where('lab_test_category_id', $request->lab_test_category_id);
            }

            // Filter by Test_Name if provided
            if ($request->has('Test_Name') && !empty($request->Test_Name)) {
                $query->where('Test_Name', 'like', '%' . $request->Test_Name . '%');
            }

            $results = $query->orderBy('Test_Name', 'asc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Lab test list fetched successfully.',
                'data' => $results
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function AddfamilyMember(Request $request)
    {
        try {
            $request->validate([
                "member_id" => 'required',
                "member_name" => 'required',
                "DOB" => 'required',
                "gender" => 'required'

            ]);

            $addfamilymember = FamilyMember::create([
                'member_name' => $request->member_name,
                'member_id' => $request->member_id,
                'DOB' => $request->DOB,
                'gender' => $request->gender,
                'created_at' => now()

            ]);

            return response()->json([
                'success' => true,
                'data' => $addfamilymember,
                'message' => 'Family Member Added Successfully',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function AddLabTest(Request $request)
    {
        try {
            $request->validate([
                "member_id" => 'required',
                "family_member_id" => 'nullable',
                "lab_test_id" => 'required'

            ]);

            $AddLabTest = LabReportRequestTemp::create([
                'member_id' => $request->member_id,
                'family_member_id' => $request->family_member_id,
                'lab_test_id' => $request->lab_test_id,
                'created_at' => now()

            ]);

            return response()->json([
                'success' => true,
                'data' => $AddLabTest,
                'message' => 'Add Lab Test Added Successfully',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    // public function LabTestList(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'member_id' => 'required'
    //         ]);
    //         $member = Member::where('id', $request->member_id)->first();
    //         if (!$member) {
    //             return response()->json(['success' => false, 'message' => 'Member not found'], 404);
    //         }

    //         $orderId  = $member->Order_id;
            
    //         $corporateOrder = CorporateOrder::where('Corporate_Order_id', $orderId)->first();
    //         $plan = Plan::where('id', $corporateOrder->iPlanId)->first();
    //         $walletbal = $plan->wallet_balance ?? 0;

    //         $LabReportRequestTemps = LabReportRequestTemp::where('member_id', $request->member_id)->get();
    //         $usedWalletBalance = $LabReportRequestTemps->sum('discount_amount'); // Sum all discount_amount values

            
    //         $latestLedger = Ledger::where('order_id', $orderId)->orderByDesc('id')->first();
    //         $listOffamilymemb = LabReportRequestTemp::with('labtestmaster', 'familymembername')->where('member_id', $request->member_id)->get();

    //         $formatted = $listOffamilymemb->map(function ($item) {
    //             return [
    //                 'Lab_Test_Master_id' => $item->labtestmaster->Lab_Test_Master_id ?? null,
    //                 'lab_test_name' => $item->labtestmaster->Test_Name ?? null,
    //                 'family_member_name' => $item->familymembername->member_name ?? null,
    //                 'family_member_id' => $item->familymembername->family_member_id ?? null,
    //                 'lab_report_temp_id' => $item->LabReport_Request_temp_id,
    //                 // Add any other fields from LabReportRequestTemp if needed
    //             ];
    //         });
    //         return response()->json([
    //             'success' => true,
    //             'message' => "successfully fetched listOffamilymemb...",
    //             'data' => $formatted,
    //             'wallet_balance' => $walletBalance ?? '',
    //             'used_wallet_balance' => $usedWalletBalance // Include used wallet balance here

    //         ], 200);
    //     } catch (\Throwable $th) {
    //         return response()->json(['error' => $th->getMessage()], 500);
    //     }
    // }
    
    public function LabTestList(Request $request)
    {
    try {
        // Validate input
        $request->validate([
            'member_id' => 'required'
        ]);

        // Fetch the member
        $member = Member::where('id', $request->member_id)->first();
        if (!$member) {
            return response()->json(['success' => false, 'message' => 'Member not found'], 404);
        }

        // Get the Corporate Order associated with the member
        $orderId = $member->Order_id;
        $corporateOrder = CorporateOrder::with('plan')->where('Corporate_Order_id', $orderId)->first();
        
        // If no corporate order is found, return error
        if (!$corporateOrder) {
            return response()->json(['success' => false, 'message' => 'Corporate Order not found'], 404);
        }

        // Get the plan details
        $plan = $corporateOrder->plan;
        $walletBalance = $plan->wallet_balance ?? 0;

        // Get the extra member wallet balance (if any)
        $extraMember = $corporateOrder->iExtraMember ?? 0;
        $extraMemberWalletBal = $plan->extra_amount_per_person_in_wallet ?? 0;
        $extraMemberAmount = $extraMember * $extraMemberWalletBal;

        // Calculate the total wallet balance (plan balance + extra member amount)
        $totalWalletBalance = $walletBalance + $extraMemberAmount;

        // Fetch LabReportRequestMasters (use get() to fetch all)
        $LabReportRequestMasters = LabReportRequestMaster::where('member_id', $request->member_id)->get();

        // Calculate the used wallet balance (sum of all discount_amount values)
        $usedWalletBalance = $LabReportRequestMasters->sum('discount_amount');
        $listOffamilymemb = LabReportRequestTemp::with('labtestmaster', 'familymembername')->where('member_id', $request->member_id)->get();
       
        // Format the LabReportRequestMasters data
        $formattedLabTests = $listOffamilymemb->map(function ($item) {
            return [
                'Lab_Test_Master_id' => $item->labtestmaster->Lab_Test_Master_id ?? null,
                'lab_test_name' => $item->labtestmaster->Test_Name ?? null,
                'family_member_name' => $item->familymembername->member_name ?? null,
                'family_member_id' => $item->familymembername->family_member_id ?? null,
                'lab_report_temp_id' => $item->LabReport_Request_temp_id,
                // Add any other fields from LabReportRequestMaster if needed
            ];
        });

        // Return the response with formatted lab test data, wallet balance, and used wallet balance
        return response()->json([
            'success' => true,
            'message' => "Successfully fetched lab test list...",
            'data' => $formattedLabTests,
            'wallet_balance' => $totalWalletBalance,  // Total wallet balance
            'used_wallet_balance' => $usedWalletBalance // Used wallet balance
        ], 200);
        
    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()], 500);
    }
}


    public function LabTestDelete(Request $request)
    {
        try {
            $request->validate([

                "lab_report_temp_id" => 'required'
            ]);
            $LabReportRequestTemp = LabReportRequestTemp::where('LabReport_Request_temp_id', $request->lab_report_temp_id);


            if ($LabReportRequestTemp) {
                // Delete the deal option
                $LabReportRequestTemp->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Lab Test Deleted Successfully',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Lab Test not found',
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function deletefamilyMember(Request $request)
    {
        try {
            $request->validate([

                "family_member_id" => 'required'
            ]);
            $familymember = FamilyMember::find($request->family_member_id);


            if ($familymember) {
                // Delete the deal option
                $familymember->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Family Member Deleted Successfully',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Family Member not found',
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function CompareLabList(Request $request)
    {
        try {
            // Validate incoming request data
            $request->validate([
                'member_id' => 'required',
                'labtestmasterid' => 'required'
            ]);

            // Fetch member details based on member_id
            $listOfmember = Member::findOrFail($request->member_id);
            $orderid = $listOfmember->Order_id ?? 0;

            // Fetch corporate order based on order_id
            $corporateorder = CorporateOrder::where('Corporate_Order_id', $orderid)->first();
            $customerplanid = $corporateorder->iPlanId ?? 0;
            $data = DB::table('Lab_Test_Report_Amount as ltra')
                ->select(
                    DB::raw('SUM(MRP) as total_mrp'),
                    DB::raw('SUM(DiscountAmount) as total_discount'),
                    DB::raw('SUM(NetAmount) as total_net_amount'),
                    DB::raw('(SELECT name FROM Lab_Master WHERE Lab_Master_id = ltra.Lab_Master_id) as labname')
                )
                ->whereIn('Lab_Test_Master_id', explode(',', $request->labtestmasterid))
                ->groupBy('Lab_Master_id')
                ->get();

            $results = $data->map(function ($item) {
                return [
                    'labname' => $item->labname,
                    'total_mrp' => $item->total_mrp,
                    'total_discount' => $item->total_discount,
                    'total_net_amount' => $item->total_net_amount,
                ];
            });

            // Return the response with lab test data
            return response()->json([
                'success' => true,
                'message' => "Successfully fetched list of lab tests.",
                'data' => $results,
            ], 200);

        } catch (\Throwable $th) {
            // Handle errors gracefully
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    //   public function Labwise_disornetamount(Request $request)
    //   {
    //     try {
    //         $request->validate([
    //             'lab_id'           => 'required|integer',
    //             'labtestmasterid'  => 'required' // e.g. "145,145,146"
    //         ]);

    //         // Parse and count occurrences (quantities) of each test id
    //         $ids      = array_filter(array_map('trim', explode(',', $request->labtestmasterid)));
    //         $counts   = array_count_values($ids);               // [145 => 2, 146 => 1]
    //         $uniqueIds = array_keys($counts);                   // [145, 146]

    //         // Fetch prices/discounts once per unique test id
    //         $rows = LabTestRportAmount::where('Lab_Master_id', $request->lab_id)
    //             ->whereIn('Lab_Test_Master_id', $uniqueIds)
    //             ->get(['Lab_Test_Master_id','MRP','DiscountAmount','NetAmount']);

    //         // Weight sums by the quantity for each id
    //         $totalMrp = $totalDiscount = $totalNet = 0;
    //         foreach ($rows as $row) {
    //             $q = $counts[$row->Lab_Test_Master_id] ?? 1;
    //             $totalMrp      += ($row->MRP ?? 0) * $q;
    //             $totalDiscount += ($row->DiscountAmount ?? 0) * $q;
    //             $totalNet      += ($row->NetAmount ?? 0) * $q;
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Lab test amount summary',
    //             'data' => [
    //                 'total_mrp'             => $totalMrp,
    //                 'total_discount_amount' => $totalDiscount,
    //                 'total_net_amount'      => $totalNet,
    //             ]
    //         ], 200);

    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error fetching lab amount summary',
    //             'error'   => $th->getMessage()
    //         ], 500);
    //     }
    // }


    public function Labwise_disornetamount(Request $request)
    {
        try {
            $request->validate([
                'lab_id'          => 'required|integer',
                'labtestmasterid' => 'required',
                'member_id' => 'required',
                'family_member_id' => 'required',
            ]);

            $VISIT_CHARGE      = 100;   // flat visit fee
            $MIN_PAYABLE_FLOOR = 700;   // minimum payable before visit fee

            // Parse and count test ids
            $ids       = array_filter(array_map('trim', explode(',', $request->labtestmasterid)));

            $counts    = array_count_values($ids);
            $uniqueIds = array_keys($counts);
            $rows = LabTestRportAmount::where('Lab_Master_id', $request->lab_id)
                ->whereIn('Lab_Test_Master_id', $uniqueIds)
                ->get(['Lab_Test_Master_id', 'MRP', 'DiscountAmount']);

            $totalMrp = 0.0;
            $totalRoutineDiscount = 0.0;

            foreach ($rows as $row) {
                $q = $counts[$row->Lab_Test_Master_id] ?? 1;
                $totalMrp             += ($row->MRP ?? 0) * $q;
                $totalRoutineDiscount += ($row->DiscountAmount ?? 0) * $q;
            }

            $totalTests = array_sum($counts);

            // Special discount formula: (tests - 1) * 100
            $specialDiscount = max(0, ($totalTests - 1) * 100);

            $netAfterDiscounts = $totalMrp - ($totalRoutineDiscount + $specialDiscount);
            // If net < 700, add visit charge
            $finalPayable = $netAfterDiscounts < $MIN_PAYABLE_FLOOR
                ? $netAfterDiscounts + $VISIT_CHARGE
                : $netAfterDiscounts;
                
            $familymember = FamilyMember::where('family_member_id', $request->family_member_id)
                ->first();
            if (!$familymember) {
                return response()->json([
                    'success' => false,
                    'message' => 'Family Member not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Lab test amount summary',
                'data' => [
                    'total_tests_selected'   => $totalTests,
                    'discount_apply'   => $familymember->discount_apply,
                    'labMinimumOrderValue' => $MIN_PAYABLE_FLOOR,
                    'total_mrp'              => round($totalMrp, 2),
                    'routine_discount'       => round($totalRoutineDiscount, 2),
                    'special_discount'       => round($specialDiscount, 2),
                    'net_after_discounts'    => round($netAfterDiscounts, 2),
                    'visit_charge'         => ($netAfterDiscounts < $MIN_PAYABLE_FLOOR ? $VISIT_CHARGE : 0),
                    'final_payable'          => round($finalPayable, 2),
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching lab amount summary',
                'error'   => $th->getMessage()
            ], 500);
        }
    }


    public function Customer_discountApply(Request $request)
    {
        try {
            $request->validate([
                'member_id'        => 'required|integer',
                'total_net_amount' => 'required|numeric|min:0',
                'family_member_id' => 'required|numeric|exists:family_member,family_member_id',
            ]);

            $member = Member::with('familyMembers')->find($request->member_id);
            if (!$member) {
                return response()->json(['success' => false, 'message' => 'Member not found'], 404);
            }

            $familymember = FamilyMember::where('family_member_id', $request->family_member_id)->first();
            if (!$familymember) {
                return response()->json(['success' => false, 'message' => 'Family Member not found'], 404);
            }
            $orderId = $member->Order_id;
            if (!$orderId) {
                return response()->json(['success' => false, 'message' => 'Order ID not found'], 404);
            }

            $corporateOrder = CorporateOrder::where('Corporate_Order_id', $orderId)->first();
          
            if (!$corporateOrder) {
                return response()->json(['success' => false, 'message' => 'Corporate Order not found'], 404);
            }
            $plan = Plan::find($corporateOrder->iPlanId);
            if (!$plan) {
                return response()->json(['success' => false, 'message' => 'Plan not found'], 404);
            }

            if ($familymember->discount_apply == 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Discount has already been applied to this family member.',
                ], 200);
            }

            // Check if the total amount meets the minimum order value
            $labMinimumOrderValue = (float) $plan->lab_minimum_order_value;
            $totalNetAmount = (float) $request->total_net_amount;
            if ($totalNetAmount < $labMinimumOrderValue) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not eligible to apply this discount.',
                ], 200);
            }

            $discountLimit = (float) $plan->lab_max_applicable_amount_each_time;
            
            $extramemberamount = $plan->extra_amount_per_person;
            $netAmount = $totalNetAmount - $extramemberamount;
        
            return response()->json([
                'success' => true,
                'message' => 'Discount applied successfully',
                'data' => [
                    'extramemberamount' => $extramemberamount,
                    'net_amount' => $netAmount,
                    'labMinimumOrderValue' => $labMinimumOrderValue,
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing discount',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    // public function Customer_discountApply(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'member_id' => 'required',
    //             'total_net_amount' => 'required|numeric'
    //         ]);

    //         $member = Member::with('familyMembers')->where('id', $request->member_id)->first();
    //         if (!$member) {
    //             return response()->json(['success' => false, 'message' => 'Member not found'], 404);
    //         }

    //         $orderId  = $member->Order_id;
    //         $corporateOrder = CorporateOrder::where('Corporate_Order_id', $orderId)->first();
    //         if (!$corporateOrder) {
    //             return response()->json(['success' => false, 'message' => 'Order not found'], 404);
    //         }

    //         $planId = $corporateOrder->iPlanId;
    //         $plan = Plan::find($planId);
    //         if (!$plan) {
    //             return response()->json(['success' => false, 'message' => 'Plan not found'], 404);
    //         }

    //         $labMinimumOrderValue = (float) $plan->lab_minimum_order_value;
    //         $discount = (float) $plan->lab_max_applicable_amount_each_time;

    //         $totalNetAmount = (float) $request->total_net_amount;

    //         if ($totalNetAmount < $labMinimumOrderValue) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'You are not applicable to apply this coupon.',
    //             ], 200);
    //         }

    //         // ✅ Ledger Management (get latest ledger entry)
    //         $latestLedger = Ledger::where('order_id', $orderId)->orderByDesc('id')->first();
    //         if (!$latestLedger) {
    //             return response()->json(['success' => false, 'message' => 'Wallet data not found'], 404);
    //         }

    //         $opening = (float) $latestLedger->closingBalance;

    //         if ($opening <= 0 || $opening < $discount) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Wallet discount off. Please recharge your wallet to avail discount.',
    //                 'data' => [
    //                     'opening_balance' => $opening,
    //                     'required_discount_amount' => $discount
    //                 ]
    //             ], 200);
    //         }

    //         // ✅ Apply Discount
    //         $applicableAmount = $discount;
    //         $netAmount = $totalNetAmount - $applicableAmount;
    //         $closing = $opening - $discount;

    //         // Save in LabReport_Request_Master
    //         DB::table('LabReport_Request_Master')->insert([
    //             'member_id' => $request->member_id,
    //             'discount_amount' => $applicableAmount,
    //             'NetAmount' => $netAmount,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);

    //         // Insert into ledger
    //         DB::table('ledger')->insert([
    //             'order_id' => $orderId,
    //             'openingBalance' => $opening,
    //             'dr' => $discount,
    //             'cr' => 0,
    //             'closingBalance' => $closing,
    //             'created_at' => now(),
    //             'updated_at' => now()
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Discount applied and ledger updated successfully',
    //             'data' => [
    //                 'discount_applied' => $applicableAmount,
    //                 'net_amount' => $netAmount,
    //                 'opening_balance' => $opening,
    //                 'closing_balance' => $closing

    //             ]
    //         ], 200);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Error processing discount',
    //             'error' => $th->getMessage()
    //         ], 500);
    //     }
    // }
    
    public function LabTestSubmit(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'member_id' => 'required',
                'lab_id' => 'required',
                'date' => 'required|date',
                'visit' => 'required',
                'total_amount' => 'nullable',
                'dis_amount' => 'nullable',
                'net_amount' => 'nullable',
                'special_discount' => 'nullable',
                'family_member_id' => 'required'
            ]);

            $tempTests = DB::table('LabReport_Request_temp')
                ->where('member_id', $request->member_id)
                ->get();

            if ($tempTests->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No lab test data found in temp table.'
                ], 404);
            }

            $masterId = DB::table('LabReport_Request_Master')
                ->insertGetId([
                    'Lab_id' => $request->lab_id,
                    'appointments_flag' => 2,
                    'date' => $request->date,
                    'visit' => $request->visit,
                    'total_amount' => $request->total_amount,
                    'discount_amount' => $request->dis_amount,
                    'NetAmount' => $request->net_amount,
                    'special_discount' => $request->special_discount,
                    'member_id' => $request->member_id,
                    'created_at' => now()
                ]);

            foreach ($tempTests as $temp) {
                DB::table('LabReport_Request_detail')->insert([
                    'LabReport_Request_Master_id' => $masterId,
                    'member_id' => $request->member_id,
                    'family_member_id' => $request->family_member_id ?? 0,
                    'Lab_test_master_id' => $temp->lab_test_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            DB::table('LabReport_Request_temp')
                ->where('member_id', $request->member_id)
                ->delete();
                
            FamilyMember::where('family_member_id', $request->family_member_id)
                ->update([
                    'discount_apply' => 1,
                ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Lab test(s) submitted successfully',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error processing lab test submission',
                'error' => $th->getMessage()
            ], 500);
        }
    }



    public function BookingTreatmentSubmit(Request $request)
    {
        try {
            $request->validate([
                'member_id' => 'required',
                'family_member_id' => 'required',
                'preference_date' => 'required',
                'preference_time' => 'required',
                'associated_id' => 'required'

            ]);

            $masterId = DB::table('LabReport_Request_Master')->insertGetId([
                'member_id' => $request->member_id,
                'associated_id' => $request->associated_id,
                'preference_date' => $request->preference_date,
                'preference_time' => $request->preference_time,
                'appointments_flag' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            LabReportRequestdetail::create([
                'member_id' => $request->member_id,         // optionally add if needed
                'family_member_id' => $request->family_member_id,
                'LabReport_Request_Master_id' => $masterId,                  // add test ID if needed
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Booking Treatment submitted successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing Booking Treatment submission',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function RenewPlan(Request $request)
    {
        try {
            $request->validate([
                'member_id' => 'required',
                'plan_id' => 'required',
                'extraMember' => 'nullable',
                'extra_amount_per_person' => 'required',
                'no_of_members' => 'required',
                'amount' => 'required',
                'net_amount' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',

            ]);
            $guid = Str::uuid();
            $extraamountperperson = $request->extraMember ?? '0' * $request->extra_amount_per_person ?? '0';
            $netamount = $request->amount + $extraamountperperson;

            $RenewPlan = DB::table('Corporate_Order')->insertGetId([
                'memberid' => $request->member_id,
                'iOrderType' => 2,
                'iPlanId' => $request->plan_id,
                'iExtraMember' => $request->extraMember,
                'iamountExtraMember' => $request->extra_amount_per_person,
                'iPlanMembers' => $request->no_of_members,
                'PlanAmount' => $request->amount,
                'NetAmount' => $request->net_amount ?? '0',
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'Guid' => $guid,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // dd($RenewPlan);
            FamilyMember::where('member_id', $request->member_id)
                    ->update(['active_inactive' => 1]);

            $order_id = $RenewPlan ?? '0';
            $CorporateOrder = CorporateOrder::where("Corporate_Order_id", $order_id)->first();

            $price = $CorporateOrder->NetAmount;
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            //dd(config('services.razorpay.secret'));
            $OrderAmount = $price * 100;
            $orderData = [
                'receipt'         => $order_id . '-' . date('dmYHis'),
                'amount'          => $OrderAmount,
                'currency'        => 'INR',
            ];
            $razorpayOrder = $api->order->create($orderData);
            $orderId = $razorpayOrder['id'];
            $data = array(
                'order_id' => $orderId,
                'oid' => $order_id,
                'amount' => $price,
                'currency' => 'INR',
                'receipt' => $razorpayOrder['receipt'],
            );
            Payment::insert($data);

            return response()->json([
                'success' => true,
                "razorpayResponse" => $data,
                'message' => 'Plan Renew successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing Plan Renew submission',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function paymentstatus(Request $request)
    {

         if ($request->status == "Success") {
            $request->validate([
                'razorpay_payment_id' => 'required',
                'order_id' => 'required',
                'razorpay_order_id' => 'required',
                'razorpay_signature' => 'required',
                'amount' => 'required',
                'member_id' => 'required',
                'currency' => 'required',
                'status' => 'required',
                'json' => 'required'
            ]);
        }

        // Validation for "Fail" status
        if ($request->status == "Fail") {
            $request->validate([
                'razorpay_payment_id' => 'nullable',
                'order_id' => 'required',
                'razorpay_order_id' => 'nullable',
                'razorpay_signature' => 'nullable',
                'amount' => 'required',
                'member_id' => 'required',
                'currency' => 'required',
                'status' => 'required',
                'json' => 'required'
            ]);
        }

             
         
        if ($request->status == "Success") {

            $data = array(
                'order_id' => $request->razorpay_payment_id,
                'oid' => $request->order_id,
                //'Customer_id' => $request->Customer_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature,
                'receipt' => $request->order_id . '-' . date('dmYHis'),
                'amount' => $request->amount,
                'currency' => $request->currency,
                'status' => $request->status,
                'json' => $request->json,
                'iPaymentType' => 1,
                "Remarks" => "Online Payment"
            );
            DB::table('card_payment')->insert($data);
            $updateProfileData = array(
                'isPayment' => 1
            );
            CorporateOrder::where("Corporate_Order_id", $request->order_id)->update($updateProfileData);
             // Update Member table
            $member = Member::where('id', $request->member_id)->first();
            $member->update(['Order_id' => $request->order_id]);
         
        } elseif ($request->status == "Fail") {
            
            $data = array(
                'order_id' => $request->razorpay_payment_id,
                'oid' => $request->order_id,
                // 'Customer_id' => $request->Customer_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature,
                'receipt' => $request->order_id . '-' . date('dmYHis'),
                'amount' => $request->amount,
                'currency' => $request->currency,
                'status' => $request->status,
                'json' => $request->json,
                'iPaymentType' => 1,
                "Remarks" => "Online Payment"
            );
            DB::table('card_payment')->insert($data);

            $updateProfileData = array(
                'isPayment' => 2
            );
            CorporateOrder::where("Corporate_Order_id", $request->order_id)->update($updateProfileData);
           return [
            'success' => false,
            'message' => "payment failed successfully."
        ];
        }
        return [
            'success' => true,
            'message' => "payment status updated successfully."
        ];
        // } catch (ValidationException $e) {
        //     return response()->json(['errors' => $e->errors()], 422);
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return response()->json(['error' => $th->getMessage()], 500);
        // }
    }


    public function AppointmentDisplay_DocorLabwise(Request $request)
    {
        try {
            $request->validate([
                'member_id' => 'required'
            ]);

            $member = Member::find($request->member_id);
            if (!$member) {
                return response()->json(['success' => false, 'message' => 'Member not found'], 404);
            }

            $allAppointments = LabReportRequestMaster::with([
                'family_membername',
                'AssociatedMember',
                'lab',
                'member',
                'labreqmasterdetail.family_member'
            ])
                ->where('member_id', $request->member_id)
                ->get();

            $associatedMemberAppointments = $allAppointments->where('appointments_flag', 1)->values(); // flag = 1
            $labWiseAppointments = $allAppointments->where('appointments_flag', 2)->values(); // flag = 2

            $mergedData = [];

            // ➤ Associated Member Appointments: One family member
            foreach ($associatedMemberAppointments as $appointment) {
                $firstDetail = $appointment->labreqmasterdetail->first();

                $mergedData[] = [
                    'type' => 'associated',
                    'preference_date' => $appointment->preference_date,
                    'preference_time' => $appointment->preference_time,
                    'DoctorName' => optional($appointment->AssociatedMember)->dr_name,
                    'family_member_name' => optional($firstDetail?->family_member)->member_name,
                ];
            }

            
            foreach ($labWiseAppointments as $lab) {
                // $memberNames = [];

                // foreach ($lab->labreqmasterdetail as $detail) {
                //     $memberNames[] = optional($detail->family_member)->member_name;
                // }
                $memberNames = $lab->labreqmasterdetail->first();


                $mergedData[] = [
                    'type' => 'lab',
                    'lab_name' => $lab->lab->name ?? '',
                    'member_name' => $lab->member->name ?? '',
                    'date' => $lab->date ?? '',
                    'family_member_names' => optional($memberNames?->family_member)->member_name, // multiple names
                ];
            }

            return response()->json([
                'success' => true,
                'message' => "Successfully fetched appointments.",
                'data' => $mergedData
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
