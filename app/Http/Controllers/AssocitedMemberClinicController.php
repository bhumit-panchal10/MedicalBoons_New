<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Services;

use App\Models\SubService;

use App\Models\AssociatedMemberClinic;
use App\Models\AssociatedMember;

// use App\Models\PriceMaster;

use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;



class AssocitedMemberClinicController extends Controller

{

    public function index(Request $request, $id)
    {
        try {
            $Services = Services::orderBy('name', 'asc')->get();
            $SubService = SubService::orderBy('subservice_name', 'asc')->get();
            $AssociatedMembersClinic = AssociatedMemberClinic::with('services', 'subservices', 'assocmember')->where('associated_member_id', $id)
                ->paginate(config('app.per_page'));
            return view('associated_clinic_member.index', compact('id', 'AssociatedMembersClinic', 'Services', 'SubService'));
        } catch (\Throwable $th) {
            \Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // public function service_subservice_mapping(Request $request)
    // {

    //     $serviceid = $request->service;


    //     if ($serviceid) {

    //         $SubService =  SubService::orderBy('subservice_name', 'asc')->where(['service_id' => $serviceid])->get();
    //         if ($SubService) {

    //             $html = "";

    //             $html .= "<option value=''>Select Sub Service</option>";

    //             foreach ($SubService as $SubSer) {

    //                 $html .= "<option value='" . $SubSer->sub_service_id . "'>" . $SubSer->subservice_name . "</option>";
    //             }



    //             return $html;
    //         }
    //     }
    // }

    public function service_subservice_mapping(Request $request)
    {
        $serviceId = $request->service;

        if (!$serviceId) {
            return response()->json([
                'status' => false,
                'html' => '<p class="text-sm text-slate-500">
                        Please select a service.
                       </p>',
            ]);
        }

        $subServices = SubService::where('service_id', $serviceId)
            ->orderBy('subservice_name', 'asc')
            ->get();

        if ($subServices->isEmpty()) {
            return response()->json([
                'status' => false,
                'html' => '<p class="text-sm text-slate-500">
                        No sub services found.
                       </p>',
            ]);
        }

        $html = '';

        foreach ($subServices as $subService) {
            $checkboxId = 'sub_service_' . $subService->sub_service_id;

            $html .= '
            <label for="' . $checkboxId . '"
                class="flex items-center gap-2 p-2 border rounded-md cursor-pointer
                border-slate-200 dark:border-zink-500
                hover:bg-slate-50 dark:hover:bg-zink-600">

                <input
                    type="checkbox"
                    id="' . $checkboxId . '"
                    name="sub_service_id[]"
                    value="' . $subService->sub_service_id . '"
                    class="sub-service-checkbox w-4 h-4 rounded
                    border-slate-300 text-custom-500 focus:ring-custom-500"
                >

                <span class="text-sm text-slate-700 dark:text-zink-100">'
                . e($subService->subservice_name) .
                '</span>
            </label>
        ';
        }

        return response()->json([
            'status' => true,
            'html' => $html,
        ]);
    }

    public function add($id)
    {
        try {
            $Services = Services::orderBy('name', 'asc')->get();
            $SubService = SubService::orderBy('subservice_name', 'asc')->get();
            $AssociatedMember = AssociatedMember::get();
            // $prices = PriceMaster::orderBy('priceId', 'asc')->get();

            return view('associated_clinic_member.add', compact('id', 'Services', 'SubService', 'AssociatedMember'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }


    // public function store(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $request->validate([

    //             'service_id' => 'required',
    //             'sub_service_id' => 'required|array',
    //             'sub_service_id.*' => 'required|integer',
    //             'assoc_member_id' => 'required',
    //             'clinic_name' => 'required',
    //             'address' => 'required',
    //             'time' => 'required',
    //             'work_day' => 'required',
    //         ]);

    //         $img = "";
    //         if ($request->hasFile('photo')) {
    //             $root = $_SERVER['DOCUMENT_ROOT'];
    //             $image = $request->file('photo');
    //             $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
    //             $destinationpath = $root . '/upload/Clinicphoto/';

    //             if (!file_exists($destinationpath)) {
    //                 mkdir($destinationpath, 0755, true);
    //             }

    //             $image->move($destinationpath, $img);
    //         }

    //         foreach ($request->sub_service_id as $subServiceId) {


    //         $AssociatedMember = AssociatedMemberClinic::create([

    //             'service_id' => $request->service_id ?? 0,
    //             'sub_service_id' => $request->sub_service_id ?? 0,
    //             'associated_member_id' => $request->assoc_member_id,
    //             'clinic_name' => $request->clinic_name,
    //             'address' => $request->address,
    //             'time' => $request->time,
    //             'work_day' => $request->work_day,
    //             'photo' => $img,
    //             'created_at' => date('Y-m-d H:i:s'),
    //             'strIP' => $request->ip(),

    //          ]);
    //         }

    //         DB::commit();
    //         Toastr::success('Associated Clinic created successfully :)', 'Success');

    //         return redirect()->route('AssocitedMemberClinic.index', $request->assoc_member_id);
    //     } catch (ValidationException $e) {

    //         DB::rollBack();

    //         $errors = $e->errors();

    //         $errorMessages = [];

    //         foreach ($errors as $field => $messages) {

    //             foreach ($messages as $message) {

    //                 $errorMessages[] = $message;
    //             }
    //         }
    //         $errorMessageString = implode(', ', $errorMessages);
    //         Toastr::error($errorMessageString, 'Error');
    //         return redirect()->back()->withInput();
    //     } catch (\Throwable $th) {

    //         DB::rollBack();

    //         Toastr::error('Failed to create area: ' . $th->getMessage(), 'Error');

    //         return redirect()->back()->withInput()->with('error', $th->getMessage());
    //     }
    // }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'service_id'         => 'required|integer',
                'sub_service_id'     => 'required|array|min:1',
                'sub_service_id.*'   => 'required|integer|distinct',
                'assoc_member_id'    => 'required|integer',
                'clinic_name'        => 'required|string|max:150',
                'address'            => 'required|string|max:255',
                'time'               => 'required|string|max:150',
                'work_day'           => 'required|string|max:150',
                'photo'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $img = '';

            if ($request->hasFile('photo')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('photo');

                $img = time() . '_' . date('dmYHis') . '.' .
                    $image->getClientOriginalExtension();

                $destinationPath = $root . '/upload/Clinicphoto/';

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $image->move($destinationPath, $img);
            }

            foreach ($request->sub_service_id as $subServiceId) {
                AssociatedMemberClinic::create([
                    'service_id'           => $request->service_id,
                    'sub_service_id'       => $subServiceId,
                    'associated_member_id' => $request->assoc_member_id,
                    'clinic_name'          => $request->clinic_name,
                    'address'              => $request->address,
                    'time'                 => $request->time,
                    'work_day'             => $request->work_day,
                    'photo'                => $img,
                    'created_at'           => now(),
                    'strIP'                => $request->ip(),
                ]);
            }

            DB::commit();

            Toastr::success(
                'Associated Clinic created successfully :)',
                'Success'
            );

            return redirect()->route(
                'AssocitedMemberClinic.index',
                $request->assoc_member_id
            );
        } catch (ValidationException $e) {
            DB::rollBack();

            $errorMessages = [];

            foreach ($e->errors() as $messages) {
                foreach ($messages as $message) {
                    $errorMessages[] = $message;
                }
            }

            Toastr::error(
                implode(', ', $errorMessages),
                'Error'
            );

            return redirect()->back()->withInput();
        } catch (\Throwable $th) {
            DB::rollBack();

            Toastr::error(
                'Failed to create associated clinic: ' . $th->getMessage(),
                'Error'
            );

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $th->getMessage());
        }
    }

    public function edit(Request $request, $id)

    {
        try {
            $Services = Services::orderBy('name', 'asc')->get();
            $SubServices = SubService::orderBy('subservice_name', 'asc')->get();
            $data = AssociatedMemberClinic::where('id', $id)->first();
            $AssociatedMember = AssociatedMember::get();
            return view('associated_clinic_member.edit', compact('id', 'Services', 'SubServices', 'data', 'AssociatedMember'));
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
            // dd($request);
            $request->validate([

                'editserviceid' => 'required',
                'editsubserviceid' => 'required',
                'clinic_name' => 'required',
                'address' => 'required',
                'time' => 'required',
                'work_day' => 'required',
            ]);
            if ($request->hasFile('photo')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('photo');

                $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/Clinicphoto/';

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

            AssociatedMemberClinic::where(['id' => $request->edit_id])->update([

                'service_id' => $request->editserviceid,
                'sub_service_id' => $request->editsubserviceid ?? 0,
                'clinic_name' => $request->clinic_name,
                'address' => $request->address,
                'time' => $request->time,
                'work_day' => $request->work_day,
                'photo' => $img,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::commit();

            Toastr::success('Associated Clinic updated successfully :)', 'Success');

            // return back();
            return redirect()->route('AssocitedMemberClinic.index', $request->assoc_member_id);
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

            AssociatedMemberClinic::where(['id' => $request->id])->delete();
            DB::commit();
            Toastr::success('Associated Clinic deleted successfully :)', 'Success');
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
