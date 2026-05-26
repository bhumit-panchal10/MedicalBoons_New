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
use Google\Service\Monitoring\Custom;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\BaseURL;
use Razorpay\Api\Api;




class FrontCustomerApiController extends Controller

{

    public function subcat(Request $request)
    {
        $request->validate([
            'Categories_id' => 'required',
            'city_id' => 'required',
        ]);

        try {
            $subcategorydata = Managerate::with('category', 'subcategory')->where('cate_id', $request->Categories_id)->get();

            if (!$subcategorydata) {
                return response()->json([
                    'message' => 'No category found.',
                    'success' => false,
                ], 404);
            }
            $data = [];
            foreach ($subcategorydata as $subcat) {
                $data[] = [
                    'cate_id'  => $subcat->cate_id,
                    'subcate_id'  => $subcat->subcate_id,
                    'title'  => $subcat->title,
                    'description'  => $subcat->description,
                    'amount'  => $subcat->amount,
                    'strSubCategoryName'  => $subcat->subcategory->strSubCategoryName,
                    'Category_name'  => $subcat->category->Category_name,
                    'SubCategories_img'  => "https://getdemo.in/Mkservice/upload/subcategory-images/{$subcat->subcategory->SubCategories_img}",

                ];
            }

            return response()->json([
                'message' => 'Successfully fetched category with subcategories and rates.',
                'success' => true,
                'data'    => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
