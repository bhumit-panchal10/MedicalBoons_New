<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\MemberApiController;
use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\FrontCustomerApiController;
use App\Http\Controllers\Api\OpenAIImageController;
use App\Http\Controllers\Api\FrontApiController;
use Illuminate\Support\Facades\Artisan;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return 'Cache is cleared';
});

Route::post('/login', [MemberApiController::class, 'login']);
Route::post('/profiledetails', [MemberApiController::class, 'profiledetails'])->name('profiledetails');
Route::post('/InactiveMember', [MemberApiController::class, 'InactiveMember'])->name('InactiveMember');
Route::post('/ActiveMember', [MemberApiController::class, 'ActiveMember'])->name('ActiveMember');
Route::post('/Member/change/password', [MemberApiController::class, 'change_password'])->name('change_password');
Route::post('/Member/forgot/password', [MemberApiController::class, 'forgot_password'])->name('forgot_password');
Route::post('/Member/forgot/password/verifyOTP', [MemberApiController::class, 'forgot_password_verifyOTP']);
Route::post('/Member/Reset/password', [MemberApiController::class, 'Reset_password']);

Route::get('/service', [FrontApiController::class, 'servicelist'])->name('servicelist');
Route::get('/LabTestCategory', [FrontApiController::class, 'LabTestCategory'])->name('LabTestCategory');
Route::post('/AssociatedMember', [FrontApiController::class, 'AssociatedMember'])->name('AssociatedMember');
Route::get('/Bannerlist', [FrontApiController::class, 'Bannerlist'])->name('Bannerlist');
Route::get('/Packagelist', [FrontApiController::class, 'Packagelist'])->name('Packagelist');

Route::post('/servicewise-subservice-doctor', [FrontApiController::class, 'Servicewsie_SubService_Doctor']);
Route::post('/doctor-clinic-list', [FrontApiController::class, 'DoctorClinicList']);

//Route::get('/LabTestMaster', [FrontApiController::class, 'LabTestMaster'])->name('LabTestMaster');
Route::post('/searchLabTests', [FrontApiController::class, 'searchLabTests'])->name('searchLabTests');
Route::post('/AddfamilyMember', [FrontApiController::class, 'AddfamilyMember'])->name('AddfamilyMember');
Route::post('/AddDoctorConsultAppointment', [FrontApiController::class, 'AddDoctorConsultAppointment'])->name('AddDoctorConsultAppointment');
Route::post('/AddPackageSubmit', [FrontApiController::class, 'AddPackageSubmit'])->name('AddPackageSubmit');

Route::post('/deletefamilyMember', [FrontApiController::class, 'deletefamilyMember'])->name('deletefamilyMember');
Route::post('/familyMemberlist', [FrontApiController::class, 'familyMemberlist'])->name('familyMemberlist');
Route::post('/SubService', [FrontApiController::class, 'SubService'])->name('SubService');
Route::get('/Lablist', [FrontApiController::class, 'Lablist'])->name('Lablist');
Route::post('/AddLabTest', [FrontApiController::class, 'AddLabTest'])->name('AddLabTest');
Route::post('/LabTestList', [FrontApiController::class, 'LabTestList'])->name('LabTestList');
Route::post('/LabTestDelete', [FrontApiController::class, 'LabTestDelete'])->name('LabTestDelete');

Route::post('/CompareLabList', [FrontApiController::class, 'CompareLabList'])->name('CompareLabList');
Route::post('/Labwise_disornetamount', [FrontApiController::class, 'Labwise_disornetamount'])->name('Labwise_disornetamount');
Route::post('/Customer_discountApply', [FrontApiController::class, 'Customer_discountApply'])->name('Customer_discountApply');
Route::post('/LabTestSubmit', [FrontApiController::class, 'LabTestSubmit'])->name('LabTestSubmit');

Route::post('/BookingTreatmentSubmit', [FrontApiController::class, 'BookingTreatmentSubmit'])->name('BookingTreatmentSubmit');
Route::post('/AppointmentDisplay', [FrontApiController::class, 'AppointmentDisplay_DocorLabwise'])->name('AppointmentDisplay');

Route::post('/Planoverview', [FrontApiController::class, 'Planoverview'])->name('Planoverview');
Route::post('/Plandashboard', [FrontApiController::class, 'Plandashboard'])->name('Plandashboard');
Route::post('/Planlist', [FrontApiController::class, 'Planlist'])->name('Planlist');
Route::post('/ExtraMember', [FrontApiController::class, 'ExtraMemberamountcalculate'])->name('ExtraMemberamountcalculate');
Route::post('/RenewPlan', [FrontApiController::class, 'RenewPlan'])->name('RenewPlan');
Route::post('/paymentstatus', [FrontApiController::class, 'paymentstatus'])->name('paymentstatus');

Route::post('/Time/slot', [FrontApiController::class, 'getTimeSlots'])->name('getTimeSlots');

Route::get('/testroute', function () {
    $name = "Funny Coder";

    // The email sending is done using the to method on the Mail facade
    Mail::to('dev2.apolloinfotech@gmail.com')->send(new MyTestEmail($name));
});


Route::get('/run-scheduled-notifications', function () {
    Artisan::call('send:scheduled-notifications');
    return 'Scheduled ride notifications command has been executed.';
});
