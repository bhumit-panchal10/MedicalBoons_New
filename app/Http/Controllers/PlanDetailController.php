<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Services;

use App\Models\SubService;

use App\Models\Plan;
use App\Models\PlanDetail;
use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;



class PlanDetailController extends Controller

{

    public function index(Request $request, $planid = 0)
    {
        try {

            $planid = $planid;
            $plandetails = PlanDetail::with('service')->select('*')
                ->where('plan_id', $planid)
                ->orderBy('id', 'desc')
                ->paginate(config('app.per_page'));

            return view('PlanDetail.index', compact('plandetails', 'planid'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function add(Request $request, $planid)
    {
        try {
            $planid = $planid;
            $Services = Services::get();
            $SubService = SubService::orderBy('subservice_name', 'asc')->get();
            return view('PlanDetail.add', compact('Services', 'planid', 'SubService'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function store(Request $request)

    {
        DB::beginTransaction();
        try {

            $request->validate([

                'service_id' => 'required',
                'valuation' => 'required',
                'amount' => 'required',
                'extra_amount' => 'required',
                'session_count' => 'required',
                'service_description' => 'required',
                'discount' => 'required',


            ]);

            $Plan = PlanDetail::create([

                'plan_id' => $request->planid ?? '0',
                'service_id' => $request->service_id ?? '0',
                'sub_service_id' => $request->sub_service_id ?? '0',
                'valuation' => $request->valuation,
                'amount' => $request->amount,
                'discount' => $request->discount,
                'extra_amount' => $request->extra_amount,
                'session_count' => $request->session_count,
                'service_description' => $request->service_description,
                'created_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Plan Detail created successfully :)', 'Success');

            return redirect()->route('plan_detail.index', $request->planid);
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

            Toastr::error('Failed to create area: ' . $th->getMessage(), 'Error');

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }



    public function edit(Request $request, $id)

    {

        try {
            $Services = Services::get();
            $plandetail = PlanDetail::where('id', $id)->first();
            $SubServices = SubService::orderBy('subservice_name', 'asc')->get();

            return view('PlanDetail.edit', compact('plandetail', 'Services', 'SubServices'));
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

                'editserviceid' => 'required',
                'editsubserviceid' => 'required',
                'valuation' => 'required',
                'amount' => 'required',
                'editdiscount' => 'required',
                'extra_amount' => 'required',
                'session_count' => 'required',
                'service_description' => 'required',
            ]);
            PlanDetail::where(['id' => $request->plan_detail_id])->update([

                'service_id' => $request->editserviceid ?? '0',
                'sub_service_id' => $request->editsubserviceid ?? '0',
                'valuation' => $request->valuation,
                'amount' => $request->amount,
                'discount' => $request->editdiscount,
                'extra_amount' => $request->extra_amount,
                'session_count' => $request->session_count,
                'service_description' => $request->service_description,
                'updated_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);

            DB::commit();
            Toastr::success('Plan Detail updated successfully :)', 'Success');

            // return back();
            return redirect()->route('plan_detail.index', $request->plan_id);
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

            PlanDetail::where(['iStatus' => 1, 'isDelete' => 0, 'id' => $request->id])->delete();
            DB::commit();
            Toastr::success('Plan Detail deleted successfully :)', 'Success');
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

            $ids = $request->input('plandetail_ids', []);

            PlanDetail::whereIn('id', $ids)->delete();

            Toastr::success('Plan Detail deleted successfully :)', 'Success');

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
