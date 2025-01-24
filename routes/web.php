<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\CasetypeController;
use App\Http\Controllers\MatterController;
use App\Http\Controllers\BriefController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\DistrictcourtController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/subscription', [App\Http\Controllers\PaymentController::class, 'index'])->name('subscription');

Route::get('razorpay-payment/{planid}', [App\Http\Controllers\PaymentController::class, 'create'])->name('pay.with.razorpay'); // create payment

Route::post('payment', [App\Http\Controllers\PaymentController::class, 'payment'])->name('payment'); //accept paymetnt

Route::post('updateUserDataAfterPayment', [App\Http\Controllers\PaymentController::class, 'updateUserDataAfterPayment'])->name('updateUserDataAfterPayment'); //accept paymetnt
//for Appellant
Route::post('saveAppellant', [App\Http\Controllers\CaseController::class, 'saveAppellant'])->name('saveAppellant');  
Route::post('editAppellant', [App\Http\Controllers\CaseController::class, 'editAppellant'])->name('editAppellant');  
Route::post('deleteAppellant', [App\Http\Controllers\CaseController::class, 'deleteAppellant'])->name('deleteAppellant');  
Route::post('getAppellant', [App\Http\Controllers\CaseController::class, 'getAppellant'])->name('getAppellant'); //getAppellant 
Route::post('getAppellantToBind', [App\Http\Controllers\CaseController::class, 'getAppellantToBind'])->name('getAppellantToBind');   

//for Respondent
Route::post('getRespondent', [App\Http\Controllers\CaseController::class, 'getRespondent'])->name('getRespondent');   
Route::post('saveRespondent', [App\Http\Controllers\CaseController::class, 'saveRespondent'])->name('saveRespondent'); //saveRespondent 
Route::post('editRespondent', [App\Http\Controllers\CaseController::class, 'editRespondent'])->name('editRespondent');  
Route::post('deleteRespondent', [App\Http\Controllers\CaseController::class, 'deleteRespondent'])->name('deleteRespondent');  
Route::post('getRespondetBind', [App\Http\Controllers\CaseController::class, 'getRespondetBind'])->name('getRespondetBind');  
Route::post('saveNextStageDate', [App\Http\Controllers\CaseController::class, 'saveNextStageDate'])->name('saveNextStageDate'); //saveNextStageDate  
Route::post('viewHistory', [App\Http\Controllers\CaseController::class, 'viewHistory'])->name('viewHistory'); //viewHistory  
Route::get('fileUploads/{caseid}', [App\Http\Controllers\CaseController::class, 'fileUploads'])->name('fileUploads'); 
Route::post('fileStoreUpload/{caseid}', [App\Http\Controllers\CaseController::class, 'fileStoreUpload'])->name('fileStoreUpload');
Route::post('deleteCaseAttachment', [App\Http\Controllers\CaseController::class, 'deleteCaseAttachment'])->name('deleteCaseAttachment');   
Route::post('deleteCase', [App\Http\Controllers\CaseController::class, 'deleteCase'])->name('deleteCase');   


Route::resource('cases', CaseController::class); 

Route::resource('users', UserController::class); 
Route::post('getDistrict', [App\Http\Controllers\UserController::class, 'getDistrict'])->name('getDistrict');  

Route::resource('casetypes', CasetypeController::class); 
Route::resource('matters', MatterController::class); 

Route::resource('briefs', BriefController::class); 

Route::resource('courts', CourtController::class); 
Route::resource('lawyers', LawyerController::class); 
Route::resource('districtcourts', DistrictcourtController::class); 

//Reports
Route::get('districtCourtReport', [App\Http\Controllers\ReportController::class, 'districtCourtReport'])->name('districtCourtReport');  
Route::get('highCourtReport', [App\Http\Controllers\ReportController::class, 'highCourtReport'])->name('highCourtReport');   
Route::get('todayReport', [App\Http\Controllers\ReportController::class, 'todayReport'])->name('todayReport'); 
Route::get('pastReport', [App\Http\Controllers\ReportController::class, 'pastReport'])->name('pastReport'); 
Route::get('futureReport', [App\Http\Controllers\ReportController::class, 'futureReport'])->name('futureReport'); 
Route::get('recordRoomReport', [App\Http\Controllers\ReportController::class, 'recordRoomReport'])->name('recordRoomReport');  
Route::get('calculator', [App\Http\Controllers\CalculatorController::class, 'index'])->name('calculator');  
Route::get('dateWiseCaseReport', [App\Http\Controllers\ReportController::class, 'dateWiseCaseReport'])->name('dateWiseCaseReport');  

Route::post('postDateWiseCaseReport', [App\Http\Controllers\ReportController::class, 'postDateWiseCaseReport'])->name('postDateWiseCaseReport');  

//frontend
Route::get('/termsofuse', [App\Http\Controllers\FrontendController::class, 'index'])->name('termsofuse');
