<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Services;

use App\Models\SubService;

use App\Models\AssociatedMember;

use App\Models\LabReportRequestMaster;

use App\Models\LabReportRequestdetail;

use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;



class AppoitmentController extends Controller

{

    public function Appoitmentlist(Request $request)
    {
        try {
            $appointments = LabReportRequestMaster::with('member', 'AssociatedMember', 'labreqmasterdetail.family_member')->where('appointments_flag', 1)->paginate(config('app.per_page'));
            return view('appointment.index', compact('appointments'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit(Request $request, $id)
    {
        try {

            $data = LabReportRequestMaster::with('member', 'AssociatedMember', 'labreqmasterdetail.family_member')
                ->where('LabReport_Request_id', $id)
                ->where('appointments_flag', 1)
                ->first();
            return view('appointment.edit', compact('data'));
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

            LabReportRequestMaster::where(['LabReport_Request_id' => $id])->update([

                'preference_date' => $request->edit_preference_date,
                'preference_time' => $request->edit_preference_time,
                'updated_at' => date('Y-m-d H:i:s'),
                //'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Lab Report Request Master Update Successfully :)', 'Success');

            // return back();
            return redirect()->route('Appoitment.Appoitmentlist');
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
            LabReportRequestMaster::where(['LabReport_Request_id' => $request->id])->delete();
            LabReportRequestdetail::where(['LabReport_Request_Master_id' => $request->id])->delete();

            DB::commit();
            Toastr::success('Lab Report Request Master deleted successfully :)', 'Success');
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
}
