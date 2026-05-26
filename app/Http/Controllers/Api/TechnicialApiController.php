<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CityMaster;
use App\Models\StateMaster;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\PushNotificationController;
use App\Models\Customer;
use App\Models\Technicial;
use App\Models\AreaMaster;
use App\Models\CMSMaster;
use App\Models\TechnicialLedger;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Technicialwallet;
use App\Models\TechnicialWalletPayment;
use App\Models\Pincode;
use GuzzleHttp\Client;
use App\Models\Vendor;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Razorpay\Api\Api;



class TechnicialApiController extends Controller

// class DriverApiController extends PushNotificationController
{

    public function statelist(Request $request)
    {
        try {

            $listOfStates = StateMaster::select(
                "stateId",
                "stateName"
            )->orderBy('stateName', 'asc')->where(['iStatus' => 1, 'isDelete' => 0])->get();

            return response()->json([
                'success' => true,
                'message' => "successfully fetched StateList...",
                'data' => $listOfStates,
            ], 200);
        } catch (\Throwable $th) {

            // If there's an error, rollback any database transactions and return an error response.

            DB::rollBack();

            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        try {

            $request->validate([
                'mobile_no' => 'nullable|digits_between:10,15',
                'password' => 'required',
            ]);

            if (!$request->mobile_no) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please provide mobile number.',
                ], 422);
            }

            if ($request->mobile_no) {
                $input = $request->mobile_no;
                $fieldType = 'mobile_no';
            }

            $credentials = [
                $fieldType => $input,
                'password' => $request->password,
            ];

            // Fetch the vendor by email or mobile
            $Technicial = Technicial::where($fieldType, $input)->first();


            if (!$Technicial) {
                return response()->json([
                    'success' => false,
                    'message' => 'Technicial not found.',
                ], 404);
            }

            // Attempt to authenticate using the provided credentials
            if (Auth::guard('technicialapi')->attempt($credentials)) {
                $authenticatedVendor = Auth::guard('technicialapi')->user();

                $data = [
                    "Technicial_id" => $authenticatedVendor->Technicial_id,
                    "name" => $authenticatedVendor->name,
                    "email" => $authenticatedVendor->email,
                    "mobile_no" => $authenticatedVendor->mobile_no,
                    "stateid" => $authenticatedVendor->stateid,
                    "city" => $authenticatedVendor->city,
                    "iStatus" => $authenticatedVendor->iStatus,
                    "strIP" => $authenticatedVendor->strIP,
                    "created_at" => $authenticatedVendor->created_at,
                    "updated_at" => $authenticatedVendor->updated_at,
                ];

                // Generate JWT token
                $token = JWTAuth::fromUser($authenticatedVendor);

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful.',
                    'Technicialdetail' => $data,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ],
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials. Please check your input and password.',
                ], 401);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $th) {
            // Handle unexpected errors
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function change_password(Request $request)
    {
        try {

            if (Auth::guard('technicialapi')->check()) {

                $request->validate(
                    [
                        "Technicial_id" => 'required',
                        "old_password" => 'required',
                        "new_password" => 'required',
                        "confirm_new_password" => 'required|same:new_password'
                    ],
                    [
                        'Technicial_id.required' => 'Technicial ID is required.',
                        'old_password.required' => 'Old Password is required.',
                        'new_password.required' => 'New Password is required.',
                        'new_password.same' => 'New password and confirmation password must match.'
                    ]
                );

                $Technicial =  Technicial::where(['iStatus' => 1, 'isDelete' => 0, 'Technicial_id' => $request->Technicial_id])->first();
                if (!$Technicial) {
                    return response()->json([
                        'success' => false,
                        'message' => "Technicial not found."
                    ]);
                }

                if (Hash::check($request->old_password, $Technicial->password)) {

                    $newpassword = $request->new_password;
                    $confirmpassword = $request->confirm_new_password;

                    if ($newpassword == $confirmpassword) {

                        $Technicial->update([
                            'password' => Hash::make($confirmpassword),
                            'is_changepasswordfirsttime' => 1
                        ]);
                        return response()->json([
                            'success' => true,
                            'message' => 'Password updated successfully...',
                        ], 200);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'password and confirm password does not match',
                        ], 200);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Current Password does not match',
                    ], 200);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Technicial is not Authorised.',
                ], 401);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            // If there's an error, rollback any database transactions and return an error response.
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function forgot_password(Request $request)
    {
        try {
            $request->validate([
                'mobile_no' => 'required',
            ]);

            // Find the vendor by email
            $Technicial = Technicial::where(['iStatus' => 1, 'isDelete' => 0])
                ->where('mobile_no', $request->mobile_no)
                ->first();

            if (!$Technicial) {
                return response()->json([
                    'success' => false,
                    'message' => "Technicial not found."
                ], 404);
            }

            $otp = rand(1000, 9999);
            $expiry_date = now()->addMinutes(5);

            // Update the OTP and expiry in the database
            $Technicial->update([
                'otp' => $otp,
                'expiry_time' => $expiry_date,
            ]);

            // Send the email
            $sendEmailDetails = DB::table('sendemaildetails')->where(['id' => 9])->first();
            $msg = [
                'FromMail' => $sendEmailDetails->strFromMail,
                'Title' => $sendEmailDetails->strTitle,
                'ToEmail' => $Technicial->email,
                'Subject' => $sendEmailDetails->strSubject,
            ];

            $data = array(
                'otp' => $otp,
                "name" => $Technicial->name
            );


            Mail::send('emails.forgotPassword', ['data' => $data], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->subject($msg['Subject']);
            });

            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully.'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function forgot_password_verifyOTP(Request $request)
    {
        try {
            $request->validate([

                'otp' => 'required'
            ]);

            $password = mt_rand(100000, 999999);


            $Technicial = Technicial::where([

                'otp' => $request->otp
            ])->first();

            if (!$Technicial) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP is invalid. Please enter a valid OTP.',
                ], 400);
            }

            // Check if the OTP has expired
            $expiryTime = Carbon::parse($Technicial->expiry_time);
            if (now()->greaterThan($expiryTime)) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP has expired.',
                ], 400);
            }

            // Mark the OTP as verified and update the last login time
            $Technicial->update([
                // 'isOtpVerified' => 1,
                'password' =>  Hash::make($password),
                'last_login' => now(),
            ]);

            $data = array(
                'password' => $password,
                "name" =>  $Technicial->name,
                "mobile_no" =>  $Technicial->mobile_no


            );

            $sendEmailDetails = DB::table('sendemaildetails')->where(['id' => 9])->first();
            $msg = array(
                'FromMail' => $sendEmailDetails->strFromMail,
                'Title' => $sendEmailDetails->strTitle,
                'ToEmail' => $Technicial->email,
                'Subject' => $sendEmailDetails->strSubject
            );

            Mail::send('emails.forgotpasswordmail', ['data' => $data], function ($message) use ($msg) {
                $message->from($msg['FromMail'], $msg['Title']);
                $message->to($msg['ToEmail'])->subject($msg['Subject']);
            });
            // $vendorDetails = $vendor->only(['vendor_id','vendorname', 'isOtpVerified', 'login_id', 'vendormobile', 'email', 'businessname', 'businessaddress','vendorsocialpage','businesscategory','businessubcategory','is_changepasswordfirsttime']);
            return response()->json([
                'success' => true,
                'message' => 'OTP is valid.',
                // 'vendor_details' => $vendorDetails,

            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    public function logout(Request $request)
    {

        try {
            // Validate the vendorid passed in the request
            $request->validate([
                'Technicial_id' => 'required|integer'
            ]);
            // Optionally, fetch the vendor by vendorid (if you need to check or log something)
            $Technicial = Technicial::find($request->Technicial_id);
            if (!$Technicial) {
                return response()->json([
                    'success' => false,
                    'message' => 'Technicial not found.'
                ], 404);
            }
            Auth::logout();
            session()->flush();
            // Optional: If you want to send the vendor details in the response
            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out.',
                'Technicial_id' => $Technicial->Technicial_id,  // Including the vendorid in the response
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token. Unable to logout.',
            ], 401);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function technicialdashboard(Request $request)
    {

        try {
            $request->validate([
                'Technicial_id' => 'required|integer'
            ]);
            $Technicialbal = TechnicialLedger::where('Technicial_id', $request->Technicial_id)
                ->orderBy('Technicial_ledger_id', 'DESC')
                ->first();

            $balance = $Technicialbal->closing_bal ?? 0;

            $assignedPincodes = Pincode::whereIn('pin_id', function ($query) use ($request) {
                $query->select('Pincode_id')
                    ->from('Technicial_Pincode')
                    ->where('Technicial_id', $request->Technicial_id);
            })->pluck('pincode')->toArray();


            $Availableorder = Order::where('order_status', 0)
                ->whereIn('Pincode', $assignedPincodes)
                ->count();
            $Ongoingorder = Order::where('order_status', 1)
                ->orWhere('Technicial_id', $request->Technicial_id)
                ->count();

            return response()->json([
                'success' => true,
                'message' => 'data fetch Successfully.',
                'Balance' => $balance,
                'Availableorder' => $Availableorder,
                'Ongoingorder' => $Ongoingorder
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token. Unable to logout.',
            ], 401);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function available_or_complete_order_list(Request $request)
    {
        try {
            $request->validate([
                'Technicial_id' => 'required|integer',
                'status' => 'required'
            ]);

            $assignedPincodes = Pincode::whereIn('pin_id', function ($query) use ($request) {
                $query->select('Pincode_id')
                    ->from('Technicial_Pincode')
                    ->where('Technicial_id', $request->Technicial_id);
            })->pluck('pincode')->toArray();

            if ($request->status == 0) {
                $order = Order::with('slot', 'orderdetail.subcategory.category')->where('order_status', 0)
                    ->whereIn('Pincode', $assignedPincodes)
                    ->get();
            } else {
                $order = Order::with('slot', 'orderdetail.subcategory.category')
                    ->where(function ($query) use ($request) {
                        $query->where('order_status', 1)
                            ->orWhere('Technicial_id', $request->Technicial_id);
                    })
                    ->get();
            }

            // Append full image URLs dynamically while avoiding duplicates
            $order->transform(function ($item) {
                foreach ($item->orderdetail as $detail) {
                    if ($detail->subcategory) {
                        if (!empty($detail->subcategory->SubCategories_img) && !str_starts_with($detail->subcategory->SubCategories_img, 'http')) {
                            $detail->subcategory->SubCategories_img = "https://getdemo.in/Mkservice/upload/subcategory-images/" . $detail->subcategory->SubCategories_img;
                        }

                        if ($detail->subcategory->category) {
                            if (!empty($detail->subcategory->category->Categories_img) && !str_starts_with($detail->subcategory->category->Categories_img, 'http')) {
                                $detail->subcategory->category->Categories_img = "https://getdemo.in/Mkservice/upload/category-images/" . $detail->subcategory->category->Categories_img;
                            }
                        }
                    }
                }
                return $item;
            });

            if ($order->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'order not found.',
                ], 400);
            }

            return response()->json([
                'success' => true,
                'data' => $order,
                'message' => 'order fetched successfully.',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }



    public function Technicial_startverifyOTP(Request $request)
    {
        try {
            $request->validate([
                'iOrderId' => 'required',
                'Technicial_id' => 'required',
                'start_otp' => 'required'
            ]);

            // Fetch the order
            $Technicialorder = Order::where('iOrderId', $request->iOrderId)->first();

            // Check if order exists
            if (!$Technicialorder) {
                return response()->json([
                    'success' => false,
                    'message' => 'Enter valid order.',
                ], 400);
            }

            // Validate OTP
            if ($Technicialorder->start_otp != $request->start_otp) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP is invalid. Please enter a valid OTP.',
                ], 400);
            }
            $Technicialorder->update([
                'Technicial_id' => $request->Technicial_id,
                'start_work' =>  1
            ]);


            return response()->json([
                'success' => true,
                'message' => 'OTP is valid.',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function Technicial_endverifyOTP(Request $request)
    {
        try {
            $request->validate([
                'iOrderId' => 'required|exists:orders,iOrderId',
                'Technicial_id' => 'required|exists:Technicial,Technicial_id',
                'end_otp' => 'required'
            ]);

            $Technicialorder = Order::where('iOrderId', $request->iOrderId)->first();

            if (!$Technicialorder) {
                return response()->json([
                    'success' => false,
                    'message' => 'Enter valid order.',
                ], 400);
            }

            // Validate OTP
            if ($Technicialorder->end_otp != $request->end_otp) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP is invalid. Please enter a valid OTP.',
                ], 400);
            }
            $Technicialorder->update([
                'Technicial_id' => $request->Technicial_id,
                'order_status' => 2,
                'start_work' =>  2
            ]);

            return response()->json([
                'success' => true,
                'message' => 'OTP is valid.',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function profiledetails(Request $request)
    {
        try {

            $request->validate([
                'Technicial_id' => 'required|integer'

            ]);

            $Technicial = Technicial::with('state')->where('Technicial_id', $request->Technicial_id)
                ->where('iStatus', 1)
                ->where('isDelete', 0)
                ->first();
            //dd($Technicial);


            if (!$Technicial) {
                return response()->json([
                    'success' => false,
                    'message' => 'Technicial not found.',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'data' => [
                    "name" => $Technicial->name,
                    "email" => $Technicial->email,
                    "mobile_no" => $Technicial->mobile_no,
                    "Technicial_image" => $Technicial->Technicial_image
                        ? asset('upload/Technicial/' . $Technicial->Technicial_image)
                        : '',
                    "stateid" => $Technicial->stateid,
                    "stateName" => $Technicial->state->stateName,
                    "city" => $Technicial->city,
                    "iStatus" => $Technicial->iStatus,
                    "strIP" => $Technicial->strIP,
                    "created_at" => $Technicial->created_at,
                    "updated_at" => $Technicial->updated_at,
                ],
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching profile details.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function profileUpdate(Request $request)
    {
        try {

            if (Auth::guard('technicialapi')->check()) {

                $customer = Auth::guard('technicialapi')->user();

                $request->validate([
                    'Technicial_id' => 'required'
                ]);

                $Technicial = Technicial::where(['iStatus' => 1, 'isDelete' => 0, 'Technicial_id' => $request->Technicial_id])->first();

                if (!$Technicial) {
                    return response()->json([
                        'success' => false,
                        'message' => "Technicial not found."
                    ]);
                }

                // Start building the Vendor data
                $TechnicialData = [];

                // Add fields conditionally
                if ($request->has('name')) {
                    $TechnicialData["name"] = $request->name;
                }
                if ($request->has('email')) {
                    $TechnicialData["email"] = $request->email;
                }
                if ($request->has('mobile_no')) {
                    $TechnicialData["mobile_no"] = $request->mobile_no;
                }
                if ($request->has('stateid')) {
                    $TechnicialData["stateid"] = $request->stateid;
                }
                if ($request->has('city')) {
                    $TechnicialData["city"] = $request->city;
                }



                if ($request->hasFile('Technicial_image')) {
                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $image = $request->file('Technicial_image');
                    $imgName = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                    $destinationPath = $root . '/upload/Technicial/';

                    // Ensure the directory exists
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }

                    // Move the uploaded image to the destination path
                    $image->move($destinationPath, $imgName);

                    // Delete the old image if it exists
                    if ($customer->Customerimg && file_exists($destinationPath . $customer->Customerimg)) {
                        unlink($destinationPath . $customer->Customerimg);
                    }

                    // Update the image name
                    $TechnicialData['Technicial_image'] = $imgName;
                }

                // Always update 'updated_at'
                $TechnicialData['updated_at'] = now();

                DB::beginTransaction();

                try {

                    Technicial::where(['Technicial_id' => $request->Technicial_id])->update($TechnicialData);

                    DB::commit();

                    return response()->json([
                        'success' => true,
                        'message' => "Technicial Profile updated successfully.",

                    ], 200);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    throw $th;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Technicial is not authorized.',
                ], 401);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function wallet_load(Request $request)
    {

        try {
            if (Auth::guard('technicialapi')->check()) {

                $request->validate([
                    "Technicial_id" => 'required',
                    "Amount" => 'required|numeric|min:1',

                ]);
                DB::beginTransaction();
                $Technicial = Technicial::where('Technicial_id', $request->Technicial_id)->first();
                if (!$Technicial) {
                    return response()->json([
                        'message' => 'Technicial not found',
                        'success' => false,
                    ], 404);
                }
                $orderdata = array(

                    "Technicial_id" => $request->Technicial_id,
                    "Amount" => $request->Amount,
                    "strIP" => $request->ip(),
                    "created_at" => now(),
                );
                $Order = Technicialwallet::create($orderdata);
                $orderid = 'Tech' . $Order->Technicial_wallet_id;
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $OrderAmount = $Order->Amount * 100;
                $orderData = [
                    'receipt'         => $orderid . '-' . date('dmYHis'),
                    'amount'          => $Order->Amount * 100,
                    'currency'        => 'INR',
                ];
                $razorpayOrder = $api->order->create($orderData);
                $orderId = $razorpayOrder['id'];
                $razorpayResponse = array(
                    'order_id' => $orderId,
                    'oid' => $orderid,
                    'amount' => $Order->Amount,
                    'currency' => 'INR',
                    'receipt' => $razorpayOrder['receipt'],
                );
                DB::commit();
                return [
                    'success' => true,
                    "message" => "order created successfully !",
                    "data" => $orderdata,
                    "razorpayResponse" => $razorpayResponse
                ];
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Technicial is not authorized.',
                ], 401);
            }
        } catch (ValidationException $e) {
            DB::rollBack();
            // Format validation errors as a single string
            $errorMessage = implode(', ', Arr::flatten($e->errors()));

            return response()->json([
                'success' => false,
                'message' => $errorMessage,
            ], 422);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function paymentstatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'status' => 'required|string',
                'razorpay_payment_id' => 'required',
                'order_id' => 'required|string',
                'Technicial_id' => 'required|exists:Technicial,Technicial_id',
                'razorpay_order_id' => 'required|string',
                'razorpay_signature' => 'nullable|string',
                'amount' => 'required|numeric|min:1',
                'currency' => 'required|string',
                'json' => 'nullable',
            ]);

            $data = [
                'order_id' => $request->razorpay_payment_id,
                'oid' => $request->order_id,
                'Technicial_id' => $request->Technicial_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature,
                'receipt' => $request->order_id . '-' . date('dmYHis'),
                'amount' => $request->amount,
                'currency' => $request->currency,
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now(),
                'json' => $request->json,
                'Remarks' => "Online Payment"
            ];

            DB::table('Technicial_wallet_payment')->insert($data);

            if ($request->status == "Success") {
                // Get the latest balance of the technician
                $technicialId = $request->Technicial_id;
                $amount = $request->amount;

                $lastLedger = TechnicialLedger::where('Technicial_id', $technicialId)
                    ->orderBy('created_at', 'desc')
                    ->first();

                $openingBal = $lastLedger ? $lastLedger->closing_bal : 0;

                $cr = $amount;

                $closingBal = $openingBal + $cr;
                // Insert new ledger entry
                TechnicialLedger::create([
                    'Technicial_id' => $technicialId,
                    'comments' => 'Wallet Load',
                    'opening_bal' => $openingBal,
                    'Cr' => $cr,
                    'Dr' => 0,
                    'closing_bal' => $closingBal,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'strIP' => $request->ip(),
                ]);
            } elseif ($request->status == "Fail") {  // Corrected this line
                echo "Fail";
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Payment status updated successfully.",
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => implode(', ', Arr::flatten($e->errors())),
            ], 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function claimOrder(Request $request)
    {
        try {
            $request->validate([
                "Technicial_id" => 'required|exists:Technicial,Technicial_id',
                "Order_id" => 'required|exists:order,iOrderId',
                "Amount" => 'required|numeric|min:1',
            ]);

            DB::beginTransaction();

            // Get Technician's latest balance
            $technicialId = $request->Technicial_id;
            $orderAmount = $request->Amount;

            $lastLedger = TechnicialLedger::where('Technicial_id', $technicialId)
                ->orderBy('created_at', 'desc')
                ->first();

            $availableBalance = $lastLedger ? $lastLedger->closing_bal : 0;

            if ($availableBalance < $orderAmount) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient balance. Please load your wallet.',
                ], 400);
            }

            // Deduct the amount from the technician's wallet
            $openingBal = $availableBalance;
            $dr = $orderAmount;
            $closingBal = $openingBal - $dr;

            // Insert new ledger entry
            TechnicialLedger::create([
                'Technicial_id' => $technicialId,
                'comments' => 'Order claimed - ID: ' . $request->Order_id,
                'opening_bal' => $openingBal,
                'Cr' => 0,
                'Dr' => $dr,
                'closing_bal' => $closingBal,
                'created_at' => now(),
                'updated_at' => now(),
                'strIP' => $request->ip(),
            ]);

            // Mark order as claimed
            Order::where(
                'iOrderId',
                $request->Order_id
            )->update(['order_status' => 1, 'Technicial_id' => $request->Technicial_id]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order claimed successfully!',
                'new_balance' => $closingBal,
            ]);
        } catch (ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => implode(', ', Arr::flatten($e->errors())),
            ], 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
