<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubService;
use App\Models\Services;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class SubServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $subServices = SubService::with('service')->orderBy('sub_service_id', 'asc')->paginate(config('app.per_page'));
            $Services = Services::orderBy('name', 'asc')
                ->select('id', 'name')
                ->where(['iStatus' => 1])
                ->get();

            return view('SubService.index', compact('subServices', 'Services'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }



    public function store(Request $request)
    {
        DB::beginTransaction();


        try {
            // Validate input data
            $request->validate([
                'serviceid' => 'required',
                'Subservicename' => 'required|unique:sub_service,subservice_name',

            ]);

            // Get the category name by Categoryid
            $Services = Services::where('id', $request->serviceid)->first();

            // Check if category exists
            if (!$Services) {
                Toastr::error('Services not found', 'Error');
                return redirect()->back()->withInput();
            }

            $serviceid = $Services->id;  // Retrieve Category_name

            // Format the subcategory slug name
            $lowercase = Str::lower($request->SubCategoryname);
            $slugname = str_replace(' ', '-', $lowercase);

            // Create a new SubCategory record
            SubService::create([
                'service_id' => $serviceid,
                'subservice_name' => $request->Subservicename,
                'sub_description' => $request->Description,
                'slug_name' => $slugname,
                'created_at' => now(),
                'strIP' => $request->ip(),
            ]);

            // Commit the transaction
            DB::commit();

            Toastr::success('Sub Service created successfully!', 'Success');
            return redirect()->route('sub_service.index')->with('success', 'Sub Service Created Successfully.');
        } catch (ValidationException $e) {
            DB::rollBack();
            $errors = $e->errors();  // Get the validation errors
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
            Toastr::error('Failed to create Sub Service: ' . $th->getMessage(), 'Error');
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function edit(Request $request)
    {

        $SubService = SubService::where('sub_service_id', $request->id)->first();

        return json_encode($SubService);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validate Request
            $request->validate([
                'editsubservicename' => 'required|unique:sub_service,subservice_name,' . $request->sub_service_id . ',sub_service_id',
            ]);

            $Services = Services::where('id', $request->editserviceid)->first();
            if (!$Services) {
                throw new \Exception('Service not found.');
            }
            $slugname = Str::slug($request->name);
            $subcategory = SubService::where("sub_service_id", $request->Subserviceid)->first();


            // Update SubCategory
            SubService::where("sub_service_id", $request->Subserviceid)->update([
                'service_id' => $Services->id,
                'subservice_name' => $request->editsubservicename,
                'sub_description' => $request->EditDescription,
                'slug_name' => $slugname,
                'updated_at' => now(),
                'strIP' => $request->ip(),
            ]);

            DB::commit();

            Toastr::success('Sub Service updated successfully :)', 'Success');
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
            $state = SubService::where([

                'isDelete' => 0,
                'sub_service_id' => $request->id
            ])->delete();

            DB::commit();

            Toastr::success('Sub Service deleted successfully :)', 'Success');
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
            $ids = $request->input('sub_service_Ids', []);
            SubService::whereIn('sub_service_id', $ids)->delete();

            Toastr::success('Sub Service deleted successfully :)', 'Success');
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
        // dd($request);
        try {
            if ($request->status == 1) {
                SubService::where(['sub_service_id' => $request->sub_service_id])->update(['iStatus' => 0]);
                Toastr::success('SubService inactive successfully :)', 'Success');
            } else {
                SubService::where(['sub_service_id' => $request->sub_service_id])->update(['iStatus' => 1]);
                Toastr::success('SubService active successfully :)', 'Success');
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
