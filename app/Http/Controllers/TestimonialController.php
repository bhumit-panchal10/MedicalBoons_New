<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StateMaster;
use App\Models\Testimonial;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;


class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $testimonials = Testimonial::orderBy('Testimonial_id', 'asc')
                ->paginate(env('PER_PAGE'));
            return view('Testimonial.index', compact('testimonials'));
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

            ]);

            $img = "";
            if ($request->hasFile('image')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('image');
                $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/testimonial/';
                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }
                $image->move($destinationpath, $img);
            }

            Testimonial::create([
                'name' => $request->name,
                'comment' => $request->description,
                'photo' => $img,

            ]);

            DB::commit();

            Toastr::success('Testimonial created successfully :)', 'Success');
            return redirect()->route('Testimonial.index');
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
            Toastr::error('Failed to create Testimonial: ' . $th->getMessage(), 'Error');
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }
    public function edit(Request $request, $id)
    {

        try {
            $data = Testimonial::where('Testimonial_id', $id)->first();
            return json_encode($data);
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'name' => 'required',
            ]);

            $img = "";
            if ($request->hasFile('edit_img')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('edit_img');
                $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/testimonial/';
                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }
                $image->move($destinationpath, $img);
                $oldImg = $request->input('hiddenPhoto') ? $request->input('hiddenPhoto') : null;

                if ($oldImg != null || $oldImg != "") {
                    if (file_exists($destinationpath . $oldImg)) {
                        unlink($destinationpath . $oldImg);
                    }
                }
            } else {
                $oldImg = $request->input('hiddenPhoto');
                $img = $oldImg;
            }

            $data = [
                'name' => $request->name,
                'comment' => $request->editdescription,
                'photo' => $img,

            ];

            Testimonial::where("Testimonial_id", "=", $request->Testimonial_id)->update($data);

            DB::commit();

            Toastr::success('Testimonial updated successfully :)', 'Success');
            return redirect()->route('Testimonial.index');
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
            $testimonial = Testimonial::where(['Testimonial_id' => $request->id])->first();

            $root = $_SERVER['DOCUMENT_ROOT'];
            //$destinationPath = $root . '/vybecab/upload/testimonial/';
            $destinationPath = $root . '/upload/testimonial/';

            // Check if the testimonial has an image and delete it if exists
            if ($testimonial->photo && file_exists($destinationPath . $testimonial->photo)) {
                unlink($destinationPath . $testimonial->photo);
            }

            Testimonial::where([

                'Testimonial_id' => $request->id
            ])->delete();

            DB::commit();

            Toastr::success('Testimonial deleted successfully :)', 'Success');
            // return back();
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
        // dd($request->all());
        try {
            $ids = $request->input('Testimonial_ids', []);
            $testimonials = Testimonial::whereIn('Testimonial_id', $ids)->get();

            //Testimonial::whereIn('id', $ids)->delete();
            $root = $_SERVER['DOCUMENT_ROOT'];
            // $destinationPath = $root . '/vybecab/upload/testimonial/';
            $destinationPath = $root . '/upload/testimonial/';
            foreach ($testimonials as $testimonial) {

                // Check if the testimonial has an image and delete it if exists
                if ($testimonial->photo && file_exists($destinationPath . $testimonial->photo)) {
                    unlink($destinationPath . $testimonial->photo);
                }
                Testimonial::whereIn('Testimonial_id', $ids)->delete();
            }

            Toastr::success('Testimonial deleted successfully :)', 'Success');
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
