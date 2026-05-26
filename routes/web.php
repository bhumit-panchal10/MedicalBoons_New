<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CorporateUserHomeController;
use App\Http\Controllers\B2BUserHomeController;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\TechnicialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CorporateUserAuth\CorporateUserLoginController;
use App\Http\Controllers\B2BUserAuth\B2BUserLoginController;

use App\Http\Controllers\CUserController;
use App\Http\Controllers\BUserController;

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubServiceController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\AssociatedMemberController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanDetailController;
use App\Http\Controllers\LabMasterController;
use App\Http\Controllers\LabTestCategoryMasterController;
use App\Http\Controllers\LabTestMasterController;
use App\Http\Controllers\LabTestReportAmountController;
use App\Http\Controllers\CorporateUserController;
use App\Http\Controllers\B2BUserController;
use App\Http\Controllers\CorporateOrderController;
use App\Http\Controllers\OurClientController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FrontviewController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\AppoitmentController;
use App\Http\Controllers\LabTestReportinquiryController;
use App\Http\Controllers\BannerController;

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin.php', function () {
        return view('dashboard.home');
    });
    Route::get('admin.php', function () {
        return view('dashboard.home');
    });
});

Auth::routes();
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return 'Cache is cleared';
});

Route::get('/phpinfo', function () {
    phpinfo();
});
// Front
Route::get('/index', [FrontviewController::class, 'index'])->name('Front.index');
Route::get('/', [FrontviewController::class, 'index'])->name('Front.index');

Route::get('/Plan/{guid?}', [FrontviewController::class, 'Plan'])->name('Front.Plan');
Route::get('/Plan/Detail/{planid?}/{guid?}', [FrontviewController::class, 'PlanDetail'])->name('Front.PlanDetail');

Route::get('/Partner-With-Us', [FrontviewController::class, 'PartnerWithUs'])->name('Front.PartnerWithUs');
Route::post('/Partner_sendmail', [FrontviewController::class, 'Partner_sendmail'])->name('Front.Partner_sendmail');
Route::get('/ThankYou', [FrontviewController::class, 'ThankYou'])->name('Front.ThankYou');


Route::get('/B2BLogin', [FrontviewController::class, 'B2BLogin'])->name('Front.B2BLogin');
//Route::get('/CorporateLogin', [FrontviewController::class, 'CorporateLogin'])->name('Front.CorporateLogin');
Route::get('/AccessibleServices', [FrontviewController::class, 'AccessibleServices'])->name('Front.AccessibleServices');
Route::get('/contact-us', [FrontviewController::class, 'ContactUs'])->name('Front.ContactUs');
Route::get('/Service', [FrontviewController::class, 'Service'])->name('Front.Service');
Route::post('/ContactUs/sendmail', [FrontviewController::class, 'ContactUs_sendmail'])->name('Front.ContactUs_sendmail');
Route::get('/Corporate', [FrontviewController::class, 'Corporate'])->name('Front.Corporate');

Route::get('/Booking/{planid?}', [FrontviewController::class, 'Booking'])->name('Front.Booking');
Route::post('/checkoutstore', [FrontviewController::class, 'checkoutstore'])->name('checkoutstore');
Route::get('card-payment/{id}', [RazorpayController::class, 'index'])->name('razorpay.index')->where(['id' => '[0-9]+']);
Route::post('paysuccess', [RazorpayController::class, 'razorPaySuccess'])->name('razprpay.success');
Route::get('payment/success/{id?}', [RazorpayController::class, 'RazorThankYou'])->name('razorpay.thankyou');
Route::get('payment/fail/{orderid?}', [RazorpayController::class, 'RazorFail'])->name('razorpay.RazorFail');


// Corporate User routes
Route::get('/admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [LoginController::class, 'logoutPage'])->name('logout_page');
Route::any('/log-out', [LoginController::class, 'logout'])->name('logout');

Route::get('/corporate/login', [CorporateUserLoginController::class, 'login'])->name('corporate.login');
Route::post('/loginstore', [CorporateUserLoginController::class, 'loginstore'])->name('loginstore');
Route::get('/CUser-logout', [CorporateUserLoginController::class, 'CUserlogoutpage'])->name('CUserlogoutpage');
Route::any('/CUserlogout', [CorporateUserLoginController::class, 'CUserlogout'])->name('CUserlogout');

Route::get('/CUserHome', [CorporateUserHomeController::class, 'index'])->name('CUserHome');
Route::get('/CUserprofile', [CorporateUserHomeController::class, 'CUsergetProfile'])->name('CUserprofile');
Route::post('/CUserupdateprofile/{id?}', [CorporateUserHomeController::class, 'updateProfile'])->name('CUserupdateprofile');
Route::get('/CUserChangepassword', [CorporateUserHomeController::class, 'changePassword'])->name('CUserChangepassword');
Route::post('/CUserChange_password', [CorporateUserHomeController::class, 'changePassword_update'])->name('CUserChange_password');

Route::get('/COrderlist', [CUserController::class, 'index'])->name('COrderlist');
Route::get('/Memberlist/{orderid?}', [CUserController::class, 'Memberlist'])->name('Memberlist');

//B2B User Routes
Route::get('/Associated/login', [B2BUserLoginController::class, 'B2Blogin'])->name('B2B.login');
Route::post('/B2BUloginstore', [B2BUserLoginController::class, 'B2BUloginstore'])->name('B2BUloginstore');
Route::get('/B2BUser-logout', [B2BUserLoginController::class, 'BUserlogoutpage'])->name('BUserlogoutpage');
Route::any('/B2BUserlogout', [B2BUserLoginController::class, 'BUserlogout'])->name('BUserlogout');

Route::get('/B2BUserHome', [B2BUserHomeController::class, 'index'])->name('B2BUserHome');
Route::get('/B2BUserprofile', [B2BUserHomeController::class, 'B2BUsergetProfile'])->name('B2BUserprofile');
Route::post('/B2BUserupdateprofile/{id?}', [B2BUserHomeController::class, 'updateProfile'])->name('B2BUserupdateprofile');
Route::get('/B2BUserChangepassword', [B2BUserHomeController::class, 'changePassword'])->name('B2BUserChangepassword');
Route::post('/B2BUserChange_password', [B2BUserHomeController::class, 'changePassword_update'])->name('B2BUserChange_password');

Route::get('/BOrderlist', [BUserController::class, 'index'])->name('BOrderlist');
Route::get('/planlist', [BUserController::class, 'planlist'])->name('planlist');
Route::get('/Memberlist/{orderid?}', [BUserController::class, 'Memberlist'])->name('Memberlist');

// Dashboard routes
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/profile', [HomeController::class, 'getProfile'])->middleware('auth')->name('profile');
Route::post('/updateprofile', [HomeController::class, 'updateProfile'])->middleware('auth')->name('updateprofile');
Route::get('/Changepassword', [HomeController::class, 'changePassword'])->middleware('auth')->name('Changepassword');
Route::post('/Change_password', [HomeController::class, 'changePassword_update'])->middleware('auth')->name('Change_password');

Route::prefix('admin')->name('Appoitment.')->middleware('auth')->group(function () {
    Route::get('/Appoitmentlist', [AppoitmentController::class, 'Appoitmentlist'])->name('Appoitmentlist');
    Route::get('/Appoitment/edit/{id?}', [AppoitmentController::class, 'edit'])->name('edit');
    Route::post('/Appoitment/update/{id?}', [AppoitmentController::class, 'update'])->name('update');
    Route::delete('/Appoitment/delete', [AppoitmentController::class, 'delete'])->name('delete');
});

Route::prefix('admin')->name('LabTestinquiryReport.')->middleware('auth')->group(function () {
    Route::get('/LabTestinquiryReport/index', [LabTestReportinquiryController::class, 'index'])->name('index');
    Route::get('/LabTestinquiryReport/add', [LabTestReportinquiryController::class, 'add'])->name('add');
    Route::post('/LabTestinquiryReport/store', [LabTestReportinquiryController::class, 'store'])->name('store');
    Route::get('/LabTestinquiryReport/edit/{id?}', [LabTestReportinquiryController::class, 'edit'])->name('edit');
    Route::post('/LabTestinquiryReport/update/{id?}', [LabTestReportinquiryController::class, 'update'])->name('update');
    Route::delete('/LabTestinquiryReport/delete', [LabTestReportinquiryController::class, 'delete'])->name('delete');
    Route::delete('/LabTestinquiryReport/deleteselected', [LabTestReportinquiryController::class, 'deleteselected'])->name('deleteselected');

    Route::get('/LabTestinquiryReport/detail/{id?}/{memberid?}', [LabTestReportinquiryController::class, 'detail'])->name('detail');
    Route::get('/LabTestinquiryReport/detail/add/{id?}/{memberid?}', [LabTestReportinquiryController::class, 'detail_add'])->name('detail_add');
    Route::post('/LabTestinquiryReport/detail/store', [LabTestReportinquiryController::class, 'detail_store'])->name('detail_store');
    Route::get('/LabTestinquiryReport/detail/edit/{id?}/{detailid?}/{memberid?}', [LabTestReportinquiryController::class, 'detail_edit'])->name('detail_edit');
    Route::post('/LabTestinquiryReport/detail/update/{id?}', [LabTestReportinquiryController::class, 'detail_update'])->name('detail_update');
    Route::delete('/LabTestinquiryReport/detail/delete', [LabTestReportinquiryController::class, 'detail_delete'])->name('detail_delete');
});
Route::get('/admin/LabTestInquiryReport/getDetail/{id}', [LabTestReportinquiryController::class, 'getDetail'])->name('getDetail');

//categories Master
Route::prefix('admin')->name('service.')->middleware('auth')->group(function () {
    Route::any('/service/index', [ServiceController::class, 'index'])->name('index');
    Route::get('/service/add', [ServiceController::class, 'add'])->name('add');
    Route::post('/service/store', [ServiceController::class, 'store'])->name('store');
    Route::get('/service/edit/{id?}', [ServiceController::class, 'edit'])->name('edit');
    Route::post('/service/update/{id?}', [ServiceController::class, 'update'])->name('update');
    Route::delete('/service/delete', [ServiceController::class, 'delete'])->name('delete');
    Route::delete('/service/deleteselected', [ServiceController::class, 'deleteselected'])->name('deleteselected');
    Route::any('/service/updateStatus', [ServiceController::class, 'updateStatus'])->name('updateStatus');
});

Route::prefix('admin')->name('sub_service.')->middleware('auth')->group(function () {
    Route::any('/sub_service/index', [SubServiceController::class, 'index'])->name('index');
    Route::get('/sub_service/add', [SubServiceController::class, 'add'])->name('add');
    Route::post('/sub_service/store', [SubServiceController::class, 'store'])->name('store');
    Route::get('/sub_service/edit/{id?}', [SubServiceController::class, 'edit'])->name('edit');
    Route::post('/sub_service/update/{id?}', [SubServiceController::class, 'update'])->name('update');
    Route::delete('/sub_service/delete', [SubServiceController::class, 'delete'])->name('delete');
    Route::delete('/sub_service/deleteselected', [SubServiceController::class, 'deleteselected'])->name('deleteselected');
    Route::any('/sub_service/updateStatus', [SubServiceController::class, 'updateStatus'])->name('updateStatus');
});

Route::prefix('admin')->name('associated_member.')->middleware('auth')->group(function () {
    Route::any('/associated_member/index', [AssociatedMemberController::class, 'index'])->name('index');
    Route::get('/associated_member/add', [AssociatedMemberController::class, 'add'])->name('add');
    Route::post('/associated_member/store', [AssociatedMemberController::class, 'store'])->name('store');
    Route::get('/associated_member/edit/{id?}', [AssociatedMemberController::class, 'edit'])->name('edit');
    Route::post('/associated_member/update/{id?}', [AssociatedMemberController::class, 'update'])->name('update');
    Route::delete('/associated_member/delete', [AssociatedMemberController::class, 'delete'])->name('delete');
    Route::delete('/associated_member/deleteselected', [AssociatedMemberController::class, 'deleteselected'])->name('deleteselected');
    Route::any('/associated_member/updateStatus', [AssociatedMemberController::class, 'updateStatus'])->name('updateStatus');
    Route::any('/associated_member/service_subservice_mapping', [AssociatedMemberController::class, 'service_subservice_mapping'])->name('service_subservice_mapping');
});

// plan
Route::prefix('admin')->name('plan.')->middleware('auth')->group(function () {
    Route::any('/plan/index', [PlanController::class, 'index'])->name('index');
    Route::get('/plan/add', [PlanController::class, 'add'])->name('add');
    Route::post('/plan/store', [PlanController::class, 'store'])->name('store');
    Route::get('/plan/edit/{id?}', [PlanController::class, 'edit'])->name('edit');
    Route::post('/plan/update/{id?}', [PlanController::class, 'update'])->name('update');
    Route::delete('/plan/delete', [PlanController::class, 'delete'])->name('delete');
    Route::delete('/plan/deleteselected', [PlanController::class, 'deleteselected'])->name('deleteselected');
    Route::any('/plan/updateStatus', [PlanController::class, 'updateStatus'])->name('updateStatus');
});

// plan Detail
Route::prefix('admin')->name('plan_detail.')->middleware('auth')->group(function () {
    Route::any('/plan_detail/index/{planid?}', [PlanDetailController::class, 'index'])->name('index');
    Route::get('/plan_detail/add/{planid?}', [PlanDetailController::class, 'add'])->name('add');
    Route::post('/plan_detail/store', [PlanDetailController::class, 'store'])->name('store');
    Route::get('/plan_detail/edit/{id?}', [PlanDetailController::class, 'edit'])->name('edit');
    Route::post('/plan_detail/update', [PlanDetailController::class, 'update'])->name('update');
    Route::delete('/plan_detail/delete', [PlanDetailController::class, 'delete'])->name('delete');
    Route::delete('/plan_detail/deleteselected', [PlanDetailController::class, 'deleteselected'])->name('deleteselected');
    Route::any('/plan_detail/updateStatus', [PlanDetailController::class, 'updateStatus'])->name('updateStatus');
});

// plan Detail
Route::prefix('admin')->name('Banner.')->middleware('auth')->group(function () {
    Route::any('/Banner/index', [BannerController::class, 'index'])->name('index');
    Route::get('/Banner/add', [BannerController::class, 'add'])->name('add');
    Route::post('/Banner/store', [BannerController::class, 'store'])->name('store');
    Route::get('/Banner/edit/{id?}', [BannerController::class, 'edit'])->name('edit');
    Route::post('/Banner/update', [BannerController::class, 'update'])->name('update');
    Route::delete('/Banner/delete', [BannerController::class, 'delete'])->name('delete');
    Route::delete('/Banner/deleteselected', [BannerController::class, 'deleteselected'])->name('deleteselected');
});

//Faq Master
Route::prefix('admin')->name('faq.')->middleware('auth')->group(function () {
    Route::get('/faq/index', [FaqController::class, 'index'])->name('index');
    Route::get('/faq/add', [FaqController::class, 'add'])->name('add');
    Route::post('/faq/store', [FaqController::class, 'store'])->name('store');
    Route::get('/faq/edit/{id?}', [FaqController::class, 'edit'])->name('edit');
    Route::get('/faq/view/{id?}', [FaqController::class, 'view'])->name('view');
    Route::post('/faq/update/{id?}', [FaqController::class, 'update'])->name('update');
    Route::delete('/faq/delete', [FaqController::class, 'delete'])->name('delete');
    Route::delete('/faq/deleteselected', [FaqController::class, 'deleteselected'])->name('deleteselected');
    Route::any('/faq/updateStatus', [FaqController::class, 'updateStatus'])->name('updateStatus');
});

//CMS
Route::prefix('admin')->name('cms.')->middleware('auth')->group(function () {
    Route::get('/cms/index', [CMSController::class, 'index'])->name('index');
    Route::get('/cms/edit/{id?}', [CMSController::class, 'edit'])->name('edit');
    Route::post('/cms/update/{id?}', [CMSController::class, 'update'])->name('update');
});

// lab Master
Route::prefix('admin')->name('lab_master.')->middleware('auth')->group(function () {
    Route::any('/lab_master/index', [LabMasterController::class, 'index'])->name('index');
    Route::get('/lab_master/add', [LabMasterController::class, 'add'])->name('add');
    Route::post('/lab_master/store', [LabMasterController::class, 'store'])->name('store');
    Route::get('/lab_master/edit/{id?}', [LabMasterController::class, 'edit'])->name('edit');
    Route::post('/lab_master/update', [LabMasterController::class, 'update'])->name('update');
    Route::delete('/lab_master/delete', [LabMasterController::class, 'delete'])->name('delete');
    Route::delete('/lab_master/deleteselected', [LabMasterController::class, 'deleteselected'])->name('deleteselected');
    Route::any('/lab_master/updateStatus', [LabMasterController::class, 'updateStatus'])->name('updateStatus');
});

Route::prefix('admin')->name('lab_test_cate.')->middleware('auth')->group(function () {
    Route::any('/lab_test_cate/index', [LabTestCategoryMasterController::class, 'index'])->name('index');
    Route::get('/lab_test_cate/add', [LabTestCategoryMasterController::class, 'add'])->name('add');
    Route::post('/lab_test_cate/store', [LabTestCategoryMasterController::class, 'store'])->name('store');
    Route::get('/lab_test_cate/edit/{id?}', [LabTestCategoryMasterController::class, 'edit'])->name('edit');
    Route::post('/lab_test_cate/update', [LabTestCategoryMasterController::class, 'update'])->name('update');
    Route::delete('/lab_test_cate/delete', [LabTestCategoryMasterController::class, 'delete'])->name('delete');
    Route::delete('/lab_test_cate/deleteselected', [LabTestCategoryMasterController::class, 'deleteselected'])->name('deleteselected');
    Route::any('/lab_test_cate/updateStatus', [LabTestCategoryMasterController::class, 'updateStatus'])->name('updateStatus');
});

Route::prefix('admin')->name('lab_test_master.')->middleware('auth')->group(function () {
    Route::any('/lab_test_master/index', [LabTestMasterController::class, 'index'])->name('index');
    Route::get('/lab_test_master/add', [LabTestMasterController::class, 'add'])->name('add');
    Route::post('/lab_test_master/store', [LabTestMasterController::class, 'store'])->name('store');
    Route::get('/lab_test_master/edit/{id?}', [LabTestMasterController::class, 'edit'])->name('edit');
    Route::post('/lab_test_master/update', [LabTestMasterController::class, 'update'])->name('update');
    Route::delete('/lab_test_master/delete', [LabTestMasterController::class, 'delete'])->name('delete');
    Route::delete('/lab_test_master/deleteselected', [LabTestMasterController::class, 'deleteselected'])->name('deleteselected');
    Route::any('/lab_test_master/updateStatus', [LabTestMasterController::class, 'updateStatus'])->name('updateStatus');
});

Route::prefix('admin')->name('lab_test_report_amount.')->middleware('auth')->group(function () {
    Route::any('/lab_test_report_amount/index', [LabTestReportAmountController::class, 'index'])->name('index');
    Route::any('/lab_test_report_amount/add', [LabTestReportAmountController::class, 'add'])->name('add');
    Route::post('/lab_test_report_amount/store', [LabTestReportAmountController::class, 'store'])->name('store');
    Route::get('/lab_test_report_amount/edit/{id?}', [LabTestReportAmountController::class, 'edit'])->name('edit');
    Route::post('/lab_test_report_amount/update', [LabTestReportAmountController::class, 'update'])->name('update');
    Route::delete('/lab_test_report_amount/delete', [LabTestReportAmountController::class, 'delete'])->name('delete');
    Route::delete('/lab_test_report_amount/deleteselected', [LabTestReportAmountController::class, 'deleteselected'])->name('deleteselected');
    Route::any('/lab_test_report_amount/updateStatus', [LabTestReportAmountController::class, 'updateStatus'])->name('updateStatus');
});

Route::prefix('admin')->name('our_client.')->middleware('auth')->group(function () {
    Route::any('/our_client/index', [OurClientController::class, 'index'])->name('index');
    Route::get('/our_client/add', [OurClientController::class, 'add'])->name('add');
    Route::post('/our_client/store', [OurClientController::class, 'store'])->name('store');
    Route::delete('/our_client/delete', [OurClientController::class, 'delete'])->name('delete');
    Route::delete('/our_client/deleteselected', [OurClientController::class, 'deleteselected'])->name('deleteselected');
});

Route::prefix('admin')->name('Testimonial.')->middleware('auth')->group(function () {
    Route::any('/Testimonial/index', [TestimonialController::class, 'index'])->name('index');
    Route::any('/Testimonial/add', [TestimonialController::class, 'add'])->name('add');
    Route::post('/Testimonial/store', [TestimonialController::class, 'store'])->name('store');
    Route::get('/Testimonial/edit/{id?}', [TestimonialController::class, 'edit'])->name('edit');
    Route::post('/Testimonial/update', [TestimonialController::class, 'update'])->name('update');
    Route::delete('/Testimonial/delete', [TestimonialController::class, 'delete'])->name('delete');
    Route::delete('/Testimonial/deleteselected', [TestimonialController::class, 'deleteselected'])->name('deleteselected');
});

//Blog Master
Route::prefix('admin')->name('blog.')->middleware('auth')->group(function () {
    Route::get('/blog/index', [BlogController::class, 'index'])->name('index');
    Route::get('/blog/create', [BlogController::class, 'createview'])->name('create');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('store');
    Route::get('/blog/edit/{id?}', [BlogController::class, 'editview'])->name('edit');
    Route::post('/blog/update/{id?}', [BlogController::class, 'update'])->name('update');
    Route::delete('/blog/delete', [BlogController::class, 'delete'])->name('delete');
});


Route::prefix('admin')->name('Corporate_User.')->middleware('auth')->group(function () {
    Route::any('/Corporate_User/index', [CorporateUserController::class, 'index'])->name('index');
    Route::any('/Corporate_User/add', [CorporateUserController::class, 'add'])->name('add');
    Route::post('/Corporate_User/store', [CorporateUserController::class, 'store'])->name('store');
    Route::get('/Corporate_User/edit/{id?}', [CorporateUserController::class, 'edit'])->name('edit');
    Route::post('/Corporate_User/update', [CorporateUserController::class, 'update'])->name('update');
    Route::delete('/Corporate_User/delete', [CorporateUserController::class, 'delete'])->name('delete');
    Route::delete('/Corporate_User/deleteselected', [CorporateUserController::class, 'deleteselected'])->name('deleteselected');
    Route::post('/password-update/{Id?}', [CorporateUserController::class, 'passwordupdate'])->name('passwordupdate');
    Route::get('/Resentmail/{Id?}', [CorporateUserController::class, 'Resentmail'])->name('Resentmail');
});

Route::prefix('admin')->name('B2B_User.')->middleware('auth')->group(function () {
    Route::any('/B2B_User/index', [B2BUserController::class, 'index'])->name('index');
    Route::any('/B2B_User/add', [B2BUserController::class, 'add'])->name('add');
    Route::any('/b2b/main_parent_id/parent_id/mapping', [B2BUserController::class, 'parent_id_mapping'])->name('parent_id_mapping');

    Route::post('/B2B_User/store', [B2BUserController::class, 'store'])->name('store');
    Route::get('/B2B_User/edit/{id?}', [B2BUserController::class, 'edit'])->name('edit');
    Route::post('/B2B_User/update', [B2BUserController::class, 'update'])->name('update');
    Route::delete('/B2B_User/delete', [B2BUserController::class, 'delete'])->name('delete');
    Route::delete('/B2B_User/deleteselected', [B2BUserController::class, 'deleteselected'])->name('deleteselected');
    Route::post('/B2B_User/password-update/{Id?}', [B2BUserController::class, 'passwordupdate'])->name('Buserpasswordupdate');
});

Route::prefix('admin')->name('Corporate_Order.')->middleware('auth')->group(function () {
    Route::any('/Corporate_Order/index', [CorporateOrderController::class, 'index'])->name('index');
    Route::any('/Corporate_Order/RetailOrderlist', [CorporateOrderController::class, 'RetailOrderlist'])->name('RetailOrderlist');
    Route::get('/Corporate_Order/RetailRegistration', [CorporateOrderController::class, 'RetailRegistrationForm'])->name('RetailRegistrationForm');
    Route::post('/Corporate_Order/RetailRegistrationStore', [CorporateOrderController::class, 'RetailRegistrationStore'])->name('RetailRegistrationStore');
    Route::any('/Corporate_Order/AssociateOrderlist', [CorporateOrderController::class, 'B2BOrderlist'])->name('B2BOrderlist');

    Route::any('/Corporate_Order/add', [CorporateOrderController::class, 'add'])->name('add');
    Route::any('/corporate/main_parent_id/parent_id/mapping', [CorporateOrderController::class, 'parent_id_mapping'])->name('parentid_mapping');

    Route::post('/Member/store', [CorporateOrderController::class, 'Memberstore'])->name('Memberstore');
    Route::post('/Corporate_Order/store', [CorporateOrderController::class, 'store'])->name('store');
    Route::get('/Corporate_Order/edit/{id?}', [CorporateOrderController::class, 'edit'])->name('edit');
    Route::post('/Corporate_Order/update', [CorporateOrderController::class, 'update'])->name('update');
    Route::post('/CorporateOrderMemberStore/{guid?}', [CorporateOrderController::class, 'Memberstore'])->name('Memberstore');
    Route::post('/invoice_update', [CorporateOrderController::class, 'invoice_update'])->name('invoice_update');

    Route::get('/payment_receipt_pdf/{id?}', [CorporateOrderController::class, 'payment_receipt_pdf'])->name('payment_receipt_pdf');

    Route::delete('/Corporate_Order/delete', [CorporateOrderController::class, 'delete'])->name('delete');
    Route::delete('/Corporate_Order/deleteselected', [CorporateOrderController::class, 'deleteselected'])->name('deleteselected');
    Route::get('/Corporate_Order/appoitment_or_labdisplay', [CorporateOrderController::class, 'appoitment_or_labdisplay'])->name('appoitment_or_labdisplay');
});
Route::get('/CorporateOrderMemberRegistration/{guid?}', [CorporateOrderController::class, 'CorporateOrderMemberRegistration'])->name('CorporateOrderMemberRegistration');


Route::prefix('admin')->name('Member.')->middleware('auth')->group(function () {
    Route::any('/Member/index/{orderid?}', [MemberController::class, 'index'])->name('index');
    Route::any('/Member/add/{orderid?}', [MemberController::class, 'add'])->name('add');

    Route::post('/Member/store', [MemberController::class, 'Memberstore'])->name('store');

    Route::get('/Member/edit/{id?}/{orderid?}', [MemberController::class, 'edit'])->name('edit');
    Route::post('/Member/update', [MemberController::class, 'update'])->name('update');

    Route::delete('/Member/delete', [MemberController::class, 'delete'])->name('delete');
    Route::delete('/Member/deleteselected', [MemberController::class, 'deleteselected'])->name('deleteselected');
});

// Route::get('/{slug}', [\App\Http\Controllers\FrontviewController::class, 'AboutUs'])
//     ->name('Front.AboutUs')
//     ->where('slug', '[A-Za-z0-9-]+');

Route::get('/AboutUs', [\App\Http\Controllers\FrontviewController::class, 'AboutUs'])
    ->name('Front.AboutUs');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
