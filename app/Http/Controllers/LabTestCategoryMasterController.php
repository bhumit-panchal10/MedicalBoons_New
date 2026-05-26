<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabTestCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class LabTestCategoryMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $LabTestCategory = LabTestCategory::orderBy('name', 'asc')->paginate(config('app.per_page'));
            return view('LabTestCategory.index', compact('LabTestCategory'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction(); // Start a database transaction

        try {
            $request->validate([
                'categoryame' => 'required|unique:Lab_Test_Category,name',

            ]);
            $LabTestCategory = LabTestCategory::create([
                'name' => $request->categoryame,
                'description' => $request->description,
                'display_priority' => $request->display_priority,
                'created_at' => now(),
                'strIP' => $request->ip(),
            ]);

            DB::commit();

            Toastr::success('Lab Category created successfully :)', 'Success');
            return redirect()->route('lab_test_cate.index')->with('success', 'Lab Category Created Successfully.');
        } catch (ValidationException $e) {
            DB::rollBack();
            $errors = $e->errors();
            $errorMessageString = implode(', ', Arr::flatten($errors));

            Toastr::error($errorMessageString, 'Error');
            return redirect()->back()->withInput();
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Failed to create service: ' . $th->getMessage(), 'Error');
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }



    public function edit(Request $request)
    {
        $LabTestCategory = LabTestCategory::where('Lab_Test_Category_id', $request->id)->first();
        return json_encode($LabTestCategory);
    }

    public function update(Request $request)
    {

        DB::beginTransaction();
        try {

            $request->validate([
                'labtest_cat_name' => 'required|unique:Lab_Test_Category,name,' . $request->lab_testcat_id . ',Lab_Test_Category_id',
            ]);

            $data = [
                'name' => $request->labtest_cat_name,
                'display_priority' => $request->Editdisplay_priority,
                'description' => $request->editdescription,
                'updated_at' => now(),
                'strIP' => $request->ip(),
            ];

            LabTestCategory::where("Lab_Test_Category_id", $request->lab_testcat_id)->update($data);

            DB::commit();

            Toastr::success('Lab Test Category updated successfully :)', 'Success');
            return back();
        } catch (ValidationException $e) {
            DB::rollBack();
            $errorMessageString = implode(', ', Arr::flatten($e->errors()));
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
            $state = LabTestCategory::where([

                'isDelete' => 0,
                'Lab_Test_Category_id' => $request->id
            ])->delete();

            DB::commit();

            Toastr::success('Lab Test Category deleted successfully :)', 'Success');
            return response()->json(['success' => true]);
            //return back();
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

    public function deleteselected(Request $request)
    {
        // dd($request->all());
        try {
            $ids = $request->input('Lab_Test_Category_ids', []);
            LabTestCategory::whereIn('Lab_Test_Category_id', $ids)->delete();

            Toastr::success('Lab Test Category deleted successfully :)', 'Success');
            return back();
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

    public function updateStatus(Request $request)
    {

        try {
            if ($request->status == 1) {
                LabTestCategory::where(['Lab_Test_Category_id' => $request->labtestcatId])->update(['iStatus' => 0]);
                Toastr::success('Lab Test Category inactive successfully :)', 'Success');
            } else {
                LabTestCategory::where(['Lab_Test_Category_id' => $request->labtestcatId])->update(['iStatus' => 1]);
                Toastr::success('Lab Test Category active successfully :)', 'Success');
            }
            echo 1;
        } catch (ValidationException $e) {
            DB::rollBack();
            Toastr::error('Validation Error: ' . implode(', ', $e->errors()));
            return 0;
        } catch (\Throwable $th) {
            DB::rollBack();
            Toastr::error('Error: ' . $th->getMessage());
            return 0;
        }
    }
}
