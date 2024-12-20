<?php

use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\API\MessageControler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\otherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('info', InfoController::class)->only('index');
Route::get('pincodeDetails', [otherController::class, 'pincodeDetails'])->name('pincodeDetails');
Route::get('readBy', [MessageControler::class, 'readBy'])->name('readBy');
Route::get('redDot', [MessageControler::class, 'redDot'])->name('redDot');
Route::post('userToken', [otherController::class, 'userToken'])->name('userToken');
Route::post('driverToken', [otherController::class, 'driverToken'])->name('driverToken');
Route::get('automaticBookingCancel', [otherController::class, 'automaticBookingCancel'])->name('automaticBookingCancel');
Route::get('automaticBookingComplete', [otherController::class, 'automaticBookingComplete'])->name('automaticBookingComplete');
Route::get('maintainance', [otherController::class, 'maintainance'])->name('maintainance');
Route::get('coupons', [otherController::class, 'coupons'])->name('coupons');
Route::get('couponList', [otherController::class, 'couponList'])->name('couponList');
Route::get('appVerision', [otherController::class, 'appVerision'])->name('appVerision');
Route::post('reportDriver', [otherController::class, 'reportDriver'])->name('reportDriver');
Route::get('paymentStatus', [otherController::class, 'paymentStatus'])->name('paymentStatus');
Route::get('bookingStatus', [otherController::class, 'bookingStatus'])->name('bookingStatus');
Route::get('driverDocument', [otherController::class, 'driverDocument'])->name('driverDocument');
Route::post('activeRadius', [otherController::class, 'activeRadius'])->name('activeRadius');
Route::get('checkIsRadius', [otherController::class, 'checkIsRadius'])->name('checkIsRadius');
Route::post('getBookingViaLocation', [otherController::class, 'getBookingViaLocation'])->name('getBookingViaLocation');
Route::post('googleSignIn', [otherController::class, 'googleSignIn'])->name('googleSignIn');
Route::post('googleSignUp', [otherController::class, 'googleSignUp'])->name('googleSignUp');
Route::post('drivercurrentlocation', [otherController::class, 'drivercurrentlocation'])->name('drivercurrentlocation');
Route::post("payment_status", [otherController::class, 'payment_status'])->name('payment_status');
Route::post('driverStatus', [otherController::class, 'driverStatus'])->name('driverStatus');
Route::get('currentStatus', [otherController::class, 'currentStatus'])->name('currentStatus');
Route::get('availablePincode', [otherController::class, 'availablePincode'])->name('availablePincode');
Route::delete('deleteAddress/{id}', [otherController::class, 'deleteAddress'])->name('deleteAddress');
Route::get('favouriteAddressList', [otherController::class, 'favouriteAddressList'])->name('favouriteAddressList');
Route::post('addAddress', [otherController::class, 'addAddress'])->name('addAddress');
Route::get('userProfile', [otherController::class, 'userProfile'])->name('userProfile');
Route::put('updateProfile/{id}', [otherController::class, 'updateProfile'])->name('updateProfile');
Route::put('updateMobileNumber/{id}', [otherController::class, 'updateMobileNumber'])->name('updateMobileNumber');
Route::post('forgotPassword', [otherController::class, 'forgot'])->name('forgotPassword');
Route::post('/register', [App\Http\Controllers\API\RegisterController::class, 'register'])->name('register');
Route::post('/login', [App\Http\Controllers\API\RegisterController::class, 'login'])->name('login');
Route::post('sendMessage', [MessageControler::class, 'createMessage'])->name('sendMessage');
Route::get('reciveMessage', [MessageControler::class, 'reciveMessage'])->name('reciveMessage');
//Route::middleware('auth:sanctum')->group( function () {
Route::get('/profiles', [App\Http\Controllers\API\RegisterController::class, 'profileUser'])->name('profileUser');
Route::post('/profile/verify', [App\Http\Controllers\API\RegisterController::class, 'userVerify'])->name('userVerify');
Route::post('/booking/{action}', [App\Http\Controllers\API\Booking::class, 'index'])->name('index');
Route::post('/profile/update', [App\Http\Controllers\API\RegisterController::class, 'profileUpdate'])->name('profileUpdate');
Route::post('/user/filter/{action}', [App\Http\Controllers\API\RegisterController::class, 'userFilter'])->name('userFilter');
Route::get('/category/list', [App\Http\Controllers\API\Category::class, 'categoryList'])->name('categoryList');
// Route::get('/logout', [App\Http\Controllers\API\RegisterController::class, 'logout'])->name('logout');
//});
Route::post('/driverlogin', [App\Http\Controllers\API\RegisterController::class, 'driverlogin'])->name('driverlogin');
Route::post('/driverlogincheck', [App\Http\Controllers\API\RegisterController::class, 'driverlogincheck'])->name('driverlogincheck');

// Route::post('notificationtodriver', [App\Http\Controllers\API\RegisterController::class, 'notificationtodriver'])->name('notificationtodriver');
// Route::post('pincheck', [App\Http\Controllers\API\RegisterController::class, 'pincheck'])->name('pincheck');
Route::post('pincheck', [App\Http\Controllers\API\otherController::class, 'pincheck'])->name('pincheck');
Route::post('notificationtodriver', [App\Http\Controllers\API\RegisterController::class, 'notificationtodriver'])->name('notificationtodriver');
Route::post('userprofile', [App\Http\Controllers\API\RegisterController::class, 'userprofile'])->name('userprofile');

// Route::post('/driverlogin', [App\Http\Controllers\API\RegisterController::class, 'driverlogin'])->name('driverlogin');
// Route::post('/driverlogincheck', [App\Http\Controllers\API\RegisterController::class, 'driverlogincheck'])->name('driverlogincheck');
// Route::post('pincheck',[App\Http\Controllers\API\RegisterController::class, 'pincheck'])->name('pincheck');

Route::post("driverprofile", [\App\Http\Controllers\API\otherController::class, "driverprofile"])->name("driverprofile");

Route::post("drivercall", [\App\Http\Controllers\API\otherController::class, "drivercall"])->name("drivercall");
Route::post("subscribercall", [\App\Http\Controllers\API\otherController::class, "subscribercall"])->name("subscribercall");
Route::post('notificationtodriverfirebase', [App\Http\Controllers\API\otherController::class, 'notificationtodriverfirebase'])->name('notificationtodriverfirebase');

Route::post("bookingtaxi", [\App\Http\Controllers\API\otherController::class, "bookingtaxi"]);
Route::post("rating", [otherController::class, 'rating'])->name('rating');


Route::post("bookingtaxi1", [\App\Http\Controllers\API\otherController::class, "bookingtaxi1"]);



Route::post('logout', [App\Http\Controllers\API\otherController::class, "logoutapi"]);

Route::post('getbookingdetailsofid', [App\Http\Controllers\API\otherController::class, "getbookingdetailsofid"]);
// Route::post('getbookingdetails', [App\Http\Controllers\API\otherController::class, "getbookingdetails"]);
Route::post('getbookingdetails', [App\Http\Controllers\API\otherController::class, "getbookingdetails"]);
Route::get('getlivelocation', [\App\Http\Controllers\API\otherController::class, "getlivelocation"]);

// Route::post('getbookingdetails1', [App\Http\Controllers\API\otherController::class, "getbookingdetails1"]);

Route::get('banner', [App\Http\Controllers\API\otherController::class, "banner"]);
Route::get('voucher', [App\Http\Controllers\API\otherController::class, "voucher"]);


Route::post("bookingaccept", [App\Http\Controllers\API\otherController::class, "bookingaccept"]);
Route::post("bookingignore", [App\Http\Controllers\API\otherController::class, "bookingignore"]);
Route::post("bookingcancel", [App\Http\Controllers\API\otherController::class, "bookingcancel"]);
Route::post("userbookingcancel", [App\Http\Controllers\API\otherController::class, "userbookingcancel"]);
Route::post("userbookingcancelwithoutreason", [App\Http\Controllers\API\otherController::class, "userbookingcancelwithoutreason"]);

Route::post("livetrackingdriver", [App\Http\Controllers\API\otherController::class, "livetrackingdriver"]);
Route::post("livetrackinguser", [App\Http\Controllers\API\otherController::class, "livetrackinguser"]);

Route::post("bookingdetailsoftheuser", [App\Http\Controllers\API\otherController::class, "bookingdetailsoftheuser"]);

Route::post("driverbookingcomplete", [App\Http\Controllers\API\otherController::class, "driverbookingcomplete"]);

Route::post("locationuser", [App\Http\Controllers\API\otherController::class, "locationuser"]);
Route::post("locationdriver", [App\Http\Controllers\API\otherController::class, "locationdriver"]);


Route::post("checkavailabledriver", [App\Http\Controllers\API\otherController::class, "checkavailabledriver"]);
Route::post("otpverification", [App\Http\Controllers\API\otherController::class, "otpverification"]);
Route::post("otpcompleteverification", [App\Http\Controllers\API\otherController::class, "otpcompleteverification"]);

Route::post("getstatusofbooking", [App\Http\Controllers\API\otherController::class, "getstatusofbooking"]);

Route::post("bookinghistory", [App\Http\Controllers\API\otherController::class, "bookinghistory"]);
Route::post("driverhistory", [App\Http\Controllers\API\otherController::class, "driverhistory"]);
Route::post("userBookingHistory", [App\Http\Controllers\API\otherController::class, "userBookingHistory"])->name('userBookingHistory');

Route::post("sendnotificationtootherdriver", [App\Http\Controllers\API\otherController::class, "sendnotificationtootherdriver"]);


Route::post("drivertocustomercall", [App\Http\Controllers\API\otherController::class, "drivertocustomercall"]);
Route::post("checkNumber", [App\Http\Controllers\API\otherController::class, "checkNumber"])->name("checkNumber");
