<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabMaster;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class LabMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $LabMasters = LabMaster::orderBy('name', 'asc')->paginate(config('app.per_page'));
            return view('LabMaster.index', compact('LabMasters'));
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
                'labname' => 'required|unique:Lab_Master,name',

            ]);
            $LabMaster = LabMaster::create([
                'name' => $request->labname,
                'address' => $request->address,
                'created_at' => now(),
                'strIP' => $request->ip(),
            ]);

            DB::commit(); // Commit the transaction

            Toastr::success('Lab Master created successfully :)', 'Success');
            return redirect()->route('lab_master.index')->with('success', 'Lab Created Successfully.');
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
        $LabMaster = LabMaster::where('Lab_Master_id', $request->id)->first();
        return json_encode($LabMaster);
    }

    public function update(Request $request)
    {

        DB::beginTransaction();
        try {

            $request->validate([
                'lab_name' => 'required|unique:Lab_Master,name,' . $request->labmasterid . ',Lab_Master_id',
            ]);

            $data = [
                'name' => $request->lab_name,
                'address' => $request->EditAddress,
                'updated_at' => now(),
                'strIP' => $request->ip(),
            ];

            LabMaster::where("Lab_Master_id", $request->labmasterid)->update($data);

            DB::commit();

            Toastr::success('Lab Master updated successfully :)', 'Success');
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
            $state = LabMaster::where([

                'isDelete' => 0,
                'Lab_Master_id' => $request->id
            ])->delete();

            DB::commit();

            Toastr::success('Lab Master deleted successfully :)', 'Success');
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
            $ids = $request->input('Lab_Master_ids', []);
            LabMaster::whereIn('Lab_Master_id', $ids)->delete();

            Toastr::success('Lab Master deleted successfully :)', 'Success');
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
                LabMaster::where(['Lab_Master_id' => $request->labmasterId])->update(['iStatus' => 0]);
                Toastr::success('Lab Master inactive successfully :)', 'Success');
            } else {
                LabMaster::where(['Lab_Master_id' => $request->labmasterId])->update(['iStatus' => 1]);
                Toastr::success('Lab Master active successfully :)', 'Success');
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
