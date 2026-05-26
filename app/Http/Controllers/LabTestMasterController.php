<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\LabTestMaster;
use App\Models\LabTestCategory;
use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;



class LabTestMasterController extends Controller

{

    public function index(Request $request)
    {
        try {

            $LabTestCategory = LabTestCategory::where('iStatus', 1)->orderBy('name', 'asc')->get();
            $LabTestmaster = LabTestMaster::with('labcategory')->orderBy('Lab_Test_Master_id', 'desc')->paginate(config('app.per_page'));
            return view('LabTestMaster.index', compact('LabTestmaster', 'LabTestCategory'));
        } catch (\Throwable $th) {
            \Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function store(Request $request)

    {
        DB::beginTransaction();
        try {

            $request->validate([

                'testcategory_id' => 'required',
                'Test_Name' => 'required',
                'MRP' => 'required',

            ]);
            $img = "";
            if ($request->hasFile('image')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('image');
                $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/MedicalBoons/upload/LabTest-images/';

                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }

                $image->move($destinationpath, $img);
            }

            $LabTestMaster = LabTestMaster::create([

                'lab_test_category_id' => $request->testcategory_id ?? 0,
                'MRP' => $request->MRP ?? 0,
                'Test_Name' => $request->Test_Name,
                'image' => $img,
                'created_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Lab Test Master created successfully :)', 'Success');

            return redirect()->route('lab_test_master.index');
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
            $data = LabTestMaster::where('Lab_Test_Master_id', $id)->first();
            return json_encode($data);
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

            $request->validate([

                'testcategory_id' => 'required',
                'Test_Name' => 'required',
                'MRP' => 'required',

            ]);
            if ($request->hasFile('edit_img')) {
               
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('edit_img');
                $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/MedicalBoons/upload/LabTest-images/';

              
                // Create directory if it doesn't exist
                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }

                // Move the image to the destination path
                $image->move($destinationpath, $img);

                // Delete the old image if it exists
                $oldImg = $request->input('hiddenPhoto');
                if ($oldImg && file_exists($destinationpath . '/' . $oldImg)) {
                    unlink($destinationpath . '/' . $oldImg);
                }
            } else {
                $img = $request->input('hiddenPhoto'); // Retain the old image if no new image is uploaded
            }
            LabTestMaster::where(['Lab_Test_Master_id' => $request->lab_testmaster_id])->update([

                'lab_test_category_id' => $request->testcategory_id,
                'Test_Name' => $request->Test_Name,
                'MRP' => $request->MRP,
                'image' => $img,
                'updated_at' => date('Y-m-d H:i:s'),
                'strIP' => $request->ip(),

            ]);
            DB::commit();
            Toastr::success('Lab Test Master updated successfully :)', 'Success');

            // return back();
            return redirect()->route('lab_test_master.index');
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

            LabTestMaster::where(['iStatus' => 1, 'isDelete' => 0, 'Lab_Test_Master_id' => $request->id])->delete();
            DB::commit();
            Toastr::success('Lab Test Master deleted successfully :)', 'Success');
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

            $ids = $request->input('Lab_Test_Master_ids', []);

            LabTestMaster::whereIn('Lab_Test_Master_id', $ids)->delete();

            Toastr::success('Lab Test Master deleted successfully :)', 'Success');

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
