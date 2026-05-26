<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Banner;
use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;

class BannerController extends Controller

{

    public function index(Request $request)
    {
        try {
            $Banners = Banner::paginate(config('app.per_page'));
            return view('Banner.index', compact('Banners'));
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
                'image' => 'required|file',
            ]);
            $img = "";
            if ($request->hasFile('image')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('image');
                $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/Banner/';

                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }

                $image->move($destinationpath, $img);
            }

            $Banner = Banner::create([

                'title' => $request->Title,
                'image' => $img,
                'created_at' => date('Y-m-d H:i:s'),

            ]);
            DB::commit();
            Toastr::success('Banner created successfully :)', 'Success');

            return redirect()->route('Banner.index');
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
            $data = Banner::where('id', $id)->first();
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

            if ($request->hasFile('edit_img')) {

                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('edit_img');
                $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/Banner/';


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
            Banner::where(['id' => $request->banner_id])->update([

                'title' => $request->Title,
                'image' => $img,
                'updated_at' => date('Y-m-d H:i:s'),

            ]);
            DB::commit();
            Toastr::success('Banner updated successfully :)', 'Success');
            return redirect()->route('Banner.index');
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

            Banner::where(['id' => $request->id])->delete();
            DB::commit();
            Toastr::success('Banner deleted successfully :)', 'Success');
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

            $ids = $request->input('Banner_ids', []);
            Banner::whereIn('id', $ids)->delete();

            Toastr::success('Banner deleted successfully :)', 'Success');

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
