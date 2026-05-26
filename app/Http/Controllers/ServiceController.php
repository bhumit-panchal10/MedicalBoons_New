<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $Services = Services::orderBy('name', 'asc')->paginate(config('app.per_page'));
            return view('Service.index', compact('Services'));
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
                'servicename' => 'required|unique:services,name',

            ]);

            $lowercase = Str::lower($request->servicename);
            $slugname = str_replace(' ', '-', $lowercase);

            // Create a new Categories record
            $Services = Services::create([
                'name' => $request->servicename,
                'description' => $request->description,
                'slug_name' => $slugname,
                'created_at' => now(),
                'strIP' => $request->ip(),
            ]);

            DB::commit(); // Commit the transaction

            Toastr::success('service created successfully :)', 'Success');
            return redirect()->route('service.index')->with('success', 'service Created Successfully.');
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
        $services = Services::where('id', $request->id)->first();
        return json_encode($services);
    }

    public function update(Request $request)
    {

        DB::beginTransaction();

        try {
            $request->validate([
                'service_name' => 'required|unique:services,name,' . $request->serviceid,

            ]);
            $lowercase = Str::lower($request->service_name);
            $slugname = str_replace(' ', '-', $lowercase);
            // Update the category record
            $data = [
                'name' => $request->service_name,
                'description' => $request->EditDescription,
                'slug_name' => $slugname,
                'updated_at' => now(),
                'strIP' => $request->ip(),
            ];

            Services::where("id", $request->serviceid)->update($data);

            DB::commit();

            Toastr::success('Service updated successfully :)', 'Success');
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
            $state = Services::where([

                'isDelete' => 0,
                'id' => $request->id
            ])->delete();

            DB::commit();

            Toastr::success('Service deleted successfully :)', 'Success');
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
            $ids = $request->input('Service_ids', []);
            Services::whereIn('id', $ids)->delete();

            Toastr::success('Service deleted successfully :)', 'Success');
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
                Services::where(['id' => $request->serviceId])->update(['iStatus' => 0]);
                Toastr::success('Service inactive successfully :)', 'Success');
            } else {
                Services::where(['id' => $request->serviceId])->update(['iStatus' => 1]);
                Toastr::success('Service active successfully :)', 'Success');
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
