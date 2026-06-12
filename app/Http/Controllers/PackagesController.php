<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Services;

use App\Models\SubService;

use App\Models\Packages;
use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Validation\ValidationException;

class PackagesController extends Controller

{

    public function index(Request $request)
    {
        try {
            $Packages = Packages::select('*')
                ->orderBy('id', 'asc')
                ->paginate(config('app.per_page'));
            return view('packages.index', compact('Packages'));
        } catch (\Throwable $th) {
            Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function add()
    {
        try {
            return view('packages.add');
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
                'price' => 'nullable',
                'mrp_price' => 'nullable',
                'tests' => 'nullable',
                'fasting_required' => 'nullable',
                'description' => 'nullable',
            ]);
            $logo = "";
            if ($request->hasFile('logo')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('logo');
                $logo = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/logo/';

                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }

                $image->move($destinationpath, $logo);
            }

            $pdf = "";
            if ($request->hasFile('plan_detail_pdf')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('plan_detail_pdf');
                $pdf = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/package-detail-pdf/';

                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }

                $image->move($destinationpath, $pdf);
            }

            $Packages = Packages::create([

                'name' => $request->name ?? '',
                'slugname' => Str::slug($request->name) ?? '',
                'Price' => $request->price ?? '',
                'MRP_Price' => $request->mrp_price ?? '',
                'Tests' => $request->tests,
                'fasting_required' => $request->fasting_required,
                'logo' => $logo,
                'pdf' => $pdf,
                'description' => $request->description,
                'created_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Packages created successfully :)', 'Success');

            return redirect()->route('packages.index');
        } catch (ValidationException $e) {

            DB::rollBack();

            $errors = $e->errors();

            $errorMessages = [];
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
            $plan = Packages::where('id', $id)->first();
            return view('packages.edit', compact('plan'));
        } catch (\Throwable $th) {
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
                'price' => 'nullable',
                'mrp_price' => 'nullable',
                'tests' => 'nullable',
                'fasting_required' => 'nullable',
                'description' => 'nullable',
            ]);
            $img = "";
            $pdf = "";

            if ($request->hasFile('editplan_logo')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('editplan_logo');

                $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/logo/';

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
                $destinationpath = $root . '/upload/package-detail-pdf/';

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
            Packages::where(['id' => $id])->update([

                'name' => $request->name ?? '',
                'slugname' => Str::slug($request->name) ?? '',
                'Price' => $request->price ?? '',
                'MRP_Price' => $request->mrp_price ?? '',
                'Tests' => $request->tests,
                'fasting_required' => $request->fasting_required,
                'logo' => $img,
                'pdf' => $pdf,
                'description' => $request->description,
                'updated_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);

            DB::commit();
            Toastr::success('packages updated successfully :)', 'Success');
            // return back();
            return redirect()->route('packages.index');
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

            Packages::where(['id' => $request->id])->delete();
            DB::commit();
            Toastr::success('Packages deleted successfully :)', 'Success');
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
            $ids = $request->input('package_ids', []);

            Packages::whereIn('id', $ids)->delete();

            Toastr::success('Packages deleted successfully :)', 'Success');

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
