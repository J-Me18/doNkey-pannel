<?php

use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Admin\NotifyController;
use App\Http\Controllers\API\otherController;
use App\Http\Controllers\ExcelPincodeController;
use App\Http\Controllers\bannerController;
use App\Http\Controllers\BookingReportController;
use App\Http\Controllers\CheckingController;
use App\Http\Controllers\ComplaintReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DriverBookingReport;
use App\Http\Controllers\EmployeePerformanceController;
use App\Http\Controllers\EmployeeReportController;
use App\Http\Controllers\EnquiryCommentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubEmployeeController;
use App\Http\Controllers\SubRoleController;
use App\Http\Controllers\SubscriberActionController;
use App\Http\Controllers\SubscriberBookingReportController;
use App\Http\Controllers\SubscriberExpiryController;
use App\Http\Controllers\SubscriberReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\websiteController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PaymentReportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Subscriber\CouponController as SubscriberCouponController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\Admin\PincodebasedcategoryController;
use App\Http\Controllers\Admin\PushnotificationController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\Subscriber\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return to_route('dashboard');
});
Route::get('accountDeletion', function () {
    return view('accountDelation');
});
Route::get('zipcodeE', [SubscriberController::class, 'zipcodeE'])->name('zipcodeE');
Route::get('automaticBookingComplete', [otherController::class, 'automaticBookingComplete'])->name('automaticBookingComplete');

Route::get("tc", [App\Http\Controllers\websiteController::class, 'tc']);
Route::get("returnandrefundpolicy", [App\Http\Controllers\websiteController::class, 'returnandrefundpolicy']);
Route::get("privacypolicyandcookies", [App\Http\Controllers\websiteController::class, 'privacypolicyandcookies']);
Route::get('/clear', function () {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});

Auth::routes();
Route::get('usedPincodes', [HomeController::class, 'usedPincodes'])->name('usedPincodes');
Route::resource('pincodebasedcategory', PincodebasedcategoryController::class);
Route::get('pincodebasedcategorystatus', [PincodebasedcategoryController::class, 'pincodebasedcategorystatus'])->name('pincodebasedcategorystatus');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/createpincode', [App\Http\Controllers\PincodeController::class, 'create'])->name('createpincode');
Route::get('/pincode', [App\Http\Controllers\PincodeController::class, 'index'])->name('pincode');
Route::post('/pincodestore', [App\Http\Controllers\PincodeController::class, 'pincodestore']);
Route::get('/pincode/{id}', [App\Http\Controllers\PincodeController::class, 'edit']);
Route::put('/pincodeupdate/{id}', [App\Http\Controllers\PincodeController::class, 'update']);
Route::get('/pincodedelete/{id}', [App\Http\Controllers\PincodeController::class, 'destroy']);

Route::get('/createSubscriber', [App\Http\Controllers\SubscriberController::class, 'create'])->name('createSubscriber');
Route::get('/subscriberList', [App\Http\Controllers\SubscriberController::class, 'subscriber'])->name('subscriber');
Route::post('/subscriberstore', [App\Http\Controllers\SubscriberController::class, 'subscriberstore']);
Route::get('/subscriber/show/{id}', [App\Http\Controllers\SubscriberController::class, 'show'])->name('show');
Route::get('/subscriber/{id}', [App\Http\Controllers\SubscriberController::class, 'edit']);
Route::put('/subscriberupdate/{id}', [App\Http\Controllers\SubscriberController::class, 'update']);
Route::get('/subscriberdelete/{id}', [App\Http\Controllers\SubscriberController::class, 'destroy']);
Route::get('/changeStatus', [App\Http\Controllers\SubscriberController::class, 'changeStatus']);
Route::get('/expiredsubscriber', [App\Http\Controllers\SubscriberController::class, 'expiry'])->name('expiredsubscriber');
Route::put('/subscriberblock/{id}', [App\Http\Controllers\SubscriberController::class, 'block']);
Route::post('/subscriberunblock', [App\Http\Controllers\SubscriberController::class, 'subscriberunblock']);

Route::get('deletesubscribervideo/{id}', [App\Http\Controllers\SubscriberController::class, 'deletesubscribervideo']);


Route::get('/enduser', [App\Http\Controllers\HomeController::class, 'enduser'])->name('enduser');
Route::put('blockenduser/{id}', [HomeController::class, 'blockEndUser'])->name('blockenduser');
Route::put('unblockenduser/{id}', [HomeController::class, 'unblockEndUser'])->name('unblockenduser');

Route::get('/category', [App\Http\Controllers\HomeController::class, 'category'])->name('category');
Route::get('/categoryStatus', [App\Http\Controllers\HomeController::class, 'categoryStatus']);

//Driver
Route::get('/driver', [App\Http\Controllers\HomeController::class, 'driver'])->name('drivers');
Route::get('/driver/create', [App\Http\Controllers\HomeController::class, 'createdriver'])->name('driver.create');
Route::post('/driverstore', [App\Http\Controllers\HomeController::class, 'driverstore']);
Route::get('/driver/show/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('show');

Route::get('/driverActivate', [App\Http\Controllers\HomeController::class, 'driverActivate']);
Route::get('/driver/{id}', [App\Http\Controllers\HomeController::class, 'driveredit']);
Route::put('/driverupdate/{id}', [App\Http\Controllers\HomeController::class, 'driverupdate']);
Route::get('/driverNotification', [App\Http\Controllers\HomeController::class, 'drivernotify']);
Route::get('/dot-notify', [App\Http\Controllers\HomeController::class, 'dotnotify'])->name('dot-notify');

Route::put('readBy/{readBy}', [HomeController::class, 'readBy'])->name('readBy');
Route::put('/driverblock/{id}', [App\Http\Controllers\SubscriberController::class, 'driverblock']);
Route::post('/driverunblock', [App\Http\Controllers\SubscriberController::class, 'driverunblock']);

Route::get('/subscriberblockList', [App\Http\Controllers\HomeController::class, 'subscriberblockList'])->name('subscriberblockList');
Route::get('/adminBlocked', [App\Http\Controllers\HomeController::class, 'adminBlockeddriver'])->name('adminBlockeddriver');
Route::get('/driverblockList', [App\Http\Controllers\HomeController::class, 'driverblockList'])->name('driverblockList');

Route::get('/subscriberunblockList', [App\Http\Controllers\HomeController::class, 'subscriberunblockList'])->name('subscriberunblockList');
Route::get('/adminUnblocked', [App\Http\Controllers\HomeController::class, 'adminUnblockeddriver'])->name('adminUnblockeddriver');
Route::get('/driverunblockList', [App\Http\Controllers\HomeController::class, 'driverunblockList'])->name('driverunblockList');

Route::get('/coupons', [App\Http\Controllers\HomeController::class, 'coupons'])->name('coupons');
Route::get('/coupons/create', [App\Http\Controllers\HomeController::class, 'createcoupons'])->name('createcoupons');
Route::post('/couponsstore', [App\Http\Controllers\HomeController::class, 'couponsstore']);
Route::get('/coupons/{id}', [App\Http\Controllers\HomeController::class, 'couponsedit']);
Route::put('/couponsupdate/{id}', [App\Http\Controllers\HomeController::class, 'couponsupdate']);
Route::get('/couponsdelete/{id}', [App\Http\Controllers\HomeController::class, 'couponsdestroy']);
Route::get('/couponsActivate', [App\Http\Controllers\HomeController::class, 'couponsActivate']);

//Price Notification
Route::get('/priceNotification', [App\Http\Controllers\HomeController::class, 'subscriberpriceNotify'])->name('priceNotification');
Route::get('subscriberNotification', [HomeController::class, 'subscriberNotification'])->name('subscriberNotification');
Route::get('/markread', [App\Http\Controllers\HomeController::class, 'markread']);

Route::post('/markasread', [App\Http\Controllers\HomeController::class, 'markasread']);


//Enquiry
Route::resource('enquiry', EnquiryController::class);
Route::resource('excelpincode', ExcelPincodeController::class)->parameter('excelpincode', 'excelPincode');
//Complaints
Route::resource('complaints', ComplaintsController::class);
Route::get('complaint/{complaint}', [ComplaintsController::class, 'actionedBy'])->name('complaint');
Route::resource('role', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('profile', ProfileController::class)->parameter('profile', 'admin')->only('edit', 'update');
Route::resource('complaintReport', ComplaintReportController::class)->parameter('complaintReport', 'admin')->only('show');
Route::get('complaintExcel/{admin}', [ComplaintReportController::class, 'downloadExcel'])->name('complaintExcel');
Route::get('complaintPdf/{admin}', [ComplaintReportController::class, 'downloadPdf'])->name('complaintPdf');


Route::get('messageEmployee', [App\Http\Controllers\SubscriberModelController::class, 'messageEmployee'])->name('messageEmployee');
Route::group(['prefix' => 'subscribers'], function () {

    Route::get('/login', [App\Http\Controllers\SubscriberModelController::class, 'index'])->name('subscriberLogin');
    Route::post('/loginaction', [App\Http\Controllers\SubscriberModelController::class, 'subscriberlogin']);
    Route::resource('roles', SubRoleController::class);
    Route::get('subPermission', [SubRoleController::class, 'subPermission']);
    Route::resource('subEmployee', SubEmployeeController::class)->parameter('subEmployee', 'employee');
});
Route::get('subscriberForgotPassword', [PasswordController::class, 'subscriberForgotPassword'])->name('subscriberForgotPassword');
Route::post('subscriberEmailVerification', [PasswordController::class, 'subscriberEmailVerification'])->name('subscriberEmailVerification');
Route::get('subscriberpasswordReset/{id}', [PasswordController::class, 'subscriberPasswordReset'])->name('subscriberpasswordReset');
Route::post('subscriberConfimed_password', [PasswordController::class, 'subscriberNewPassword'])->name('subscriberConfimed_password');

Route::group(['prefix' => 'subscribers', 'middleware' => 'subscribers'], function () {
    Route::get('/logout', [App\Http\Controllers\SubscriberHomeController::class, 'logout'])->name('subscribers.logout');
    Route::get('/dashboard', [App\Http\Controllers\SubscriberHomeController::class, 'dashboard'])->name('subscribers.dashboard');
    //Driver
    Route::get('/createDriver', [App\Http\Controllers\SubscriberHomeController::class, 'createdriver'])->name('createdriver');
    Route::get('/driver', [App\Http\Controllers\SubscriberHomeController::class, 'driver'])->name('driver');
    Route::post('/driverstore', [App\Http\Controllers\SubscriberHomeController::class, 'driverstore']);
    Route::get('/driver/show/{id}', [App\Http\Controllers\SubscriberHomeController::class, 'show'])->name('show');
    Route::get('/driver/{id}', [App\Http\Controllers\SubscriberHomeController::class, 'edit']);
    Route::put('/driverupdate/{id}', [App\Http\Controllers\SubscriberHomeController::class, 'update']);
    Route::get('/driverdelete/{id}', [App\Http\Controllers\SubscriberHomeController::class, 'destroy']);
    Route::get('driverStatus', [App\Http\Controllers\SubscriberHomeController::class, 'driverStatus']);
    Route::get('/blockedDriver', [App\Http\Controllers\SubscriberHomeController::class, 'blocked'])->name('blockedDriver');
    Route::put('/driverblock/{id}', [App\Http\Controllers\SubscriberHomeController::class, 'driverblock']);
    Route::post('/driverunblock', [App\Http\Controllers\SubscriberHomeController::class, 'driverunblock']);


    Route::get('/profile', [App\Http\Controllers\SubscriberHomeController::class, 'profile'])->name('subscribers.profile');
    Route::post('/updateProfile', [App\Http\Controllers\SubscriberHomeController::class, 'updateProfile']);
    Route::get('/price', [App\Http\Controllers\SubscriberHomeController::class, 'price'])->name('subscribers.price');
    Route::post('/pricestore', [App\Http\Controllers\SubscriberHomeController::class, 'pricestore']);


    Route::get('/coupons', [App\Http\Controllers\CouponController::class, 'coupons'])->name('coupons');
    Route::get('/coupons/create', [App\Http\Controllers\CouponController::class, 'createcoupons'])->name('createcoupons');

    Route::post('/couponsstore', [App\Http\Controllers\CouponController::class, 'couponsstore']);
    Route::get('/coupons/{id}', [App\Http\Controllers\CouponController::class, 'couponsedit']);
    Route::put('/couponsupdate/{id}', [App\Http\Controllers\CouponController::class, 'couponsupdate']);
    Route::get('/couponsdelete/{id}', [App\Http\Controllers\CouponController::class, 'couponsdestroy']);
    Route::get('/couponsActivate', [App\Http\Controllers\CouponController::class, 'couponsActivate']);


    Route::get('/complaints', [App\Http\Controllers\SubscriberActionController::class, 'complaints'])->name('subscribers.complaints');
    Route::get('/complaints/create', [App\Http\Controllers\SubscriberActionController::class, 'complaintsform'])->name('subscribers.complaintsform');
    Route::post('/complaintsstore', [App\Http\Controllers\SubscriberActionController::class, 'complaintsstore'])->name('subscribers.complaintsstore');
    Route::get('/complaints/{id}', [App\Http\Controllers\SubscriberActionController::class, 'complaintsshow'])->name('complaintShow');
    Route::get('/complaintEdit/{id}', [App\Http\Controllers\SubscriberActionController::class, 'edit'])->name('complaintEdit');
    Route::put('/complaintUpdate/{id}', [App\Http\Controllers\SubscriberActionController::class, 'update'])->name('complaintUpdate');
    Route::get('complaintAction/{complaint}', [App\Http\Controllers\SubscriberActionController::class, 'actionedBy'])->name('complaintAction');





    Route::get('/enquiry', [App\Http\Controllers\SubscriberActionController::class, 'enquiry'])->name('subscribers.enquiry');
    Route::get('/enquiry/create', [App\Http\Controllers\SubscriberActionController::class, 'enquiryform'])->name('subscribers.enquiryform');
    Route::post('/enquirysstore', [App\Http\Controllers\SubscriberActionController::class, 'enquirystore'])->name('subscribers.enquirystore');
    Route::get('/enquiry/{id}', [App\Http\Controllers\SubscriberActionController::class, 'enquiryshow']);

    Route::resource('bookingReport', SubscriberBookingReportController::class);
    Route::get('downloadsExcel', [SubscriberBookingReportController::class, 'downloadexcel'])->name('downloadsExcel');
    Route::get('downloadsPDF', [SubscriberBookingReportController::class, 'downloadPDF'])->name("downloadsPDF");

    Route::resource('driverReport', DriverBookingReport::class)->parameter('driverReport', 'subscriber')->only('index', 'show');
    Route::get('driverExcelDownload/{driver}', [DriverBookingReport::class, 'downloadExcel'])->name('driverExcelDownload');
    Route::get('driverPdfDownload/{driver}', [DriverBookingReport::class, 'downloadPdf'])->name('driverPdfDownload');
    Route::as('subscribers.')->group(function () {
        Route::resource('coupon', SubscriberCouponController::class)->except('view', 'edit');
    });
});


Route::get('/', [App\Http\Controllers\websiteController::class, 'home']);
Route::get('about', [App\Http\Controllers\websiteController::class, 'about']);
Route::get('services', [App\Http\Controllers\websiteController::class, 'services']);
Route::get('contact', [App\Http\Controllers\websiteController::class, 'contact']);
Route::get('pbp', [App\Http\Controllers\websiteController::class, 'pbp']);
Route::get('readmore/{what}', [App\Http\Controllers\websiteController::class, 'readmore']);
Route::post('inquirystore', [InquiryController::class, 'store'])->name('inquirystore');
Route::post('feedback', [FeedbackController::class, 'store'])->name('feedback');
Route::post('storeNewsletter', [NewsLetterController::class, 'store'])->name('storeNewsletter');


// Route::get('admin','websiteController@admin');
Route::prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\websiteController::class, 'admin'])->middleware('auth');
    Route::get('/details', [App\Http\Controllers\websiteController::class, 'admin'])->middleware('auth');
    Route::post('siteupdate', [App\Http\Controllers\websiteController::class, 'siteupdate'])->name('siteupdate')->middleware('auth');
    Route::get('/slider', [App\Http\Controllers\websiteController::class, 'slider'])->middleware('auth');
    Route::post('siteupdateimage', [App\Http\Controllers\websiteController::class, 'siteupdateimage'])->name('siteupdateimage')->middleware('auth');
    Route::get('/delete/{id}', [App\Http\Controllers\websiteController::class, 'sliderdelete'])->middleware('auth');
    Route::resource('pushnotification', PushnotificationController::class)->only('index', 'store');
});

Route::get('forgotPassword', [PasswordController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('emailVerification', [PasswordController::class, 'sendForgotPasswordEmail'])->name('emailVerification');
Route::get('passwordReset/{id}', [PasswordController::class, 'passwordReset'])->name('passwordReset');
Route::post('confimed_password', [PasswordController::class, 'newPassword'])->name('confimed_password');
Route::get('newsletter', [NewsLetterController::class, 'index'])->name('newsletter');
Route::get('newsLetterExcel', [NewsLetterController::class, 'newsLetterExcel'])->name('newsLetterExcel');
Route::get('newsLetterPDF', [NewsLetterController::class, 'newsLetterPDF'])->name("newsLetterPDF");

Route::get('statusactive', [App\Http\Controllers\websiteController::class, 'statusactive'])->name('statusactive');
Route::get('statusonoroff', [App\Http\Controllers\websiteController::class, 'statusonoroff']);


Route::post('subscriberstatuschange', [App\Http\Controllers\otherController::class, "subscriberstatuschange"])->name('subscriberstatuschange');

Route::post('makepayment', [\App\Http\Controllers\otherController::class, "makesubscribtionpayment"])->name('makepayment');
Route::get('validId', [\App\Http\Controllers\otherController::class, "validId"])->name('validId');
Route::get('successfullypayment/{user_id}', [\App\Http\Controllers\otherController::class, "successfullypayment"])->name('successfullypayment');

Route::get('successpay', [\App\Http\Controllers\otherController::class, "successpay"])->name('successpay');



Route::get('chatwithadmin', [App\Http\Controllers\otherController::class, "chatwithadmin"])->name('chatwithadmin');
Route::get('chat/{id}', [App\Http\Controllers\otherController::class, "chat"])->name('chat');


Route::get('subscriberchatwithadmin', [App\Http\Controllers\otherController::class, "subscriberchatwithadmin"])->name('subscriberchatwithadmin');
Route::get('rl', [\App\Http\Controllers\otherController::class, "rl"]);

Route::get("chatsupport", [\App\Http\Controllers\otherController::class, "chatsupport"]);




Route::get('Banner', [\App\Http\Controllers\otherController::class, "Banner"]);
Route::post('bannersubmit', [\App\Http\Controllers\otherController::class, "bannersubmit"])->name('bannersubmit');
Route::get('bannerdelete/{id}', [\App\Http\Controllers\otherController::class, 'bannerdelete'])->name('bannerdelete');
Route::post('bannereditsubmit', [\App\Http\Controllers\otherController::class, "bannereditsubmit"])->name('bannereditsubmit');


Route::get("Voucher", [\App\Http\Controllers\otherController::class, "Voucher"]);
Route::post('vouchersubmit', [\App\Http\Controllers\otherController::class, "vouchersubmit"])->name('vouchersubmit');
Route::post('vouchereditsubmit', [\App\Http\Controllers\otherController::class, "vouchereditsubmit"])->name('vouchereditsubmit');
Route::get('voucherdelete/{id}', [\App\Http\Controllers\otherController::class, 'voucherdelete'])->name('voucherdelete');


Route::get('bookingReport', [BookingReportController::class, 'index'])->name('bookingReport');
Route::get('bookingReport/{booking}', [BookingReportController::class, 'show'])->name('viewbooking');
Route::get('downloadExcel', [BookingReportController::class, 'downloadexcel'])->name('downloadExcel');
Route::get('downloadPDF', [BookingReportController::class, 'downloadPDF'])->name("downloadPDF");


Route::get('subscriberExpiry', [SubscriberExpiryController::class, 'index'])->name('subscriberExpiry');
// Route::get('subscriberView', [SubscriberExpiryController::class, 'show'])->name('subscriberView')->parameter('subscriberView', 'subscriber');
Route::get('expirydownloadExcel', [SubscriberExpiryController::class, 'downloadexcel'])->name('expirydownloadExcel');
Route::get('expirydownloadPDF', [SubscriberExpiryController::class, 'downloadpdf'])->name('expirydownloadPDF');

Route::resource('subscriberReport', SubscriberReportController::class)->only('index', 'show')->parameter('subscriberReport', 'subscriber');
Route::get('SubscriberdownloadExcel/{subscriber}', [SubscriberReportController::class, 'downloadexcel'])->name('SubscriberdownloadExcel');
Route::get('SubscriberdownloadPdf/{subscriber}', [SubscriberReportController::class, 'downloadpdf'])->name('SubscriberdownloadPdf');

Route::resource('checking', CheckingController::class)->only('store', 'update');

Route::resource('employeeReport', EmployeeReportController::class)->parameter('employeeReport', 'admin')->only('index', 'show');
Route::get('employeeExcel/{employee}', [EmployeeReportController::class, 'downloadExcel'])->name('employeeExcel');
Route::get('employeePdf/{employee}', [EmployeeReportController::class, 'downloadPdf'])->name('employeePdf');

Route::resource('employeePerformance', EmployeePerformanceController::class)->parameter('employeePerformance', 'admin')->only('index', 'show');
Route::get('employeePerformanceExcel/{employee}', [EmployeePerformanceController::class, 'downloadExcel'])->name('employeePerformanceExcel');
Route::get('employeePerformancePdf/{employee}', [EmployeePerformanceController::class, 'downloadPdf'])->name('employeePerformancePdf');

Route::resource('enquiryComment', EnquiryCommentController::class)->only('store');
Route::resource('feed', FeedbackController::class)->only('index', 'show')->parameter('feed', 'feedback');
Route::resource('report', ReportController::class)->only('index');
Route::get('getchartdata', [SubscriberHomeController::class, 'getChartData'])->name('getChartData');
Route::resource('paymenthistory', PaymentReportController::class)->parameter('paymenthistory', 'paymentDetail');
Route::get('invoicedownloadPDF/{paymentDetail}', [PaymentReportController::class, 'downloadPDF'])->name("invoicedownloadPDF");
Route::get('getAppVerision/{site}', [App\Http\Controllers\HomeController::class, 'appVerision'])->name('getAppVerision');
Route::put('updateAppVerision/{site}', [App\Http\Controllers\HomeController::class, 'updateAppVerision'])->name('updateAppVerision');
Route::resource('paymentReport', PaymentReportController::class);
Route::resource('voucher', VoucherController::class);
Route::resource('coupon', CouponController::class);
Route::get('coupStatus', [CouponController::class, 'couponstatus'])->name('coupStatus');
Route::prefix('admin')->as('admin.')->group(function () {
    Route::resource('banner', bannerController::class)->except('show');
    Route::resource('info', InfoController::class)->except('show');
    Route::get('infoStatus',[InfoController::class,'changeStatus'])->name('infoStatus');
});
Route::get('subscriberWhatsappNotify', [NotifyController::class, 'subscriberWhatsappNotify'])->name('subscriberWhatsappNotify');
Route::get('makePlatFormFee', [PaymentController::class, 'makePlatFormFee'])->name('makePlatFormFee');
Route::get('successfulPlatFormFee/{id}', [PaymentController::class, 'successfulPlatFormFee'])->name('successfulPlatFormFee');
Route::get('getAccessTokenUser', [FirebaseController::class, 'getAccessTokenUser'])->name('getAccessTokenUser');
Route::get('getAccessTokenDriver', [FirebaseController::class, 'getAccessTokenDriver'])->name('getAccessTokenDriver');
