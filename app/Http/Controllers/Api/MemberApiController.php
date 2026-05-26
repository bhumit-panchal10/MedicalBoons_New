<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\PushNotificationController;
use App\Models\FamilyMember;
use App\Models\CorporateOrder;
use GuzzleHttp\Client;
use App\Models\Member;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Razorpay\Api\Api;



class MemberApiController extends Controller

// class DriverApiController extends PushNotificationController
{


    public function login(Request $request)
    {
        try {

            $request->validate([
                'mobile_no' => 'required',
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
                $fieldType = 'mobile';
            }

            $credentials = [
                $fieldType => $input,
                'password' => $request->password,
            ];
            // Fetch the vendor by email or mobile
            $Member = Member::where($fieldType, $input)->first();


            if (!$Member) {
                return response()->json([
                    'success' => false,
                    'message' => 'Member not found.',
                ], 404);
            }

            // Attempt to authenticate using the provided credentials
            if (Auth::guard('memberapi')->attempt($credentials)) {
                $authenticatedmember = Auth::guard('memberapi')->user();
                $data = [
                    "id" => $authenticatedmember->id,
                    "name" => $authenticatedmember->name,
                    "email" => $authenticatedmember->email,
                    "mobile" => $authenticatedmember->mobile,
                    "address" => $authenticatedmember->address,
                    "state" => $authenticatedmember->state,
                    "city" => $authenticatedmember->city,
                    "pincode" => $authenticatedmember->pincode,
                    "Order_id" => $authenticatedmember->Order_id,
                    "iStatus" => $authenticatedmember->iStatus,
                    "strIP" => $authenticatedmember->strIP,
                    "created_at" => $authenticatedmember->created_at,
                    "updated_at" => $authenticatedmember->updated_at,
                ];

                // Generate JWT token
                $token = JWTAuth::fromUser($authenticatedmember);

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful.',
                    'Memberdetail' => $data,
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

     public function forgot_password(Request $request)
    {
        try {
           
           
                $request->validate([
                    'email' => 'required',
                ]);
              

                // Find the vendor by email
                $Member = Member::where(['iStatus' => 1, 'isDelete' => 0])
                    ->where('email', $request->email)
                    ->first();

                if (!$Member) {
                    return response()->json([
                        'success' => false,
                        'message' => "Member not found."
                    ], 404);
                }

                $otp = rand(1000, 9999);
                $expiry_date = now()->addMinutes(5);

                // Update the OTP and expiry in the database
                $Member->update([
                    'otp' => $otp,
                    'expiry_time' => $expiry_date,
                ]);

                // Send the email
                $sendEmailDetails = DB::table('sendemaildetails')->where(['id' => 9])->first();
                $msg = [
                    'FromMail' => $sendEmailDetails->strFromMail,
                    'Title' => $sendEmailDetails->strTitle,
                    'ToEmail' => $Member->email,
                    'Subject' => $sendEmailDetails->strSubject,
                ];

                $data = array(
                    'otp' => $otp,
                    "name" => $Member->name
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
    
   public function ActiveMember(Request $request)
   {
    try {
        $request->validate([
            'family_member_id' => 'required|integer'
        ]);

        // Update active_inactive to 1 for the family member with the provided ID
        $updated = FamilyMember::where('family_member_id', $request->family_member_id)
                               ->update(['active_inactive' => 0]);

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Active Member Successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No member found or already active.',
            ], 404);
        }

    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'errors' => $e->errors(),
        ], 422);
    } catch (\Throwable $th) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while activating the member.',
            'error' => $th->getMessage(),
        ], 500);
    }
}

    
    public function InactiveMember(Request $request)
    {
        try {

            $request->validate([
                'member_id' => 'required|integer'

            ]);

            $FamilyMembers = FamilyMember::where(['member_id' => $request->member_id,'active_inactive'=>1])->get();
           
          
            if (!$FamilyMembers) {
                return response()->json([
                    'success' => false,
                    'message' => 'Family Member not found',
                ], 404);
            }
            
            $data = $FamilyMembers->map(function ($FamilyMember) {
                return [
                    "family_member_id" => $FamilyMember->family_member_id,
                    "member_name" => $FamilyMember->member_name,
                    "DOB" => $FamilyMember->DOB,
                    "active_inactive" => $FamilyMember->active_inactive,
                    "created_at" => $FamilyMember->created_at,
                    "updated_at" => $FamilyMember->updated_at,
                    "gender" => $FamilyMember->gender,
                    'member_id' => $FamilyMember->member_id
                ];
            });

            return response()->json([
                'success' => true,
                'data' =>$data,
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

    public function profiledetails(Request $request)
    {
        try {

            $request->validate([
                'member_id' => 'required|integer'

            ]);

            $Member = Member::with('familyMembers')->find($request->member_id);
            $Member = Member::with(['familyMembers' => function ($query) {
                $query->where('active_inactive', 0);
            }])->find($request->member_id);
            $orderid = $Member->Order_id ?? ''; 
          
            if (!$Member) {
                return response()->json([
                    'success' => false,
                    'message' => 'Member not found',
                ], 404);
            }

            $familyMembers = $Member->familyMembers->map(function ($member) {
                return [
                    'family_member_id' => $member->family_member_id,
                    'member_name' => $member->member_name,
                    'gender' => $member->gender == 1 ? 'Male' : ($member->gender == 2 ? 'Female' : 'Other'),
                    'DOB' => $member->DOB,
                    'member_id' => $member->member_id,

                    // Add other fields as needed
                ];
            });
            $Corporateorder = CorporateOrder::where('Corporate_Order_id',$orderid)->first();
          
            $expirydate = $Corporateorder->end_date ?? null;
           
            $iPlanMembers = $Corporateorder->iPlanMembers ?? null;
            $iExtraMember = $Corporateorder->iExtraMember ?? null;

         
            // Calculate expiry flag
            $expiryFlag = 0;
            if ($expirydate) {
                $expiry = Carbon::parse($expirydate)->startOfDay(); // normalize to date
                $today  = Carbon::today();                          // server tz
                // Flag = 1 when expired (expiry date is today or earlier)
                $expiryFlag = $expiry->gt($today) ? 0 : 1;
            }
           
            return response()->json([
                'success' => true,
                'data' => [
                    "id" => $Member->id,
                    "name" => $Member->name,
                    "email" => $Member->email,
                    "mobile" => $Member->mobile,
                    "created_at" => $Member->created_at,
                    "updated_at" => $Member->updated_at,
                    "expiry_date"    => $expirydate,
                    "expiry_flag"    => $expiryFlag,
                    "Plan_member"    => $iPlanMembers,
                    "extra_member"    => $iExtraMember,
                    'family_members' => $familyMembers
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

    public function change_password(Request $request)
    {
        try {

            if (Auth::guard('memberapi')->check()) {

                $request->validate(
                    [
                        "member_id" => 'required',
                        "old_password" => 'required',
                        "new_password" => 'required',
                        "confirm_new_password" => 'required|same:new_password'
                    ],
                    [
                        'member_id.required' => 'Member ID is required.',
                        'old_password.required' => 'Old Password is required.',
                        'new_password.required' => 'New Password is required.',
                        'new_password.same' => 'New password and confirmation password must match.'
                    ]
                );

                $Member =  Member::where(['iStatus' => 1, 'isDelete' => 0, 'id' => $request->member_id])->first();
                if (!$Member) {
                    return response()->json([
                        'success' => false,
                        'message' => "Member not found."
                    ]);
                }

                if (Hash::check($request->old_password, $Member->password)) {

                    $newpassword = $request->new_password;
                    $confirmpassword = $request->confirm_new_password;

                    if ($newpassword == $confirmpassword) {

                        $Member->update([
                            'password' => Hash::make($confirmpassword)
                            //'is_changepasswordfirsttime' => 1
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
                    'message' => 'Member is not Authorised.',
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

    public function forgot_password_verifyOTP(Request $request)
    {
        try {
            $request->validate([

                'otp' => 'required'
            ]);

            $Member = Member::where([

                'otp' => $request->otp
            ])->first();

            if (!$Member) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP is invalid. Please enter a valid OTP.',
                ], 400);
            }

            // Check if the OTP has expired
            $expiryTime = Carbon::parse($Member->expiry_time);
            if (now()->greaterThan($expiryTime)) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP has expired.',
                ], 400);
            }
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
    public function Reset_password(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $Member = Member::where([
                'email' => $request->email
            ])->first();

            if (!$Member) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email is invalid. Please enter a valid email.',
                ], 400);
            }
            $Member->update([
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Password reset successfully.',
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
}
