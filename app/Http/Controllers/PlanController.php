<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Services;

use App\Models\SubService;

use App\Models\Plan;
use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Validation\ValidationException;



class PlanController extends Controller

{

    public function index(Request $request)
    {
        try {

            $plans = Plan::select('*')
                ->orderBy('id', 'asc')
                ->paginate(config('app.per_page'));

            return view('Plan.index', compact('plans'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function add()
    {
        try {
            return view('Plan.add');
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

                'name' => 'required',
                'amount' => 'required',
                'is_corporate' => 'required',
                'duration_in_days' => 'required',
                'no_of_members' => 'required',
                'wallet_balance' => 'required',
                'extra_amount_per_person' => 'required',
                'extra_amount_per_person_in_wallet' => 'required',
                'lab_max_applicable_amount_each_time' => 'required',
                'lab_minimum_order_value' => 'required',
            ]);
            $img = "";
            if ($request->hasFile('plan_image')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('plan_image');
                $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/plan-images/';

                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }

                $image->move($destinationpath, $img);
            }

             $pdf = "";     
            if ($request->hasFile('plan_detail_pdf')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('plan_detail_pdf');
                $pdf = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/plan-detail-pdf/';

                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }

                $image->move($destinationpath, $pdf);
            }

            $Plan = Plan::create([          

                'name' => $request->name ?? '',
                'slugname' => Str::slug($request->name) ?? '',
                'amount' => $request->amount ?? '',
                'is_corporate' => $request->is_corporate ?? '',
                'duration_in_days' => $request->duration_in_days,
                'no_of_members' => $request->no_of_members,
                'plan_image' => $img,
                'plan_detail_pdf' => $pdf,
                'wallet_balance' => $request->wallet_balance,
                'extra_amount_per_person' => $request->extra_amount_per_person,
                'extra_amount_per_person_in_wallet' => $request->extra_amount_per_person_in_wallet,
                'lab_max_applicable_amount_each_time' => $request->lab_max_applicable_amount_each_time,
                'lab_minimum_order_value' => $request->lab_minimum_order_value,
                'terms_and_condition' => $request->terms_and_condition,
                'lab_special_terms_and_condition' => $request->lab_special_terms_and_condition,
                'plan_detail_image' => $request->plan_detail_description,
                'created_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Plan created successfully :)', 'Success');

            return redirect()->route('plan.index');
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

            $plan = Plan::where('id', $id)->first();
            return view('Plan.edit', compact('plan'));
        } catch (\Throwable $th) {

            // Rollback and return with Error

            DB::rollBack();

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }



    public function update(Request $request, $id)

    {
        DB::beginTransaction();

        try {

            $request->validate([

                'name' => 'required',
                'amount' => 'required',
                'is_corporate' => 'required',
                'duration_in_days' => 'required',
                'no_of_members' => 'required',
                'wallet_balance' => 'required',
                'extra_amount_per_person' => 'required',
                'extra_amount_per_person_in_wallet' => 'required',
                'lab_max_applicable_amount_each_time' => 'required',
                'lab_minimum_order_value' => 'required',
            ]);
            $img = "";
            $pdf = "";      

            if ($request->hasFile('editplan_img')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('editplan_img');

                $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/plan-images/';

                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }
                $image->move($destinationpath, $img);
                $oldImg = $request->input('hiddenPhoto');
                if ($oldImg && file_exists($destinationpath . '/' . $oldImg)) {
                    unlink($destinationpath . '/' . $oldImg);
                }
            } else {
                $img = $request->input('hiddenPhoto');
            }
            if ($request->hasFile('editplan_pdf')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('editplan_pdf');

                $pdf = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/plan-detail-pdf/';

                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }
                $image->move($destinationpath, $pdf);
                $oldPdf = $request->input('hiddenPdf');
                if ($oldPdf && file_exists($destinationpath . '/' . $oldPdf)) {
                    unlink($destinationpath . '/' . $oldPdf);
                }
            } else {
                $pdf = $request->input('hiddenPdf');
            }
            Plan::where(['id' => $id])->update([

                'name' => $request->name,
                'slugname' => Str::slug($request->name) ?? '',
                'amount' => $request->amount ?? 0,
                'is_corporate' => $request->is_corporate ?? 0,
                'plan_image' => $img,
                'plan_detail_pdf' => $pdf,
                'duration_in_days' => $request->duration_in_days,
                'no_of_members' => $request->no_of_members,
                'wallet_balance' => $request->wallet_balance,
                'extra_amount_per_person' => $request->extra_amount_per_person,
                'extra_amount_per_person_in_wallet' => $request->extra_amount_per_person_in_wallet,
                'lab_max_applicable_amount_each_time' => $request->lab_max_applicable_amount_each_time,
                'lab_minimum_order_value' => $request->lab_minimum_order_value,
                'wallet_balance' => $request->wallet_balance,
                'terms_and_condition' => $request->terms_and_condition,
                'lab_special_terms_and_condition' => $request->lab_special_terms_and_condition,
                'plan_detail_image' => $request->plan_detail_description,
                'updated_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);

            DB::commit();
            Toastr::success('Plan updated successfully :)', 'Success');

            // return back();
            return redirect()->route('plan.index');
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

            Plan::where(['iStatus' => 1, 'isDelete' => 0, 'id' => $request->id])->delete();
            DB::commit();
            Toastr::success('Plan deleted successfully :)', 'Success');
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

            $ids = $request->input('plan_ids', []);

            Plan::whereIn('id', $ids)->delete();

            Toastr::success('Plan deleted successfully :)', 'Success');

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
