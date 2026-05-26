<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Services;

use App\Models\SubService;

use App\Models\AssociatedMember;
use App\Models\FamilyMember;
use App\Models\LabMaster;
use App\Models\LabReportRequestMaster;

use App\Models\LabReportRequestdetail;
use App\Models\LabTestMaster;
use App\Models\LabTestCategory;
use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;



class LabTestReportinquiryController extends Controller

{

    public function getDetail($id)
    {
        $LabReportdetail = LabReportRequestdetail::with('master', 'LabTestRportAmount', 'LabTest_Catgory_Name', 'family_member', 'Test_Name')->where('LabReport_Request_Master_id', $id)->paginate(config('app.per_page'));

        return view('LabTestReportInquiry.popup_detail', compact('LabReportdetail'));
    }


    public function index(Request $request)
    {
        try {
            $LabReportinquirys = LabReportRequestMaster::with('labreqmasterdetail', 'lab', 'member')->where('appointments_flag', 2)->paginate(config('app.per_page'));
            return view('LabTestReportInquiry.index', compact('LabReportinquirys'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function detail(Request $request, $id, $memberid = null)
    {
        try {

            $labtestreqid = $id;
            $LabReportdetail = LabReportRequestdetail::with('master', 'LabTestRportAmount', 'LabTest_Catgory_Name', 'family_member', 'Test_Name')->where('LabReport_Request_Master_id', $id)->paginate(config('app.per_page'));

            return view('LabTestdetailInquiry.index', compact('LabReportdetail', 'labtestreqid', 'memberid'));
        } catch (\Throwable $th) {
            \Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function add(Request $request)
    {
        try {
            $labs = LabMaster::get();
            return view('LabTestReportInquiry.add', compact('labs'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function detail_add(Request $request, $labtestreqid, $memberid = null)
    {
        try {

            $data = LabReportRequestdetail::with('master.lab', 'member')
                ->where('LabReport_Request_Master_id', $labtestreqid)
                ->first();

            $labname = $data->master->lab->name ?? '';
            $membername = $data->member->name ?? '';
            $labstest = LabTestMaster::get();
            $familymembers = FamilyMember::get();
            $LabTestCategory = LabTestCategory::get();
            return view('LabTestdetailInquiry.add', compact('LabTestCategory', 'labstest', 'familymembers', 'labtestreqid', 'memberid', 'labname', 'membername'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $lab_id = $request->lab_id;
            $visit = $request->visit;
            $date = $request->date;

            LabReportRequestMaster::create([
                'Lab_id' => $lab_id,
                'visit' => $visit,
                'date' => $date,
                'appointments_flag' => 2
            ]);
            DB::commit();
            Toastr::success('Lab Test Report Inquiry created successfully :)', 'Success');

            return redirect()->route('LabTestinquiryReport.index');
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

    public function detail_store(Request $request)
    {
        DB::beginTransaction();
        try {

            $labtestreqid = $request->labtestreqid;
            $lab_test_id = $request->lab_test_id;
            $family_member_id = $request->family_member_id;

            LabReportRequestdetail::create([
                'family_member_id' => $family_member_id,
                'Lab_test_master_id' => $lab_test_id,
                'Lab_test_category_id' => $request->lab_test_cat_id,
                'LabReport_Request_Master_id' => $labtestreqid,
                'member_id' => $request->memberid ?? ''
            ]);

            $details = LabReportRequestdetail::where('LabReport_Request_Master_id', $labtestreqid)->get();
            $netamount = $details->sum(function ($detail) {
                return $detail->Test_Name->NetAmount ?? 0;
            });

            $reportCount = $details->count();
            $specialDiscount = $reportCount > 1 ? ($reportCount - 1) * 100 : 0;

            $afterSpecial = $netamount - $specialDiscount;

            $master = LabReportRequestMaster::where('LabReport_Request_id', $labtestreqid)->first();
            $dis = $master->discount_amount ?? 0;
            $mainamount = $afterSpecial - $dis;

            LabReportRequestMaster::where('LabReport_Request_id', $labtestreqid)
                ->update([
                    'NetAmount' => $mainamount,
                    'special_discount' => $specialDiscount
                ]);


            DB::commit();
            Toastr::success('Lab Test Report Detail Inquiry created successfully :)', 'Success');

            return redirect()->route('LabTestinquiryReport.detail', $labtestreqid);
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
            $labs = LabMaster::get();
            $data = LabReportRequestMaster::with('lab')
                ->where('LabReport_Request_id', $id)
                ->where('appointments_flag', 2)
                ->first();
            return view('LabTestReportInquiry.edit', compact('data', 'labs'));
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function detail_edit(Request $request, $id,  $detailid = null, $memberid = null)
    {
        try {
            $LabTestCategory = LabTestCategory::get();
            $labstest = LabTestMaster::get();
            $familymembers = FamilyMember::get();
            $data = LabReportRequestdetail::with('Test_Name', 'family_member')
                ->where('LabReport_Request_detail_id', $detailid)
                ->first();

            return view('LabTestdetailInquiry.edit', compact('LabTestCategory', 'data', 'familymembers', 'labstest', 'memberid', 'id'));
        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            LabReportRequestMaster::where(['LabReport_Request_id' => $id])->update([

                'Lab_id' => $request->edit_labid,
                'visit' => $request->visit,
                'date' => $request->edit_date,
                'updated_at' => date('Y-m-d H:i:s'),
                //'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Lab Report Request Master Update Successfully :)', 'Success');

            // return back();
            return redirect()->route('LabTestinquiryReport.index');
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


    public function detail_update(Request $request, $id)
    {
        DB::beginTransaction();
        try {


            LabReportRequestdetail::where(['LabReport_Request_detail_id' => $id])->update([

                'family_member_id' => $request->family_member_id,
                'Lab_test_master_id' => $request->lab_test_id,
                'Lab_test_category_id' => $request->edit_lab_test_category_id,
                'updated_at' => date('Y-m-d H:i:s'),
                //'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Lab Report Request Detail Master Update Successfully :)', 'Success');

            // return back();
            return redirect()->route('LabTestinquiryReport.detail', ['id' => $request->labreqmasterid, 'memberid' => $request->memberid]);
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

            LabReportRequestMaster::where(['LabReport_Request_id' => $request->id])->delete();

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

    public function detail_delete(Request $request)
    {

        DB::beginTransaction();
        try {


            $detail = LabReportRequestdetail::with('LabTestRportAmount')->where('LabReport_Request_detail_id', $request->id)->first();

            $masterId = $detail->LabReport_Request_Master_id;
            LabReportRequestdetail::with('LabTestRportAmount')->where('LabReport_Request_detail_id', $request->id)->delete();

            $netAmount = LabReportRequestDetail::with('LabTestRportAmount')
                ->where('LabReport_Request_Master_id', $masterId)
                ->get()
                ->sum(function ($detail) {
                    return optional($detail->LabTestRportAmount)->NetAmount ?? 0;
                });



            $reportCount = $detail->count();

            $specialDiscount = $reportCount > 1 ? ($reportCount - 1) * 100 : 0;

            $afterSpecial = $netAmount - $specialDiscount;

            $master = LabReportRequestMaster::where('LabReport_Request_id', $masterId)->first();

            $dis = $master->discount_amount ?? 0;
            $mainamount = $afterSpecial - $dis;
            //dd($mainamount);

            LabReportRequestMaster::where('LabReport_Request_id', $masterId)
                ->update([
                    'NetAmount' => $mainamount,
                    'special_discount' => $specialDiscount
                ]);





            DB::commit();
            Toastr::success('Lab Report Request Detail Master deleted successfully :)', 'Success');
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
