<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CityMaster;
use App\Models\StateMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\PushNotificationController;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Managerate;
use App\Models\Offer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pincode;
use App\Models\CustomerCouponApplyed;
use GuzzleHttp\Client;
use App\Models\Timeslot;
use App\Models\Recruitment;
use Google\Service\Monitoring\Custom;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\BaseURL;
use Razorpay\Api\Api;




class CustomerApiController extends Controller

{
    public function customer_new_registration(Request $request)
    {
        // dd($request);
        try {


            $request->validate([
                "Customer_name" => 'required',
                "Customer_Address" => 'nullable|string',
                "Customer_phone" => 'required|digits:10|unique:Customer,Customer_phone',
                "Pincode" => 'nullable',
                "city_id" => 'required'

            ]);
            $existingCustomer = Customer::where('Customer_phone', $request->Customer_phone)->first();
            if ($existingCustomer) {
                return response()->json([
                    'success' => false,
                    'message' => 'A customer with this mobile number already exists.',
                ], 409); // 409 Conflict HTTP status code
            }
            $Customerdata = array(

                "Customer_name" => $request->Customer_name,
                "Customer_phone" => $request->Customer_phone,
                "Customer_Address" => $request->Customer_Address,
                "Pincode" => $request->Pincode,
                "city_id" => $request->city_id,
                'strIP' => $request->ip(),
            );

            $Customer = Customer::create($Customerdata);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Registration Successfully.',
            ], 200);
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

    public function login(Request $request)
    {
        try {
            // Validate phone number (required and must be 10-15 digits)
            $request->validate([
                'Customer_phone' => 'required|digits_between:10,15',
            ]);

            // Fetch the customer by phone number
            $customer = Customer::where('Customer_phone', $request->Customer_phone)->first();

            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer not found.',
                ], 404);
            }

            // Generate JWT token (without password authentication)
            $token = JWTAuth::fromUser($customer);

            return response()->json([
                'success' => true,
                'message' => 'Login successful.',
                'customerdetail' => [
                    "Customer_id" => $customer->Customer_id,
                    "Customer_name" => $customer->Customer_name,
                    "Customer_phone" => $customer->Customer_phone,
                    "city_id" => $customer->city_id,
                    "iStatus" => $customer->iStatus,
                    "strIP" => $customer->strIP,
                    "created_at" => $customer->created_at,
                    "updated_at" => $customer->updated_at,
                ],
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ],
            ], 200);
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

    public function startotp(Request $request)
    {
        try {

            $request->validate([
                "order_id" => 'required',
                "Customer_id" => 'required',

            ]);
            $otp = mt_rand(100000, 999999);
            $existingCustomer = Order::where(function ($query) use ($request) {
                $query->where('iOrderId', $request->iOrderId)
                    ->orWhere('iCustomerId', $request->Customer_id);
            })->first();

            if (empty($existingCustomer)) {
                return response()->json([
                    'success' => false,
                    'message' => 'A customer with this order not found.',
                ], 409);
            }
            $updateotp = array(
                'start_otp' => $otp
            );
            DB::beginTransaction();
            Order::where("iOrderId", $request->order_id)->update($updateotp);
            DB::commit();
            return response()->json([
                'success' => true,
                'start_otp' => $otp,
                'message' => 'Start OTP sent Successfully',
            ], 200);
        } catch (ValidationException $e) {
            DB::rollBack();
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

    public function endotp(Request $request)
    {
        try {

            $request->validate([
                "order_id" => 'required',
                "Customer_id" => 'required',

            ]);
            $otp = mt_rand(100000, 999999);
            $existingCustomer = Order::where(function ($query) use ($request) {
                $query->where('iOrderId', $request->iOrderId)
                    ->orWhere('iCustomerId', $request->Customer_id);
            })->first();

            if (empty($existingCustomer)) {
                return response()->json([
                    'success' => false,
                    'message' => 'A customer with this order not found.',
                ], 409);
            }
            $updateotp = array(
                'end_otp' => $otp
            );
            DB::beginTransaction();
            Order::where("iOrderId", $request->order_id)->update($updateotp);
            DB::commit();
            return response()->json([
                'success' => true,
                'end_otp' => $otp,
                'message' => 'End OTP sent Successfully',
            ], 200);
        } catch (ValidationException $e) {
            DB::rollBack();
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

    public function profiledetails(Request $request)
    {
        try {

            $request->validate([
                'Customer_id' => 'required|integer'
            ]);

            $Customer = Customer::with('city')->where('Customer_id', $request->Customer_id)
                ->where('iStatus', 1)
                ->where('isDelete', 0)
                ->first();

            if (!$Customer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer not found.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    "Customer_name" => $Customer->Customer_name,
                    "Customer_Address" => $Customer->Customer_Address,
                    "Customer_phone" => $Customer->Customer_phone,
                    "Customerimg" => $Customer->Customerimg
                        ? asset('upload/Customer/' . $Customer->Customerimg)
                        : '',
                    "Pincode" => $Customer->Pincode,
                    "city_id" => $Customer->city_id,
                    "cityname" => $Customer->city->cityName ?? '',
                    "email" => $Customer->email,
                    "iStatus" => $Customer->iStatus,
                    "strIP" => $Customer->strIP,
                    "created_at" => $Customer->created_at,
                    "updated_at" => $Customer->updated_at,
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

            if (Auth::guard('customerapi')->check()) {

                $customer = Auth::guard('customerapi')->user();

                $request->validate([
                    'Customer_id' => 'required'
                ]);

                $customer = Customer::where(['iStatus' => 1, 'isDelete' => 0, 'Customer_id' => $request->Customer_id])->first();

                if (!$customer) {
                    return response()->json([
                        'success' => false,
                        'message' => "Customer not found."
                    ]);
                }

                // Start building the Vendor data
                $CustomerData = [];

                // Add fields conditionally
                if ($request->has('Customer_name')) {
                    $CustomerData["Customer_name"] = $request->Customer_name;
                }
                if ($request->has('Customer_Address')) {
                    $CustomerData["Customer_Address"] = $request->Customer_Address;
                }
                if ($request->has('Customer_phone')) {
                    $CustomerData["Customer_phone"] = $request->Customer_phone;
                }
                if ($request->has('Pincode')) {
                    $CustomerData["Pincode"] = $request->Pincode;
                }
                if ($request->has('city_id')) {
                    $CustomerData["city_id"] = $request->city_id;
                }
                if ($request->has('email')) {
                    $CustomerData["email"] = $request->email;
                }


                if ($request->hasFile('Customerimg')) {
                    $root = $_SERVER['DOCUMENT_ROOT'];
                    $image = $request->file('Customerimg');
                    $imgName = time() . '_' . date('dmYHis') . '.' . $image->getClientOriginalExtension();
                    $destinationPath = $root . '/upload/Customer/';

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
                    $CustomerData['Customerimg'] = $imgName;
                }

                // Always update 'updated_at'
                $CustomerData['updated_at'] = now();

                DB::beginTransaction();

                try {

                    Customer::where(['Customer_id' => $request->Customer_id])->update($CustomerData);

                    DB::commit();

                    return response()->json([
                        'success' => true,
                        'message' => "Customer Profile updated successfully.",
                        // 'data' => [
                        //     'vendorimg' => isset($CustomerData['Customerimg']) ? asset('upload/Customer/' . $CustomerData['Customerimg']) : null,
                        // ]
                    ], 200);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    throw $th;
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer is not authorized.',
                ], 401);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function categories(Request $request)
    {

        try {
            $categories = Categories::select(
                "Categories_id",
                "Category_name",
                "Categories_img"
            )->get();

            $categories->each(function ($category) {
                $category->Categories_img = "https://getdemo.in/Mkservice/upload/category-image/{$category->Categories_img}";
            });

            return response()->json([
                'message' => 'successfully categories fetched...',
                'success' => true,
                'data' => $categories,
            ], 200);
        } catch (\Throwable $th) {
            // If there's an error, rollback any database transactions and return an error response.
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function city(Request $request)
    {

        try {
            $City = CityMaster::select(
                "cityId",
                "cityName"
            )->get();
            return response()->json([
                'message' => 'successfully City fetched...',
                'success' => true,
                'data' => $City,
            ], 200);
        } catch (\Throwable $th) {
            // If there's an error, rollback any database transactions and return an error response.
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function subcat_or_rate(Request $request)
    {
        $request->validate([
            'Categories_id' => 'required',
            'Customer_id' => 'required',
            'city_id' => 'required',
        ]);
        $subcategoryid = Cart::where('Categories_id', $request->Categories_id)
            ->where('Customer_id', $request->Customer_id)
            ->pluck('subcate_id')
            ->toArray();
        try {
            // $category = Categories::with(['subcategories', 'rates.subcategory'])
            //     ->where('Categories_id', $request->Categories_id)
            //     ->first();

            $category = Categories::with([
                'subcategories',
                'rates' => function ($query) use ($request) {
                    $query->where('city_id', $request->city_id); // Filtering by city_id
                },
                'rates.subcategory'
            ])->where('Categories_id', $request->Categories_id)
                ->first();

            if (!$category) {
                return response()->json([
                    'message' => 'No category found.',
                    'success' => false,
                ], 404);
            }

            return response()->json([
                'message' => 'Successfully fetched category with subcategories and rates.',
                'success' => true,
                'data'    => [
                    'Categories_id'  => $category->Categories_id,
                    'Category_name'  => $category->Category_name,
                    'subcategories'  => $category->subcategories->map(function ($sub) {
                        return [
                            'iSubCategoryId'   => $sub->iSubCategoryId,
                            'strSubCategoryName' => $sub->strSubCategoryName,
                            'SubCategories_img'  => "https://getdemo.in/Mkservice/upload/subcategory-images/{$sub->SubCategories_img}",
                        ];
                    }),
                    'rates' => $category->rates->map(function ($rate) use ($subcategoryid) {
                        $is_cart = in_array($rate->subcategory->iSubCategoryId, $subcategoryid) ? "1" : "0";

                        return [
                            'rate_id'      => $rate->rate_id,
                            'title'        => $rate->title,
                            'description'  => $rate->description,
                            'amount'       => $rate->amount,
                            'time'       => $rate->time,
                            'is_cart'      => $is_cart,
                            'subcategory'  => $rate->subcategory ? [
                                'iSubCategoryId'   => $rate->subcategory->iSubCategoryId,
                                'strSubCategoryName' => $rate->subcategory->strSubCategoryName,
                                'SubCategories_img'  => "https://getdemo.in/Mkservice/upload/subcategory-images/{$rate->subcategory->SubCategories_img}",
                            ] : null,
                        ];
                    }),
                ],
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function ongoingorder(Request $request)
    {
        $request->validate([
            'Customer_id' => 'required'
        ]);

        try {
            $ongoingorders = Order::with('slot', 'orderdetail.subcategory.category')
                ->where('iCustomerId', $request->Customer_id)
                ->whereIn('order_status', [0, 1])
                ->where(function ($query) {
                    $query->where('payment_mode', 2) // Include all cash payments
                        ->orWhere(function ($q) {
                            $q->where('payment_mode', 1) // Only for online payments
                                ->whereIn('isPayment', [0, 1]); // Exclude failed (2) payments
                        });
                })
                ->get()
                ->toArray();
            $orderArr = [];
            foreach ($ongoingorders as $order) {

                $list = [];

                foreach ($order['orderdetail'] as $detail) {
                    $subcategory = $detail['subcategory'];
                    $category = $subcategory['category'];

                    $list[] = [
                        "Categories_id" => $category['Categories_id'],
                        "Category_name" => $category['Category_name'],
                        "Categories_slug" => $category['Categories_slug'],
                        "Categories_img" => 'http://127.0.0.1:8000/upload/category-images/' . $category['Categories_img'],
                        "iSubCategoryId" => $subcategory['iSubCategoryId'],
                        "iSequence" => $subcategory['iSequence'],
                        "iCategoryId" => $subcategory['iCategoryId'],
                        "strCategoryName" => $subcategory['strCategoryName'],
                        "strSubCategoryName" => $subcategory['strSubCategoryName'],
                        "strSlugName" => $subcategory['strSlugName'],
                        "SubCategories_img" => 'http://127.0.0.1:8000/upload/subcategory-images/' . $subcategory['SubCategories_img'],
                        "iOrderDetailId" => $detail['iOrderDetailId'],
                        "iOrderId" => $detail['iOrderId'],
                        "iCustomerId" => $detail['iCustomerId'],
                        "category_id" => $detail['category_id'],
                        "Ratecard_id" => $detail['Ratecard_id'],
                        "qty" => $detail['qty'],
                        "rate" => $detail['rate'],
                        "amount" => $detail['amount'],
                        "subcategory_id" => $detail['subcategory_id'],
                        "isRefund" => $detail['isRefund']
                    ];
                }

                $orderArr[] = array(
                    "iOrderId" => $order['iOrderId'],
                    "iCustomerId" => $order['iCustomerId'],
                    "iAmount" => $order['iAmount'],
                    "iDiscount" => $order['iDiscount'],
                    "iNetAmount" => $order['iNetAmount'],
                    "isPayment" => $order['isPayment'],
                    "isDispatched" => $order['isDispatched'],
                    "isDispatchedBy" => $order['isDispatchedBy'],
                    "payment_mode" => $order['payment_mode'],
                    "Customer_name" => $order['Customer_name'],
                    "order_status" => $order['order_status'],
                    "Customer_phone" => $order['Customer_phone'],
                    "Pincode" => $order['Pincode'],
                    "Customer_Address" => $order['Customer_Address'],
                    "order_date" => $order['order_date'],
                    "slot_id" => $order['slot_id'],
                    "strtime" => $order['slot']['strtime'] ?? null,
                    "start_otp" => $order['start_otp'],
                    "end_otp" => $order['end_otp'],
                    "list" => $list
                );
            }
            //dd($ongoingorder);

            // Check if there are no orders
            if (empty($orderArr)) {
                return response()->json([
                    'message' => 'Order not found.',
                    'success' => false,
                ], 404);
            }
            return response()->json([
                'message' => 'Ongoing or Available Order Fetch Sucessfully',
                'success' => true,
                'data'    => $orderArr,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function completeorder(Request $request)
    {
        $request->validate([
            'Customer_id' => 'required'
        ]);

        try {
            $completeorders = Order::with('slot', 'orderdetail.subcategory.category')
                ->where('iCustomerId', $request->Customer_id)
                ->whereIn('order_status', [2])
                ->where(function ($query) {
                    $query->where('payment_mode', 2) // Include all cash payments
                        ->orWhere(function ($q) {
                            $q->where('payment_mode', 1) // Only for online payments
                                ->whereIn('isPayment', [0, 1]); // Exclude failed (2) payments
                        });
                })
                ->get()
                ->toArray();
            $orderArr = [];
            foreach ($completeorders as $order) {

                $list = [];

                foreach ($order['orderdetail'] as $detail) {
                    $subcategory = $detail['subcategory'];
                    $category = $subcategory['category'];

                    $list[] = [
                        "Categories_id" => $category['Categories_id'],
                        "Category_name" => $category['Category_name'],
                        "Categories_slug" => $category['Categories_slug'],
                        "Categories_img" => 'http://127.0.0.1:8000/upload/category-images/' . $category['Categories_img'],
                        "iSubCategoryId" => $subcategory['iSubCategoryId'],
                        "iSequence" => $subcategory['iSequence'],
                        "iCategoryId" => $subcategory['iCategoryId'],
                        "strCategoryName" => $subcategory['strCategoryName'],
                        "strSubCategoryName" => $subcategory['strSubCategoryName'],
                        "strSlugName" => $subcategory['strSlugName'],
                        "SubCategories_img" => 'http://127.0.0.1:8000/upload/subcategory-images/' . $subcategory['SubCategories_img'],
                        "iOrderDetailId" => $detail['iOrderDetailId'],
                        "iOrderId" => $detail['iOrderId'],
                        "iCustomerId" => $detail['iCustomerId'],
                        "category_id" => $detail['category_id'],
                        "Ratecard_id" => $detail['Ratecard_id'],
                        "qty" => $detail['qty'],
                        "rate" => $detail['rate'],
                        "amount" => $detail['amount'],
                        "subcategory_id" => $detail['subcategory_id'],
                        "isRefund" => $detail['isRefund']
                    ];
                }

                $orderArr[] = array(
                    "iOrderId" => $order['iOrderId'],
                    "iCustomerId" => $order['iCustomerId'],
                    "iAmount" => $order['iAmount'],
                    "iDiscount" => $order['iDiscount'],
                    "iNetAmount" => $order['iNetAmount'],
                    "isPayment" => $order['isPayment'],
                    "isDispatched" => $order['isDispatched'],
                    "isDispatchedBy" => $order['isDispatchedBy'],
                    "payment_mode" => $order['payment_mode'],
                    "Customer_name" => $order['Customer_name'],
                    "order_status" => $order['order_status'],
                    "Customer_phone" => $order['Customer_phone'],
                    "Pincode" => $order['Pincode'],
                    "Customer_Address" => $order['Customer_Address'],
                    "order_date" => $order['order_date'],
                    "slot_id" => $order['slot_id'],
                    "strtime" => $order['slot']['strtime'] ?? null,
                    "start_otp" => $order['start_otp'],
                    "end_otp" => $order['end_otp'],
                    "list" => $list
                );
            }
            //dd($ongoingorder);

            // Check if there are no orders
            if (empty($orderArr)) {
                return response()->json([
                    'message' => 'Order not found.',
                    'success' => false,
                ], 404);
            }
            return response()->json([
                'message' => 'Completed Order Fetch Sucessfully',
                'success' => true,
                'data'    => $orderArr,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function AddCart(Request $request)
    {

        try {
            $request->validate([
                "Customer_id" => 'required',
                "Qty" => 'required',
                "rate_id" => 'required',
                "Categories_id" => 'required',
                "SubCategories_id" => 'required',

            ]);
            $ratedata = Managerate::where('rate_id', $request->rate_id)->first();
            $rate = $ratedata->amount;
            $Qty = $request->Qty;
            $amount = $rate * $Qty;

            $Cartdata = array(

                "Customer_id" => $request->Customer_id,
                "Categories_id" => $request->Categories_id,
                "subcate_id" => $request->SubCategories_id,
                "Qty" => $Qty,
                "rate" => $rate,
                "rate_id" => $request->rate_id,
                "amount" => $amount,
                "strIP" => $request->ip(),
                "created_at" => now(),
            );

            $Cart = Cart::create($Cartdata);
            $totalamount = Cart::where([
                ['rate_id', '=', $request->rate_id],
                ['Customer_id', '=', $request->Customer_id]
            ])->sum('amount');

            DB::commit();
            return response()->json([
                'success' => true,
                'total_amount' => $totalamount,
                'message' => 'Add to Cart Successfully.',
            ], 200);
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

    public function ViewCart(Request $request)
    {
        try {
            $request->validate([
                "Customer_id" => 'required',
            ]);

            $cartdata = Cart::with('category.subcategories', 'customer')->where('Customer_id', $request->Customer_id)->get();
            $cartarr = [];
            $totalAmount = 0;

            foreach ($cartdata as $cart) {
                $subcategories = $cart->category->subcategories->first();

                $cartarr[] = [
                    "Cart_id" => $cart->Cart_id,
                    "Customer_id" => $cart->Customer_id,
                    "Customer_name" => optional($cart->customer)->Customer_name,
                    "Customer_Address" => optional($cart->customer)->Customer_Address,
                    "Pincode" => optional($cart->customer)->Pincode,
                    "Customer_phone" => optional($cart->customer)->Customer_phone,

                    "Categories_id" => $cart->Categories_id,
                    "rate" => $cart->rate,
                    "amount" => $cart->amount,
                    "Qty" => $cart->Qty,
                    "created_at" => $cart->created_at,

                    "subcategories" => $subcategories ? [
                        "iSubCategoryId" => $subcategories->iSubCategoryId,
                        "strCategoryName" => $subcategories->strCategoryName,
                        "strSubCategoryName" => $subcategories->strSubCategoryName,
                        "SubCategories_img" => "https://getdemo.in/Mkservice/upload/subcategory-images/{$subcategories->SubCategories_img}",
                    ] : null,
                ];

                $totalAmount += $cart->amount;
            }

            return response()->json([
                'success' => true,
                'data' => $cartarr,
                'total_amount' => $totalAmount,
                'message' => 'Cart fetched successfully.',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => implode(', ', Arr::flatten($e->errors())),
            ], 422);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    public function qtyupdate(Request $request)
    {
        $request->validate([
            "Cart_id" => 'required',
            "Qty" => 'required|numeric|min:1', // Ensure quantity is a valid number
        ]);

        try {
            // Find the cart item
            $cart = Cart::where('Cart_id', $request->Cart_id)->first();

            if (!$cart) {
                return response()->json([
                    'message' => 'Cart item not found.',
                    'success' => false,
                ], 404);
            }

            // Calculate new amount
            $amount = $cart->rate * $request->Qty;

            // Update the cart
            $cart->update([
                'Qty' => $request->Qty,
                'amount' => $amount,
            ]);

            // Fetch the updated cart item
            $updatedCart = Cart::where('Cart_id', $request->Cart_id)->first();

            return response()->json([
                'message' => 'Quantity updated successfully',
                'success' => true,
                'data' => $updatedCart, // Return updated cart details
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function Removeqty_fromcart(Request $request)
    {
        $request->validate(
            [
                "Cart_id" => 'required'
            ]
        );

        try {

            $data = Cart::where('Cart_id', $request->Cart_id)->delete();
            return response()->json([
                'message' => 'Qty delete successfully',
                'success' => true,

            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function offerlist(Request $request)
    {
        try {
            if (Auth::guard('customerapi')->check()) {

                $Today = now()->toDateString();

                $list = Offer::select(
                    "id",
                    "text",
                    "value",
                    "startdate",
                    "enddate"
                )
                    ->where('iStatus', 1)
                    ->where('isDelete', 0)
                    ->whereDate('startdate', '<=', $Today)
                    ->whereDate('enddate', '>=', $Today)
                    ->orderBy('id', 'desc')
                    ->get();

                return response()->json([
                    'success' => true,
                    'message' => "Successfully fetched active Offer List...",
                    'data' => $list,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer is not authorized.',
                ], 401);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function order(Request $request)
    {

        try {
            if (Auth::guard('customerapi')->check()) {

                $request->validate([
                    "Customer_id" => 'required',
                    "order_date" => 'required|date',
                    "slot_id" => 'required',
                    "Amount" => 'required',
                    "discount" => 'nullable|digits',
                    "payment_mode" => 'required',
                    "Customer_name" => 'nullable',
                    "Customer_Address" => 'nullable',
                    "Pincode" => 'required',
                ]);
                $Pincode = Pincode::where('pincode', $request->Pincode)->first();
                if (!$Pincode) {
                    return response()->json([
                        'message' => 'Sorry, Orders are not available in this area',
                        'success' => false,
                    ], 404);
                }
                $Customer = Cart::where('Customer_id', $request->Customer_id)->first();
                if (!$Customer) {
                    return response()->json([
                        'message' => 'Items are not available in Cart',
                        'success' => false,
                    ], 404);
                }
                $orderdata = array(

                    "iCustomerId" => $request->Customer_id,
                    "iAmount" => $request->Amount,
                    "iNetAmount" => $request->Amount,
                    "order_date" => $request->order_date,
                    "slot_id" => $request->slot_id,
                    "payment_mode" => $request->payment_mode,
                    "Customer_name" => $request->Customer_name,
                    "Customer_Address" => $request->Customer_Address,
                    "Pincode" => $request->Pincode,
                    "strIP" => $request->ip(),
                    "created_at" => now(),
                );
                $Order = Order::create($orderdata);
                $Cartdata = Cart::where('Customer_id', $request->Customer_id)->get();
                foreach ($Cartdata as $cart) {

                    $orderdetaildata = array(

                        "iOrderId" => $Order->iOrderId,
                        "Ratecard_id" => $cart->rate_id,
                        "iCustomerId" => $cart->Customer_id,
                        "category_id" => $cart->Categories_id,
                        "subcategory_id" => $cart->subcate_id,
                        "amount" => $cart->amount,
                        "rate" => $cart->rate,
                        "qty" => $cart->Qty,
                        "strIP" => $request->ip(),
                        "created_at" => now(),
                    );
                    OrderDetail::create($orderdetaildata);
                }
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $OrderAmount = $Order->iNetAmount * 100;
                $orderData = [
                    'receipt'         => $Order->iOrderId . '-' . date('dmYHis'),
                    'amount'          => $Order->iNetAmount * 100,
                    'currency'        => 'INR',
                ];
                $razorpayOrder = $api->order->create($orderData);
                $orderId = $razorpayOrder['id'];
                $razorpayResponse = array(
                    'order_id' => $orderId,
                    'oid' => $Order->iOrderId,
                    'amount' => $Order->iNetAmount,
                    'currency' => 'INR',
                    'receipt' => $razorpayOrder['receipt'],
                );
                Cart::where('Customer_id', $request->Customer_id)->delete();
                DB::commit();
                return [
                    'success' => true,
                    "message" => "order created successfully !",
                    "data" => $orderdetaildata,
                    "razorpayResponse" => $razorpayResponse
                ];
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer is not authorized.',
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


        if ($request->status == "Success") {

            $data = array(
                'order_id' => $request->razorpay_payment_id,
                'oid' => $request->order_id,
                'Customer_id' => $request->Customer_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature,
                'receipt' => $request->order_id . '-' . date('dmYHis'),
                'amount' => $request->amount,
                'currency' => $request->currency,
                'status' => $request->status,
                'json' => $request->json,
                'iPaymentType' => 1,
                "Remarks" => "Online Payment"
            );
            DB::table('card_payment')->insert($data);
            $updateProfileData = array(
                'isPayment' => 1
            );
            Order::where("iOrderId", $request->order_id)->update($updateProfileData);
        } elseif ($request->status == "Fail") {

            $data = array(
                'order_id' => $request->razorpay_payment_id,
                'oid' => $request->order_id,
                'Customer_id' => $request->Customer_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_signature' => $request->razorpay_signature,
                'receipt' => $request->order_id . '-' . date('dmYHis'),
                'amount' => $request->amount,
                'currency' => $request->currency,
                'status' => $request->status,
                'json' => $request->json,
                'iPaymentType' => 1,
                "Remarks" => "Online Payment"
            );
            DB::table('card_payment')->insert($data);

            $updateProfileData = array(
                'isPayment' => 2
            );
            Order::where("iOrderId", $request->order_id)->update($updateProfileData);
        }
        return [
            'success' => true,
            'message' => "payment status updated successfully."
        ];
        // } catch (ValidationException $e) {
        //     return response()->json(['errors' => $e->errors()], 422);
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return response()->json(['error' => $th->getMessage()], 500);
        // }
    }

    public function remove_category_form_cart(Request $request)
    {
        try {
            $request->validate([
                "rate_id" => 'required',
                "Customer_id" => 'required'
            ]);

            $delcart = Cart::where([
                ['rate_id', '=', $request->rate_id],
                ['Customer_id', '=', $request->Customer_id]
            ]);

            if (!$delcart->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item not found',
                ], 404);
            }
            $delcart->delete();

            $totalamount = Cart::where('Customer_id', $request->Customer_id)->sum('amount');
            return response()->json([
                'success' => true,
                'total_amount' => $totalamount,
                'message' => 'Item Deleted Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function offer_apply(Request $request)
    {
        try {

            if (Auth::guard('customerapi')->check()) {

                $request->validate([
                    'coupon' => 'required',
                    'totalAmount' => 'required',
                    'Customer_id' => 'required',
                ]);

                $Offer = Offer::where(['iStatus' => 1, 'isDelete' => 0, 'text' => $request->coupon])->first();

                $CouponApply = CustomerCouponApplyed::where(['customerId' => $request->Customer_id, 'offerId' => $Offer->id])->count();
                if (!$Offer) {
                    return response()->json([
                        'success' => false,
                        'message' => "Offer not found."
                    ]);
                }

                if ($CouponApply) {
                    return response()->json([
                        'success' => false,
                        'message' => "Coupon already used!"
                    ]);
                }

                $Today = date('Y-m-d');
                $Coupon = $request->coupon ?? "";
                $OfferCode = $Offer->text ?? "";
                $Total = $request->totalAmount ?? 0;
                $Percentage = $Offer->value ?? null;
                $discountAmount = round(($Total * $Percentage) / 100);

                // 2023-10-05 >= 2023-10-02 && 2023-10-05  <= 2023-10-07
                if ($Coupon == $OfferCode) {
                    if (($Today >= $Offer->startdate) && ($Today <= $Offer->enddate)) {

                        $data = array(
                            'offerId' => $Offer->id,
                            'customerId' => $request->Customer_id ?? 0,
                            'result' => $discountAmount,
                            'created_at' => date('Y-m-d H:i:s'),
                            "strIP" => $request->ip()
                        );
                        $Coupon = CustomerCouponApplyed::create($data);
                        return response()->json([
                            'success' => true,
                            'message' => "Coupon Code Apply Successfully!",
                            'data' => $data
                        ], 200);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => "Coupon is expired!"
                        ], 200);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => "Coupon Code Not Match!"
                    ], 200);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer is not authorized.',
                ], 401);
            }
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function Timeslot(Request $request)
    {

        try {
            $timeslot = Timeslot::select(
                "Time_slot_id",
                "strtime",
                "fromtime",
                "totime"
            )->get();
            return response()->json([
                'message' => 'successfully Timeslot fetched...',
                'success' => true,
                'data' => $timeslot,
            ], 200);
        } catch (\Throwable $th) {
            // If there's an error, rollback any database transactions and return an error response.
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function Recruitment(Request $request)
    {
        try {
            $Recruitment = Recruitment::all();
            $data = [];

            foreach ($Recruitment as $recru) {
                $jobType = '';
                switch ($recru->job_type) {
                    case 1:
                        $jobType = 'Full Time';
                        break;
                    case 2:
                        $jobType = 'Part Time';
                        break;
                    case 3:
                        $jobType = 'Contract';
                        break;
                    default:
                        $jobType = 'Unknown';
                }
                $data[] = [
                    'Recruitment_id' => $recru->Recruitment_id,
                    'job_title' => $recru->job_title,
                    'job_type' => $jobType,
                    'experience' => $recru->experience,
                    'qualification' => $recru->qualification,
                    'location' => $recru->location,
                    'timing' => $recru->timing,
                    'number_of_opening' => $recru->number_of_opening,
                    'salary' => $recru->salary



                ];
            }

            if ($Recruitment->isEmpty()) {
                return response()->json([
                    'message' => 'No recruitment data found',
                    'success' => false,
                ], 200);
            }

            return response()->json([
                'message' => 'Successfully fetched recruitment data',
                'success' => true,
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
