<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\LabTestMaster;
use App\Models\LabMaster;
use App\Models\LabTestCategory;
use App\Models\Plan;
use App\Models\LabTestRportAmount;
use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;



class LabTestReportAmountController extends Controller

{

    public function index(Request $request)
    {
        try {
            $LabMaster = LabMaster::orderBy('name', 'asc')->get();
            $LabTestCategory = LabTestCategory::orderBy('name', 'asc')->get();
            $Plan = Plan::orderBy('name', 'asc')->get();

            $query = LabTestRportAmount::with('labcategory', 'labtestmaster', 'labmaster', 'plan');

            if ($request->filled('Labmasid')) {
                $query->where('Lab_Master_id', $request->Labmasid);
            }

            if ($request->filled('Labcatid')) {
                $query->where('Lab_Test_category_id', $request->Labcatid);
            }

            if ($request->filled('planid')) {
                $query->where('planId', $request->planid);
            }

            $LabTestRportAmount = $query->paginate(config('app.per_page'));

            return view('LabTestReportAmount.index', compact('LabTestRportAmount', 'LabMaster', 'LabTestCategory', 'Plan'))
                ->with([
                    'Labmasid' => $request->Labmasid,
                    'Labcatid' => $request->Labcatid,
                    'planid' => $request->planid
                ]);
        } catch (\Throwable $th) {
            \Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function add(Request $request)
    {

        try {
            $Labmasid = $request->Labmasid;
            $Labcatid = $request->Labcatid;
            $planid = $request->planid;


            $LabMaster = LabMaster::orderBy('name', 'asc')->get();
            $LabTestCategory = LabTestCategory::orderBy('name', 'asc')->get();
            $Plan = Plan::orderBy('name', 'asc')->get();
            // $results = DB::table('Lab_Test_Master as ltm')
            //     ->leftJoin('Lab_Test_Report_Amount as ltra', function ($join) use ($Labmasid, $Labcatid, $planid) {
            //         $join->on('ltm.Lab_Test_Master_id', '=', 'ltra.Lab_Test_Master_id');

            //         if ($Labmasid) {
            //             $join->orwhere('ltra.Lab_Master_id', '=', $Labmasid);
            //         }

            //         if ($Labcatid) {
            //             $join->orwhere('ltra.Lab_Test_category_id', '=', $Labcatid);
            //         }

            //         if ($planid) {
            //             $join->orwhere('ltra.planId', '=', $planid);
            //         }
            //     })
            //     ->leftJoin('plans as p', 'ltra.planId', '=', 'p.id')
            //     ->leftJoin('Lab_Master as lab_m', 'ltra.Lab_Master_id', '=', 'lab_m.Lab_Master_id')
            //     ->select(
            //         'ltm.Lab_Test_Master_id',
            //         'ltm.Test_Name',
            //         'ltm.lab_test_category_id',
            //         'ltm.MRP as master_mrp',
            //         'ltra.Lab_Test_Report_Amount_id',
            //         'ltra.MRP',
            //         'ltra.Discount',
            //         'ltra.DiscountAmount',
            //         'ltra.NetAmount',
            //         'p.id as plan_id',
            //         'lab_m.Lab_Master_id as Lab_Master_id'
            //     )
            //     ->where('ltm.isDelete', 0)
            //     ->tosql();



            $result = DB::table(DB::raw('(SELECT Lab_Test_Master_id, Test_Name, lab_test_category_id, MRP as master_mrp, isDelete FROM Lab_Test_Master) as tb1'))
                ->leftJoin('Lab_Test_Report_Amount as ltra', 'tb1.Lab_Test_Master_id', '=', 'ltra.Lab_Test_Master_id')
                ->leftJoin('Lab_Master as lab_m', 'ltra.Lab_Master_id', '=', 'lab_m.Lab_Master_id')
                ->leftJoin('plans as p', 'ltra.planId', '=', 'p.id')
                ->select(
                    'tb1.*',
                    'ltra.Lab_Test_Report_Amount_id',
                    'ltra.MRP',
                    'ltra.Discount',
                    'ltra.DiscountAmount',
                    'ltra.NetAmount',
                    'p.id as plan_id',
                    'lab_m.Lab_Master_id as Lab_Master_id'
                );
            if (isset($Labmasid) && $Labmasid != "") {
                $result->Where('ltra.Lab_Master_id', $Labmasid);
            }
            if (isset($Labcatid) && $Labcatid != "") {
                $result->Where('tb1.lab_test_category_id', $Labcatid);
            }
            if (isset($planid) && $planid != "") {
                $result->Where('ltra.planId', $planid);
            }
            $results = $result->where('tb1.isDelete', 0)
                ->get();
            //->toSql();
            // dd($results);

            return view('LabTestReportAmount.add', compact('results', 'LabMaster', 'LabTestCategory', 'Plan', 'Labmasid', 'Labcatid', 'planid'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $Lab_Master_id = $request->Lab_Master_id;
            $Lab_Test_category_id = $request->Lab_Test_category_id;
            $planId = $request->planId;

            // Step 1: Delete existing records for this Lab + Category + Plan
            \App\Models\LabTestRportAmount::where('Lab_Master_id', $Lab_Master_id)
                ->where('Lab_Test_category_id', $Lab_Test_category_id)
                ->where('planId', $planId)
                ->delete();

            // Step 2: Insert new records
            $Lab_Master_ids = $request->Lab_Master_id;
            $Lab_Test_category_ids = $request->Lab_Test_category_id;
            $planIds = $request->planId;
            $testIds = $request->Lab_Test_Master_id;
            $mrps = $request->MRP;

            $discounts = $request->Discount;
            $discountAmounts = $request->DiscountAmount;
            $netamount = $request->NetAmount;


            foreach ($testIds as $index => $testId) {
                \App\Models\LabTestRportAmount::create([
                    'Lab_Master_id' => $Lab_Master_ids[$index],
                    'Lab_Test_category_id' => $Lab_Test_category_ids[$index],
                    'planId' => $planIds[$index],
                    'Lab_Test_Master_id' => $testId,
                    'MRP' => $mrps[$index],
                    'Discount' => $discounts[$index] ?? 0,
                    'DiscountAmount' => $discountAmounts[$index] ?? 0,
                    'NetAmount' => $netamount[$index] ?? 0,

                ]);
            }
            DB::commit();
            Toastr::success('Lab Test Report Amount created successfully :)', 'Success');

            return redirect()->route('lab_test_report_amount.index');
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
            $LabTestRportAmount = LabTestRportAmount::where('Lab_Test_Report_Amount_id', $request->id)->first();
            return json_encode($LabTestRportAmount);
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

                'MRP' => 'required',
                'Edit_Discount' => 'required',
                'Edit_Discount_Amount' => 'required',

            ]);
            LabTestRportAmount::where(['Lab_Test_Report_Amount_id' => $request->Lab_Test_Report_Amount_id])->update([

                'Discount' => $request->Edit_Discount,
                'DiscountAmount' => $request->Edit_Discount_Amount,
                'updated_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Lab Test Report Amount updated successfully :)', 'Success');

            // return back();
            return redirect()->route('lab_test_report_amount.index');
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

            Toastr::error('Error: ' . $th->getMessage());

            return redirect()->back()->withInput();
        }
    }



    public function delete(Request $request)

    {

        DB::beginTransaction();
        try {

            LabTestRportAmount::where(['iStatus' => 1, 'isDelete' => 0, 'Lab_Test_Report_Amount_id' => $request->id])->delete();
            DB::commit();
            Toastr::success('Lab Test Report Amount deleted successfully :)', 'Success');
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

            $ids = $request->input('Lab_Test_Report_Amount_ids', []);

            LabTestRportAmount::whereIn('Lab_Test_Report_Amount_id', $ids)->delete();

            Toastr::success('Lab Test Report Amount deleted successfully :)', 'Success');

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
