<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Ourclient;
use Brian2694\Toastr\Facades\Toastr;
use GPBMetadata\Google\Api\Service;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;



class OurClientController extends Controller

{

    public function index(Request $request)
    {
        try {

            $Ourclients = Ourclient::paginate(config('app.per_page'));
            return view('OUR_Client.index', compact('Ourclients'));
        } catch (\Throwable $th) {
            \Toastr::error('Error: ' . $th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function store(Request $request)

    {
        DB::beginTransaction();
        try {

             
            $img = "";
            if ($request->hasFile('image')) {
                $root = $_SERVER['DOCUMENT_ROOT'];
                $image = $request->file('image');
                $img = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                $destinationpath = $root . '/upload/OurClient-images/';

                if (!file_exists($destinationpath)) {
                    mkdir($destinationpath, 0755, true);
                }

                $image->move($destinationpath, $img);
            }

            $Ourclient = Ourclient::create([

                'image' => $img,
                'name' => $request->name ?? '',
            ]);
            DB::commit();
            Toastr::success('Our Client created successfully :)', 'Success');

            return redirect()->route('our_client.index');
        } catch (ValidationException $e) {

            DB::rollBack();

            $errors = $e->errors(); // Get the errors array

            $errorMessages = []; // Initialize an array to hold error messages

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



    public function delete(Request $request)

    {

        DB::beginTransaction();
        try {
            Ourclient::where(['our_client_id' => $request->id])->delete();
            DB::commit();
            Toastr::success('Our Client deleted successfully :)', 'Success');
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

            $ids = $request->input('our_client_ids', []);

            Ourclient::whereIn('our_client_id', $ids)->delete();

            Toastr::success('Our Client deleted successfully :)', 'Success');

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
