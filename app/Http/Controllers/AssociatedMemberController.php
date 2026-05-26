<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Services;

use App\Models\SubService;

use App\Models\AssociatedMember;

// use App\Models\PriceMaster;

use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;



class AssociatedMemberController extends Controller

{

    public function index(Request $request)
    {
        try {
            $serviceid = $request->serviceid;
            $subservice_id = $request->subservice_id;
            $doctor = $request->doctor;

            $Services = Services::orderBy('name', 'asc')->get();
            $SubService = SubService::orderBy('subservice_name', 'asc')->get();

            $AssociatedMembers = AssociatedMember::select(
                'associated_members.*',
                'services.id as service_id',
                'services.name',
                'sub_service.sub_service_id',
                'sub_service.subservice_name'
            )
                ->leftJoin('services', 'associated_members.service_id', '=', 'services.id')
                ->leftJoin('sub_service', 'associated_members.sub_service_id', '=', 'sub_service.sub_service_id')
                ->where('associated_members.iStatus', 1)
                ->where('associated_members.isDelete', 0)
                ->when($doctor, function ($query, $doctor) {
                    $query->where('associated_members.dr_name', 'like', '%' . $doctor . '%');
                })
                ->when($serviceid, function ($query, $serviceid) {
                    $query->where('associated_members.service_id', $serviceid);
                })
                ->when($subservice_id, function ($query, $subservice_id) {
                    $query->where('associated_members.sub_service_id', $subservice_id);
                })
                ->orderBy('associated_members.dr_name', 'asc')
                ->paginate(config('app.per_page'));

            return view('associated_member.index', compact('Services', 'SubService', 'AssociatedMembers', 'serviceid', 'subservice_id', 'doctor'));
        } catch (\Throwable $th) {
            \Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }




    public function service_subservice_mapping(Request $request)

    {

        $serviceid = $request->service;


        if ($serviceid) {

            $SubService =  SubService::orderBy('subservice_name', 'asc')->where(['service_id' => $serviceid])->get();
            if ($SubService) {

                $html = "";

                $html .= "<option value=''>Select Sub Service</option>";

                foreach ($SubService as $SubSer) {

                    $html .= "<option value='" . $SubSer->sub_service_id . "'>" . $SubSer->subservice_name . "</option>";
                }



                return $html;
            }
        }
    }

    public function add()
    {
        try {
            $Services = Services::orderBy('name', 'asc')->get();
            $SubService = SubService::orderBy('subservice_name', 'asc')->get();
            // $prices = PriceMaster::orderBy('priceId', 'asc')->get();

            return view('associated_member.add', compact('Services', 'SubService'));
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
                'sub_service_id' => 'required',
                'doctor_name' => 'required',
                'degree' => 'required',
                'address_1' => 'required',
                'address_2' => 'required',
                'about_dr_or_clinic' => 'required',
            ]);

            $area = AssociatedMember::create([

                'service_id' => $request->service_id ?? 0,

                'sub_service_id' => $request->sub_service_id ?? 0,
                'dr_name' => $request->doctor_name,
                'degree' => $request->degree,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'about_dr_or_clinic' => $request->about_dr_or_clinic,

                'created_at' => date('Y-m-d H:i:s'),

                'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Associated Member created successfully :)', 'Success');

            return redirect()->route('associated_member.index');
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
            $Services = Services::orderBy('name', 'asc')->get();
            $SubServices = SubService::orderBy('subservice_name', 'asc')->get();
            $data = AssociatedMember::where('id', $id)->first();
            return view('associated_member.edit', compact('Services', 'SubServices', 'data'));
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

                'editserviceid' => 'required',
                'editsubserviceid' => 'required',
                'edit_doctor_name' => 'required',
                'edit_degree' => 'required',
                'edit_address_1' => 'required',
                'edit_address_2' => 'required',
                'about_dr_or_clinic' => 'required',
            ]);
            AssociatedMember::where(['id' => $id])->update([

                'service_id' => $request->editserviceid,
                'sub_service_id' => $request->editsubserviceid ?? 0,
                'dr_name' => $request->edit_doctor_name,
                'degree' => $request->edit_degree,
                'address_1' => $request->edit_address_1,
                'address_2' => $request->edit_address_2,
                'about_dr_or_clinic' => $request->about_dr_or_clinic,
                'updated_at' => date('Y-m-d H:i:s'),

                'strIP' => $request->ip(),

            ]);



            DB::commit();



            Toastr::success('Associated Member updated successfully :)', 'Success');

            // return back();
            return redirect()->route('associated_member.index');
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

            AssociatedMember::where(['iStatus' => 1, 'isDelete' => 0, 'id' => $request->id])->delete();
            DB::commit();
            Toastr::success('Associated Member deleted successfully :)', 'Success');
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

            $ids = $request->input('assocmem_ids', []);

            AssociatedMember::whereIn('id', $ids)->delete();



            Toastr::success('Associated Member deleted successfully :)', 'Success');

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
