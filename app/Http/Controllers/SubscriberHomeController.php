<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Driver;
use App\Models\Pincode;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Subscriber;
use App\Models\Drivernotify;
use App\Models\Blocklist;
use App\Models\Booking;
use App\Models\Complaints;
use App\Models\Coupon;
use App\Models\Employee;
use App\Models\Enquiry;
use App\Models\Unblocklist;
use App\Models\Pricenotify;
use App\Models\SubBlock;
use App\Models\SubUnblock;
use Illuminate\Support\Facades\DB;

use Validator;

class SubscriberHomeController extends Controller
{
    public $bikeTaxiTotal;
    public function __construct()
    {

        if (empty(Session::get('subscribers')) || Session::get('subscribers') == NULL) {
            return redirect('subscribers/login');
        } else {
            $subscriber = Session::get('subscribers');
        }
    }

    public function dashboard()
    {
        // $authenticatedUser = auth('employee')->user()->roles;
        // Now you can use $authenticatedUser as the authenticated subscriber
        // dd($authenticatedUser);
        $subscriber = Session::get('subscribers');

        if (isset($subscriber->subscriberId)) {

            $subscribersPin = json_decode($subscriber->pincode);

            $pincodes = Pincode::whereIn('id', $subscribersPin)->get()->pluck('pincode');
            // dd($pincodes);
            $driversCount = Driver::where('subscriberId', $subscriber->id)->get()->count();
            $drivers = Driver::where('subscriberId', $subscriber->id)->get()->pluck('userid');
            $rideronlineCount = User::whereIn('id', $drivers)->where('is_live', 1)->get()->count();
            $riderofflineCount = User::whereIn('id', $drivers)->where('is_live', '!=', 1)->get()->count();
            $enquiryCount = Enquiry::where('subscriberId', $subscriber->id)->get()->count();
            $employeeCount = Employee::where('subscriber_id', $subscriber->id)->get()->count();
            $completedBookings = Booking::whereIn('pincode', $pincodes)->where('status', 2)->get()->count();
            $inprogressBooking = Booking::whereIn('pincode', $pincodes)->where('status', 1)->get()->count();
            $todaynewBookings = Booking::whereIn('pincode', $pincodes)->whereDate('created_at', now()->format('d-m-Y'))->get()->count();
            $complaintTaken = Complaints::where('subscriberId', $subscriber->id)->where('complained_id', $subscriber->id)->get()->count();
            $complaintSolved = Complaints::where('subscriberId', $subscriber->id)->where('solved_id', $subscriber->id)->get()->count();
            //$activeCoupons = Coupon::where('subscriber_id', $subscriber->id)->where('status', 1)->get()->count();
            //$inactiveCoupons = Coupon::where('subscriber_id', $subscriber->id)->where('status', 0)->get()->count();
            // dd($activeCoupons);
            $subscriptionDate = Subscriber::where('id',  $subscriber->id)->pluck('expiryDate')->first()->format('d-m-Y');
            $activeCoupons = 0;
            $inactiveCoupons = 0;
            if ($subscriptionDate) {
                // Convert subscription date to Carbon instance for easy date comparisons
                $subscriptionDate = Carbon::parse($subscriptionDate);

                // Get the count of subscription dates from $subscriptionDate to now (including today)
                $dateDiff = $subscriptionDate->diffInDays(now()->format('d-m-Y'));
            }
            //dd($dateDiff);
            $subscriptionDateCount = $dateDiff;
            $completeRides = Booking::whereIn('pincode', $pincodes)->where('status', 2)->get()->count();
            $cancelledRides = Booking::whereIn('pincode', $pincodes)->where('status', 3)->get()->count();
            $inprocessRides = Booking::whereIn('pincode', $pincodes)->where('status', 1)->get()->count();

            $drivers = Driver::where('subscriberId', session('subscribers')['id'])->latest()->get()->pluck('userid');
            $blockedRiders = Driver::where('status', 2)->where('subscriberId', session('subscribers')['id'])->get()->count();
            //dd($blockedRiders);
            // $blockedSubscribers = Subscriber::where('blockedstatus', 0)->get()->count();

            // dd($subscriptionDate);

            $bookingsCount = Booking::whereIn('pincode', $pincodes)->get()->count();

            $overallServicePrice = Booking::with('bookingPayment')->whereIn('pincode', $pincodes)->get();
            $totalServiceAmount = $overallServicePrice->sum(function ($booking) {
                return $booking->bookingPayment->sum(function ($payment) {
                    // Check if coupon_id is not null and adjust the total accordingly
                    if ($payment->coupon_id !== null) {
                        return $payment->total - $payment->coupon_amount;
                    } else {
                        return $payment->total;
                    }
                });
            });

            $bikeTaxi = Booking::where('category', 1)->whereIn('pincode', $pincodes)->with('bookingPayment')->get();
            $bikeTaxiTotal = $bikeTaxi->sum(function ($booking) {
                return $booking->bookingPayment->sum(function ($payment) {
                    // Check if coupon_id is not null and adjust the total accordingly
                    if ($payment->coupon_id !== null) {
                        return $payment->total - $payment->coupon_amount;
                    } else {
                        return $payment->total;
                    }
                });
            });

            $pickup = Booking::where('category', 2)->whereIn('pincode', $pincodes)->with('bookingPayment')->get();
            $pickupTotal = $pickup->sum(function ($booking) {
                return $booking->bookingPayment->sum(function ($payment) {
                    // Check if coupon_id is not null and adjust the total accordingly
                    if ($payment->coupon_id !== null) {
                        return $payment->total - $payment->coupon_amount;
                    } else {
                        return $payment->total;
                    }
                });
            });

            $dropAndDelivery = Booking::where('category', 3)->whereIn('pincode', $pincodes)->with('bookingPayment')->get();
            $dropAndDeliveryTotal = $dropAndDelivery->sum(function ($booking) {
                return $booking->bookingPayment->sum(function ($payment) {
                    // Check if coupon_id is not null and adjust the total accordingly
                    if ($payment->coupon_id !== null) {
                        return $payment->total - $payment->coupon_amount;
                    } else {
                        return $payment->total;
                    }
                });
            });

            $auto = Booking::where('category', 4)->whereIn('pincode', $pincodes)->with('bookingPayment')->get();
            $autoTotal = $auto->sum(function ($booking) {
                return $booking->bookingPayment->sum(function ($payment) {
                    // Check if coupon_id is not null and adjust the total accordingly
                    if ($payment->coupon_id !== null) {
                        return $payment->total - $payment->coupon_amount;
                    } else {
                        return $payment->total;
                    }
                });
            });

            // dd($totalServiceAmount);
        } else {
            // dd($subscriber);
            $subscriber = Subscriber::where('id', $subscriber->subscriber_id)?->first();
            $subscribersPin = json_decode($subscriber->pincode);
            $pincodes = Pincode::whereIn('id', $subscribersPin)->get()->pluck('pincode');
            $enquiryCount = Enquiry::where('subscriberId', $subscriber->id)->get()->count();
            $employeeCount = Employee::where('subscriber_id', $subscriber->subscriber_id)->get()->count();
            $completedBookings = Booking::whereIn('pincode', $pincodes)->where('status', 3)->get()->count();
            $inprogressBooking = Booking::whereIn('pincode', $pincodes)->where('status', 1)->get()->count();

            $todaynewBookings = Booking::whereIn('pincode', $pincodes)->whereDate('created_at', now()->format('d-m-Y'))->get()->count();
            $complaintTaken = Complaints::where('subscriberId', $subscriber->subscriber_id)->where('complained_id', $subscriber->id)->get()->count();
            $complaintSolved = Complaints::where('subscriberId', $subscriber->subscriber_id)->where('solved_id', $subscriber->id)->get()->count();
            //$activeCoupons = Coupon::where('subscriber_id', $subscriber->subscriber_id)->where('status', 1)->get()->count();
            //$inactiveCoupons = Coupon::where('subscriber_id', $subscriber->subscriber_id)->where('status', 0)->get()->count();
            $subscriptionDate = Subscriber::where('id',  $subscriber->subscriber_id)->pluck('subscriptionDate')->first();
            $completeRides = Booking::whereIn('pincode', $pincodes)->where('status', 2)->get()->count();
            $cancelledRides = Booking::whereIn('pincode', $pincodes)->where('status', 3)->get()->count();
            $inprocessRides = Booking::whereIn('pincode', $pincodes)->where('status', 1)->get()->count();
            $blockedRiders = User::where('blockedstatus', 1)->get()->count();
            // $blockedSubscribers = Subscriber::where('blockedstatus', 0)->get()->count();
            $activeCoupons = 0;
            $inactiveCoupons = 0;
            // dd($inactiveCoupons);
            // dd($subscriber);
            $driversCount = Driver::where('subscriberId', $subscriber->id)->get()->count();
            $drivers = Driver::where('subscriberId', $subscriber->id)->get()->pluck('userid');
            $rideronlineCount = User::whereIn('id', $drivers)->where('is_live', 1)->get()->count();
            $riderofflineCount = User::whereIn('id', $drivers)->where('is_live', '!=', 1)->get()->count();
            $bookingsCount = Booking::whereIn('pincode', $pincodes)->get()->count();
            $overallServicePrice = Booking::with('bookingPayment')->whereIn('pincode', $pincodes)->get();
            $totalServiceAmount = $overallServicePrice->sum(function ($booking) {
                return $booking->bookingPayment->sum(function ($payment) {
                    // Check if coupon_id is not null and adjust the total accordingly
                    if ($payment->coupon_id !== null) {
                        return $payment->total - $payment->coupon_amount;
                    } else {
                        return $payment->total;
                    }
                });
            });

            $bikeTaxi = Booking::where('category', 1)->whereIn('pincode', $pincodes)->with('bookingPayment')->get();
            $bikeTaxiTotal = $bikeTaxi->sum(function ($booking) {
                return $booking->bookingPayment->sum(function ($payment) {
                    // Check if coupon_id is not null and adjust the total accordingly
                    if ($payment->coupon_id !== null) {
                        return $payment->total - $payment->coupon_amount;
                    } else {
                        return $payment->total;
                    }
                });
            });

            $pickup = Booking::where('category', 2)->whereIn('pincode', $pincodes)->with('bookingPayment')->get();
            $pickupTotal = $pickup->sum(function ($booking) {
                return $booking->bookingPayment->sum(function ($payment) {
                    // Check if coupon_id is not null and adjust the total accordingly
                    if ($payment->coupon_id !== null) {
                        return $payment->total - $payment->coupon_amount;
                    } else {
                        return $payment->total;
                    }
                });
            });

            $dropAndDelivery = Booking::where('category', 3)->whereIn('pincode', $pincodes)->with('bookingPayment')->get();
            $dropAndDeliveryTotal = $dropAndDelivery->sum(function ($booking) {
                return $booking->bookingPayment->sum(function ($payment) {
                    // Check if coupon_id is not null and adjust the total accordingly
                    if ($payment->coupon_id !== null) {
                        return $payment->total - $payment->coupon_amount;
                    } else {
                        return $payment->total;
                    }
                });
            });

            $auto = Booking::where('category', 4)->whereIn('pincode', $pincodes)->with('bookingPayment')->get();
            $autoTotal = $auto->sum(function ($booking) {
                return $booking->bookingPayment->sum(function ($payment) {
                    // Check if coupon_id is not null and adjust the total accordingly
                    if ($payment->coupon_id !== null) {
                        return $payment->total - $payment->coupon_amount;
                    } else {
                        return $payment->total;
                    }
                });
            });


            $subscriptionDate = Subscriber::where('id',  $subscriber->id)->pluck('expiryDate')->first()->format('d-m-Y');

            if ($subscriptionDate) {
                // Convert subscription date to Carbon instance for easy date comparisons
                $subscriptionDate = Carbon::parse($subscriptionDate);

                // Get the count of subscription dates from $subscriptionDate to now (including today)
                $dateDiff = $subscriptionDate->diffInDays(now());

                // If you want to exclude today, use the following instead:
                // ->whereBetween('expiryDate', [$subscriptionDate, now()->subDay()->endOfDay()])
            }
            //dd($dateDiff);
            $subscriptionDateCount = $dateDiff;
        }
        $this->bikeTaxiTotal = 1;
        // dd($this->bikeTaxiTotal);
        return view('subscriber.dashboard', [
            'driversCount' => $driversCount,
            'bookingsCount' => $bookingsCount,
            'totalServiceAmount' => $totalServiceAmount,
            'bikeTaxiTotal' => $bikeTaxiTotal,
            'pickupTotal' => $pickupTotal,
            'dropAndDeliveryTotal' => $dropAndDeliveryTotal,
            'autoTotal' => $autoTotal,
            'riderofflineCount' => $riderofflineCount,
            'rideronlineCount' => $rideronlineCount,
            'enquiryCount' => $enquiryCount,
            'employeeCount' => $employeeCount,
            'completedBookings' => $completedBookings,
            'inprogressBooking' => $inprogressBooking,
            'todaynewBookings' => $todaynewBookings,
            'complaintSolved' => $complaintSolved,
            'complaintTaken' => $complaintTaken,
            'inactiveCoupons' => $inactiveCoupons,
            'activeCoupons' => $activeCoupons,
            'subscriptionDate' => $subscriptionDate,

            'blockedRiders' => $blockedRiders,
            'cancelledRides' => $cancelledRides,
            'inprocessRides' => $inprocessRides,
            'completeRides' => $completeRides,
            'subscriptionDateCount' => $subscriptionDateCount

        ]);
        // $this->getChartData($bikeTaxiTotal,$pickupTotal,$dropAndDeliveryTotal,$totalServiceAmount);
    }

    public function getChartData(Request $request)
    {
        // Fetch and format your data here


        $data = [
            'chart1' => [
                'label' => 'Bike Taxi',
                'value' => $this->bikeTaxiTotal,
            ],
            'chart2' => [
                'label' => 'Pick Up',
                'value' => 20,
            ],
            'chart3' => [
                'label' => 'A to Z ',
                'value' => 30,
            ],
            'chart4' => [
                'label' => 'Overall ',
                'value' => 50,
            ],
        ];

        return response()->json($data);
    }

    public function logout()
    {
        //Subscriber::where('id', Session::get('subscribers')['id'])->update(['activestatus' => 0]);
        session()->flush();
        return redirect('subscribers/login');
    }

    //Driver

    public function driver()

    {
        $user = Session::get('subscribers');

        if (isset($user->subscriberId)) {
            if ($user->hasPermissionTo('rider-list')) {
                $driver = Driver::where('subscriberId', session('subscribers')['id'])->latest()->get();
                //dd($driver);
                return view('subscriber.driver.index', compact('driver'));
            }

            return view('subscriber.403');
        } else {
            // $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
            if ($user->hasPermissionTo('rider-list')) {
                $driver = Driver::where('emp_id', $user->id)->latest()->get();
                //dd($driver);
                return view('subscriber.driver.index', compact('driver'));
            }

            return view('subscriber.403');
        }
    }

    public function createdriver()
    {
        $user = Session::get('subscribers');
        if (isset($user->subscriberId)) {
            if ($user->hasPermissionTo('rider-create')) {
                $subscriber = Session::get('subscribers');
                // foreach($subscriber as $subscriber){
                //$pin=json_decode($subscriber->pincode);
                //}
                $pin = json_decode(session('subscribers')['pincode']);
                $pincode = Pincode::whereIn('id', $pin)->get();
                $languages = [
                    'Assamese',
                    'Bengali',
                    'Bodo',
                    'Dogri',
                    'English',
                    'Gujarati',
                    'Hindi',
                    'Kannada',
                    'Kashmiri',
                    'Konkani',
                    'Maithili',
                    'Malayalam',
                    'Marathi',
                    'Meitei',
                    'Nepali',
                    'Odia',
                    'Punjabi',
                    'Sanskrit',
                    'Santali',
                    'Sindhi',
                    'Tamil',
                    'Telugu',
                    'Urdu',
                ];

                return view('subscriber.driver.create', compact('pincode', 'languages'));
            }

            return view('subscriber.403');
        } else {
            if ($user->hasPermissionTo('rider-create')) {
                $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
                $pin = json_decode($subscriber->pincode);
                $pincode = Pincode::whereIn('id', $pin)->get();
                $languages = [
                    'Assamese',
                    'Bengali',
                    'Bodo',
                    'Dogri',
                    'English',
                    'Gujarati',
                    'Hindi',
                    'Kannada',
                    'Kashmiri',
                    'Konkani',
                    'Maithili',
                    'Malayalam',
                    'Marathi',
                    'Meitei',
                    'Nepali',
                    'Odia',
                    'Punjabi',
                    'Sanskrit',
                    'Santali',
                    'Sindhi',
                    'Tamil',
                    'Telugu',
                    'Urdu',
                ];

                return view('subscriber.driver.create', compact('pincode', 'languages'));
            }

            return view('subscriber.403');
        }
    }
    public function driverstore(Request $request)
    {
        $employee = Session::get('subscribers');
        if (isset($employee->emp_id)) {
            $subscriber = Subscriber::where('id', $employee->subscriber_id)->first();
            $this->validate($request, [
                'name' => 'required',
                'location' => 'required',
                'email' => 'required|email|unique:users,email|unique:driver,email',
                'mobile' => ['required', 'max:12', 'unique:users,phone', 'unique:driver,mobile'],
                'pincode' => 'required',
                'language' => 'required',
                'password' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'aadharNo' => 'required|numeric|unique:driver,aadharNo',
                'aadharFrontImage' => 'required',
                'aadharBackImage' => 'required',
                'rcbook' => 'required',
                'insurance' => 'required',
                'bike' => 'required',
                'drivingLicence' => 'required',
                'customerdocument' => 'mimes:pdf|required',
                'vehicleNo' => 'required',
                'vehicleModelNo' => 'required',
                'licenceexpiry' => 'required',
                'profile' => 'nullable',
                'type' => 'required',
            ]);
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $input['user_id'] = 'DK-' . uniqid();
            $input['is_driver'] = 1;
            $input['dop'] = $request->get('dob');
            $input['gender'] = $request->get('gender');
            $input['otp'] = rand(1000, 9999);
            if ($request->hasFile('profile')) {
                $imageName = uniqid() . "." . $request->profile->extension();
                $request->profile->move(public_path('subscriber/driver/profile/'), $imageName);
                $input['image'] = $imageName;
            }
            $user = User::create($input);
            $userid = $user->id;
            $pincode = array();
            $pincode = json_encode($request->pincode);
            $language = array();
            $language = $request->language;
            $languageString = implode(',', $language);
            $driver = new Driver();
            $driver->name = $request->get('name');
            $driver->location = $request->get('location');
            $driver->userid = $userid;
            $driver->licenceexpiry = $request->get('licenceexpiry');

            $driver->email = $request->get('email');
            $driver->mobile = $request->get('mobile');
            $driver->pincode = $pincode;
            $driver->language = $languageString;
            $driver->source = $request->get('password');
            if ($request->get('password') != $request->get('oldpassword')) {
                // dd($request->get('password'));
                $driver->password = Hash::make($request->get('password'));
            }
            $driver->aadharNo = $request->get('aadharNo');
            $driver->description = $request->get('description');
            $driver->bankacno = $request->get('bankacno');
            $driver->ifsccode = $request->get('ifsccode');
            $aadharFrontImage = time() . '.' . $request->aadharFrontImage->extension();
            $request->aadharFrontImage->move(public_path('subscriber/driver/aadhar'), $aadharFrontImage);
            $driver->aadharFrontImage = $aadharFrontImage;
            $driver->emp_id = $subscriber ? $employee->id : "";
            $aadharBackImage = time() . '.' . $request->aadharBackImage->extension();
            $request->aadharBackImage->move(public_path('subscriber/driver/aadhar/back'), $aadharBackImage);
            $driver->aadharBackImage = $aadharBackImage;
            if ($request->hasFile('customerdocument')) {
                $customerdocument = time() . '.' . $request->customerdocument->extension();
                $request->customerdocument->move(public_path('subscriber/driver/document'), $customerdocument);
                $driver->customerdocument = $customerdocument;
            }
            $rcbook = time() . '.' . $request->rcbook->extension();
            $request->rcbook->move(public_path('subscriber/driver/rcbook'), $rcbook);
            $driver->rcbook = $rcbook;

            $drivingLicence = time() . '.' . $request->drivingLicence->extension();
            $request->drivingLicence->move(public_path('subscriber/driver/drivingLicence'), $drivingLicence);
            $driver->drivingLicence = $drivingLicence;

            $insurance = time() . '.' . $request->insurance->extension();
            $request->insurance->move(public_path('subscriber/driver/insurance'), $insurance);
            $driver->insurance = $insurance;

            $bike = time() . '.' . $request->bike->extension();
            $request->bike->move(public_path('subscriber/driver/bike'), $bike);
            $driver->bike = $bike;

            $driver->vehicleNo = $request->get('vehicleNo');
            $driver->vehicleModelNo = $request->get('vehicleModelNo');
            // dd($user->id);
            $driver->subscriberId = $subscriber ? $employee->subscriber_id : session('subscribers')['id'];
            $driver->type = $request->get('type');
            $driver->save();


            //return back()->with('success', 'You have just created one pincode');
            return redirect('subscribers/driver')->with('success', 'Driver added!');
        } else {
            $this->validate($request, [
                'name' => 'required',
                'location' => 'required',
                'email' => 'required|email|unique:users,email|unique:driver,email',
                'mobile' => ['required', 'max:12', 'unique:users,phone', 'unique:driver,mobile'],
                'pincode' => 'required',
                'language' => 'required',
                'password' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'aadharNo' => 'required|numeric|unique:driver,aadharNo',
                'aadharFrontImage' => 'required',
                'aadharBackImage' => 'required',
                'rcbook' => 'required',
                'insurance' => 'required',
                'bike' => 'required',
                'drivingLicence' => 'required',
                'customerdocument' => 'mimes:pdf',

                'vehicleNo' => 'required',
                'vehicleModelNo' => 'required',
                'licenceexpiry' => 'required',
                'profile' => 'nullable',
                'type' => 'required',
            ]);
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $input['user_id'] = 'DK-' . uniqid();
            $input['is_driver'] = 1;
            $input['dop'] = $request->get('dob');
            $input['gender'] = $request->get('gender');
            $input['otp'] = rand(1000, 9999);
            if ($request->hasFile('profile')) {
                $imageName = uniqid() . "." . $request->profile->extension();
                $request->profile->move(public_path('subscriber/driver/profile/'), $imageName);
                $input['image'] = $imageName;
            }
            $user = User::create($input);
            $userid = $user->id;
            $pincode = array();
            $pincode = json_encode($request->pincode);
            $language = array();
            $language = $request->language;
            $languageString = implode(',', $language);
            $driver = new Driver();
            $driver->name = $request->get('name');
            $driver->location = $request->get('location');
            $driver->userid = $userid;
            $driver->licenceexpiry = $request->get('licenceexpiry');

            $driver->email = $request->get('email');
            $driver->mobile = $request->get('mobile');
            $driver->pincode = $pincode;
            $driver->language = $languageString;
            $driver->source = $request->get('password');
            if ($request->get('password') != $request->get('oldpassword')) {
                // dd($request->get('password'));
                $driver->password = Hash::make($request->get('password'));
            }
            $driver->aadharNo = $request->get('aadharNo');
            $driver->description = $request->get('description');
            $driver->bankacno = $request->get('bankacno');
            $driver->ifsccode = $request->get('ifsccode');
            $aadharFrontImage = time() . '.' . $request->aadharFrontImage->extension();
            $request->aadharFrontImage->move(public_path('subscriber/driver/aadhar'), $aadharFrontImage);
            $driver->aadharFrontImage = $aadharFrontImage;
            $driver->emp_id = Null;
            $aadharBackImage = time() . '.' . $request->aadharBackImage->extension();
            $request->aadharBackImage->move(public_path('subscriber/driver/aadhar/back'), $aadharBackImage);
            $driver->aadharBackImage = $aadharBackImage;
            if ($request->hasFile('customerdocument')) {
                $customerdocument = time() . '.' . $request->customerdocument->extension();
                $request->customerdocument->move(public_path('subscriber/driver/document'), $customerdocument);
                $driver->customerdocument = $customerdocument;
            }
            $rcbook = time() . '.' . $request->rcbook->extension();
            $request->rcbook->move(public_path('subscriber/driver/rcbook'), $rcbook);
            $driver->rcbook = $rcbook;

            $drivingLicence = time() . '.' . $request->drivingLicence->extension();
            $request->drivingLicence->move(public_path('subscriber/driver/drivingLicence'), $drivingLicence);
            $driver->drivingLicence = $drivingLicence;

            $insurance = time() . '.' . $request->insurance->extension();
            $request->insurance->move(public_path('subscriber/driver/insurance'), $insurance);
            $driver->insurance = $insurance;

            $bike = time() . '.' . $request->bike->extension();
            $request->bike->move(public_path('subscriber/driver/bike'), $bike);
            $driver->bike = $bike;

            $driver->vehicleNo = $request->get('vehicleNo');
            $driver->vehicleModelNo = $request->get('vehicleModelNo');
            // dd($user->id);
            $driver->subscriberId =  session('subscribers')['id'];
            $driver->type = $request->get('type');
            $driver->save();


            //return back()->with('success', 'You have just created one pincode');
            return redirect('subscribers/driver')->with('success', 'Driver added!');
        }
        //  dd($user->id);
        // dd($request);

    }
    public function edit($id)
    {
        $user = Session::get('subscribers');

        if ($user->hasPermissionTo('rider-edit')) {
            $driver = Driver::find($id);
            $user = User::where('id', $driver->userid)->get();
            //$pincode = Pincode::all();
            $subscriber = Session::get('subscribers');
            // foreach($subscriber as $subscriber){
            //$pin=json_decode($subscriber->pincode);
            //}
            $pin = json_decode(session('subscribers')['pincode']);
            $pincode = Pincode::whereIn('id', $pin)->get();
            $languages = [
                'Assamese',
                'Bengali',
                'Bodo',
                'Dogri',
                'English',
                'Gujarati',
                'Hindi',
                'Kannada',
                'Kashmiri',
                'Konkani',
                'Maithili',
                'Malayalam',
                'Marathi',
                'Meitei',
                'Nepali',
                'Odia',
                'Punjabi',
                'Sanskrit',
                'Santali',
                'Sindhi',
                'Tamil',
                'Telugu',
                'Urdu',
            ];
            $languageString = $driver->language;

            // Convert the string into an array
            $languageArray = explode(',', $languageString);
            //dd($pincode);
            return view('subscriber.driver.edit', compact('user', 'driver', 'pincode', 'languageArray', 'languages'));
        }

        return view('subscriber.403');
    }
    public function update(Request $request, $id)
    {
        $driver = Driver::find($id);
        //dd($request);
        $this->validate($request, [
            'name' => 'required',
            'location' => 'required',
            'email' => 'required|email|unique:users,email,' . $driver->userid . '|unique:driver,email,' . $driver->id,
            'mobile' => ['required', 'max:12', 'unique:users,phone,' . $driver->userid, 'unique:driver,mobile,' . $driver->id],
            'pincode' => 'required',
            'language' => 'required',
            'password' => 'nullable',
            'dob' => 'required',
            'gender' => 'required',
            'aadharNo' => 'required|numeric',
            'vehicleNo' => 'required',
            'vehicleModelNo' => 'required',
            'licenceexpiry' => 'required',
            'profile' => 'nullable',
            'type' => 'required',
        ]);
        $pincode = array();
        $pincode = json_encode($request->pincode);
        $language = $request->language;
        $languageString = implode(',', $language);

        $driver = Driver::findorFail($id);
        $driver->name = $request->get('name');
        $driver->location = $request->get('location');
        $driver->email = $request->get('email');
        $driver->mobile = $request->get('mobile');
        $driver->pincode = $pincode;
        $driver->language = $languageString;
        $driver->licenceexpiry = $request->get('licenceexpiry');
        // $driver->source = $request->get('password');
        // $driver->password = Hash::make($request->get('password'));
        $driver->aadharNo = $request->get('aadharNo');
        $driver->description = $request->get('description');
        $driver->bankacno = $request->get('bankacno');
        $driver->ifsccode = $request->get('ifsccode');
        if ($request->hasFile('aadharFrontImage')) {
            $aadharFrontImage = time() . '.' . $request->aadharFrontImage->extension();
            $request->aadharFrontImage->move(public_path('subscriber/driver/aadhar'), $aadharFrontImage);
            $driver->aadharFrontImage = $aadharFrontImage;
        }
        if ($request->hasFile('aadharBackImage')) {
            $aadharBackImage = time() . '.' . $request->aadharBackImage->extension();
            $request->aadharBackImage->move(public_path('subscriber/driver/aadhar/back'), $aadharBackImage);
            $driver->aadharBackImage = $aadharBackImage;
        }
        if ($request->hasFile('customerdocument')) {
            $customerdocument = time() . '.' . $request->customerdocument->extension();
            $request->customerdocument->move(public_path('subscriber/driver/document'), $customerdocument);
            $driver->customerdocument = $customerdocument;
        }
        if ($request->hasFile('rcbook')) {
            $rcbook = time() . '.' . $request->rcbook->extension();
            $request->rcbook->move(public_path('subscriber/driver/rcbook'), $rcbook);
            $driver->rcbook = $rcbook;
        }
        if ($request->hasFile('drivingLicence')) {
            $drivingLicence = time() . '.' . $request->drivingLicence->extension();
            $request->drivingLicence->move(public_path('subscriber/driver/drivingLicence'), $drivingLicence);
            $driver->drivingLicence = $drivingLicence;
        }
        if ($request->hasFile('insurance')) {
            $insurance = time() . '.' . $request->insurance->extension();
            $request->insurance->move(public_path('subscriber/driver/insurance'), $insurance);
            $driver->insurance = $insurance;
        }
        if ($request->hasFile('bike')) {
            $bike = time() . '.' . $request->bike->extension();
            $request->bike->move(public_path('subscriber/driver/bike'), $bike);
            $driver->bike = $bike;
        }
        $driver->vehicleNo = $request->get('vehicleNo');
        $driver->vehicleModelNo = $request->get('vehicleModelNo');
        if ($request->get('password') != "") {
            $driver->password = Hash::make($request->get('password'));
        }
        $changes = $driver->getDirty();
        $driver->type = $request->get('type');
        $driver->update();
        $data = json_encode($changes, true);
        $myself = Session::get('subscribers');
        if (isset($myself->subscriberId)) {
            $notify = new Drivernotify();
            $notify->datas = $data;
            $notify->modifiedBy = $myself->id;
            $notify->modifiedId = $id;
            $notify->message = $request->get('comments');
            $notify->save();
        } else {
            $notify = new Drivernotify();
            $mine = Employee::where('email', $myself->email)->first();
            $notify->datas = $data;
            $notify->modifiedBy = $mine->subscriber_id;
            $notify->modifiedId = $id;
            $notify->message = $request->get('comments');
            $notify->save();
        }

        //dd($changes);
        $driver = Driver::find($id);
        $u = User::where('id', $driver->userid)->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'dob' => $request->get('dob'),
            'gender' => $request->get('gender'),
        ]);
        if ($request->get('password') != "") {
            $hashedPassword = Hash::make($request->get('password'));
            User::where('id', $driver->userid)->update([
                'password' => $hashedPassword,
            ]);
        }
        if ($request->hasFile('profile')) {
            $imageName = uniqid() . "." . $request->profile->extension();
            $request->profile->move(public_path('subscriber/driver/profile'), $imageName);
            $u = User::where('id', $driver->userid)->update([
                'image' => $imageName,
            ]);
        }
        return redirect('subscribers/driver')->with('success', 'Driver Updated');
    }

    public function driverStatus(Request $request)
    {

        $driver = Driver::findOrFail($request->id);
        $driver->status = $request->status;
        $driver->save();



        return response()->json(['success' => 'Status updated successfully.']);
    }

    public function show($id)
    {
        $subs_id = session('subscribers')['id'];
        $driver = Driver::find($id);
        $user = User::where('id', $driver->userid)->get();
        // $subscriber = Subscriber::all();
        $employees = Employee::all();
        $admins = Admin::all();
        $pin = json_decode($driver->pincode);
        $pincode = Pincode::whereIn('id', $pin)->get();
        //  $notification=Drivernotify::where([['modifiedBy',$subs_id],['modifiedId',$id]])->get();
        $notification = Drivernotify::where([['modifiedId', $id]])->get();
        //dd($pincode);
        return view('subscriber.driver.show', compact('user', 'driver', 'pincode', 'notification', 'employees', 'admins'));
    }
    public function destroy($id)
    {
        $user = Session::get('subscribers');

        if ($user->hasPermissionTo('rider-destroy')) {
            Driver::find($id)->delete();
            return back()->with('success', 'driver deleted successfully');
        }

        return view('subscriber.403');
    }

    public function blocked()

    {


        $driver = Driver::where('status', 2)->where('subscriberId', session('subscribers')['id'])->get();
        return view('subscriber.driver.blocked', compact('driver'));
    }
    public function profile()

    {
        $user = Session::get('subscribers');
        // dd($user);
        if (isset($user->subscriberId)) {
            $subscriber = $user;
            $employee = Employee::where('email', $user->email)->first();
            return view('subscriber.profile', ['employee' => $employee, 'subscriber' => $subscriber]);
        } else {
            return view('subscriber.profile', ['employee' => $user]);
        }
    }
    public function updateProfile(Request $request)
    {
        $user = Session::get('subscribers');
        if (isset($user->subscriberId)) {
            $this->validate($request, [
                'name' => 'required',
                'location' => 'required',
                'official_mail' => 'required',
                'gst' => 'nullable',
                'profile' => 'nullable',
                'official_mobile' => ['required', 'max:12'],

            ]);
            $employee = Employee::where('email', $user->email)->first();

            $employee->name = $request->get('name');
            $employee->location = $request->get('location');
            $employee->official_mail = $request->get('official_mail');
            $employee->official_mobile = $request->get('official_mobile');
            if ($request->hasFile('profile')) {
                $profile = time() . '.' . $request->profile->extension();
                $request->profile->move(public_path('admin/employee/profile'), $profile);
                $employee->profile = $profile;
                // dd($employee->profile);
            }
            $employee->update();

            $subscribers = Subscriber::where('id', $user?->id)?->first();
            // dd($subscribers);
            $subscribers->name = $request->get('name');
            $subscribers->location = $request->get('location');
            $subscribers->gst = $request->get('gst');
            //  dd($subscribers);
            // if ($request->hasFile('profile')) {
            //     $imageName = time() . '.' . $request->profile->extension();
            //     $request->profile->move(public_path('admin/subscriber/profile'), $imageName);
            //     $subscribers->image = $imageName;
            // }
            $subscribers->update();
        } else {
            $employee = Session::get('subscribers');
            $employee->name = $request->get('name');
            $employee->location = $request->get('location');

            $employee->official_mail = $request->get('official_mail');
            $employee->official_mobile = $request->get('official_mobile');
            if ($request->hasFile('profile')) {
                $profile = time() . '.' . $request->profile->extension();
                $request->profile->move(public_path('admin/employee/profile'), $profile);
                $employee->profile = $profile;
            }
            $employee->update();
        }
        return redirect('subscribers/profile')->with('success', 'Profile Updated!');
    }
    public function price()

    {
        $user = Session::get('subscribers');
        // dd($user);
        if (isset($user->subscriberId)) {
            $subscriber = Subscriber::where('subscriberId', $user->subscriberId)->first();
            if ($user->hasPermissionTo('category-price')) {
                // $subscriber = $user;
                // dd($subscriber);
                return view('subscriber.price', ['subscriber' => $subscriber]);
            }

            return view('subscriber.403');
        } else {
            // dd($user);
            $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
            // dd($subscriber);
            if ($user->hasPermissionTo('category-price')) {
                return view('subscriber.price', ['subscriber' => $subscriber]);
            }

            return view('subscriber.403');
        }
    }
    public function pricestore(Request $request)
    {
        $sumbscriber = Subscriber::where('id', $request->id)->first();
        // dd($request);
        // dd($request->get('pincode'));
        $this->validate($request, [
            'biketaxi_price' => 'required',
            'pickup_price' => 'required',
            'buy_price' => 'required',
            'auto_price' => 'required',
            'bt_price1' => 'required|numeric',
            'bt_price2' => 'required|numeric',
            'bt_price3' => 'required|numeric',
            'bt_price4' => 'required|numeric',
            'pk_price1' => 'required|numeric',
            'pk_price2' => 'required|numeric',
            'pk_price3' => 'required|numeric',
            'pk_price4' => 'required|numeric',
            'bd_price1' => 'required|numeric',
            'bd_price2' => 'required|numeric',
            'bd_price3' => 'required|numeric',
            'bd_price4' => 'required|numeric',
            'at_price1' => 'required|numeric',
            'at_price1' => 'required|numeric',
            'at_price1' => 'required|numeric',
            'at_price1' => 'required|numeric',

        ]);


        $subid = $request->get('id');
        $zipcode = json_decode(session('subscribers')['pincode'] ? session('subscribers')['pincode'] : $sumbscriber->pincode);
        $subscribers = Subscriber::findorFail($request->get('id'));
        $subscribers->biketaxi_price = $request->get('biketaxi_price');
        $subscribers->pickup_price = $request->get('pickup_price');
        $subscribers->buy_price = $request->get('buy_price');
        $subscribers->auto_price = $request->get('auto_price');
        $subscribers->bt_price1 = $request->get('bt_price1');
        $subscribers->bt_price2 = $request->get('bt_price2');
        $subscribers->bt_price3 = $request->get('bt_price3');
        $subscribers->bt_price4 = $request->get('bt_price4');
        $subscribers->pk_price1 = $request->get('pk_price1');
        $subscribers->pk_price2 = $request->get('pk_price2');
        $subscribers->pk_price3 = $request->get('pk_price3');
        $subscribers->pk_price4 = $request->get('pk_price4');
        $subscribers->bd_price1 = $request->get('bd_price1');
        $subscribers->bd_price2 = $request->get('bd_price2');
        $subscribers->bd_price3 = $request->get('bd_price3');
        $subscribers->bd_price4 = $request->get('bd_price4');
        $subscribers->at_price1 = $request->get('at_price1');
        $subscribers->at_price2 = $request->get('at_price2');
        $subscribers->at_price3 = $request->get('at_price3');
        $subscribers->at_price4 = $request->get('at_price4');
        $changes = $subscribers->getDirty();
        $subscribers->update();

        $data = json_encode($changes, true);
        $employee = Session::get('subscribers');
        if (isset($employee->subscriberId)) {
            $notify = new Pricenotify();
            $notify->datas = $data;
            $notify->modifiedId = session('subscribers')['id'];
            $notify->save();
        } else {
            $notify = new Pricenotify();
            $notify->datas = $data;
            $notify->modifiedId = session('subscribers')['subscriber_id'];
            $notify->save();
        }

        // Upadting in price table
        foreach ($zipcode as $zip) {
            $getZip = Pincode::find($zip);
            $zipcode = $getZip->pincode;
            //Bike taxi

            $bt1 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('bt_price1') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =1 and range_from=0 and range_to=5 '));

            $bt2 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('bt_price2') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =1 and range_from=5 and range_to=8 '));
            $bt3 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('bt_price3') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =1 and range_from=8 and range_to=10 '));
            $bt4 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('bt_price4') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =1 and range_from=10 and range_to=50 '));

            //PickUp
            $pk1 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('pk_price1') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =2 and range_from=0 and range_to=5 '));
            $pk2 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('pk_price2') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =2 and range_from=5 and range_to=8 '));
            $pk3 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('pk_price3') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =2 and range_from=8 and range_to=10 '));
            $pk4 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('pk_price4') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =2 and range_from=10 and range_to=50 '));
            //Drop and delivery

            $bd1 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('bd_price1') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =3 and range_from=0 and range_to=5 '));
            $bd2 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('bd_price2') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =3 and range_from=5 and range_to=8 '));
            $bd3 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('bd_price3') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =3 and range_from=8 and range_to=10 '));
            $bd4 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('bd_price4') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =3 and range_from=10 and range_to=50 '));

            //auto
            //$at1 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('at_price1') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =4 and range_from=0 and range_to=5 '));
            //$at2 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('at_price2') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =4 and range_from=5 and range_to=8 '));
            //$at3 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('at_price3') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =4 and range_from=8 and range_to=10 '));
            //$at4 = DB::statement(DB::raw('update  `price` SET amount=' . $request->get('at_price4') . ' where subscriber_id=' . $subid . ' and pincode = ' . $zipcode . ' and category =4 and range_from=10 and range_to=50 '));
            $data = [
                ['range_from' => 0, 'range_to' => 5, 'amount' => $request->get('at_price1')],
                ['range_from' => 5, 'range_to' => 8, 'amount' => $request->get('at_price2')],
                ['range_from' => 8, 'range_to' => 10, 'amount' => $request->get('at_price3')],
                ['range_from' => 10, 'range_to' => 50, 'amount' => $request->get('at_price4')]
            ];

            foreach ($data as $item) {
                DB::table('price')->updateOrInsert(
                    [
                        'subscriber_id' => $subid,
                        'pincode' => $zipcode,
                        'category' => 4,
                        'range_from' => $item['range_from'],
                        'range_to' => $item['range_to']
                    ],
                    ['amount' => $item['amount']]
                );
            }
        }

        $subscriber = Subscriber::where(['id' => $request->id])->first();
        // $request->session()->forget('subscribers');

        // Session::put('subscribers', $subscriber);

        return redirect('subscribers/price')->with('success', 'Price Updated!');
    }
    public function driverblock(Request $request, $id)
    {
        // return 1;
        // $userid=0;
        // dd($request);
        $driver = Driver::findorFail($id);
        // if($driver->userid!="")
        $userid = $driver->userid;

        $driver->status = '2';

        $driver->update();

        if ($userid != null) {
            $user = User::findorFail($userid);
            $user->is_live = '2';
            $user->update();
        }
        $user = Session::get('subscribers');
        if (isset($user->subscriberId)) {
            $block = new SubBlock();
            $block->table = 'driver';
            $block->blockedId = $id;
            $block->blockedBy = session('subscribers')['id'];
            $block->comments = $request->get('reason');
            $block->save();
            // return 1;
            return redirect('subscribers/driver')->with('success', 'Driver blocked ');
        } else {
            $block = new Blocklist();
            $block->table = 'driver';
            $block->blockedId = $id;
            $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
            $block->blockedBy = $subscriber->id;
            $block->comments = $request->get('reason');
            $block->save();
            // return 1;
            return redirect('subscribers/driver')->with('success', 'Driver blocked ');
        }
    }
    public function driverunblock(Request $request)
    {
        $driverid = $request->get('sub_id');
        $Reason = $request->get('comments');
        $driver = Driver::findorFail($driverid);
        $userid = $driver->userid;
        $driver->status = 1;
        $driver->update();
        if ($userid != null) {
            $user = User::findorFail($userid);
            $user->is_live = '1';
            $user->update();
        }
        $employee = Session::get('subscribers');
        if (isset($employee->subscriberId)) {
            $unblock = new SubUnblock();
            $unblock->table = 'driver';
            $unblock->unblockedId = $driverid;
            $unblock->unblockedBy = session('subscribers')['id'];
            $unblock->comments = $request->get('comments');
            $unblock->save();
            return redirect('subscribers/driver')->with('success', 'Driver unblocked ');
        } else {
            $unblock = new SubUnblock();
            $unblock->table = 'driver';
            $unblock->unblockedId = $driverid;
            $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
            $unblock->unblockedBy = $subscriber->id;
            $unblock->comments = $request->get('comments');
            $unblock->save();
            return redirect('subscribers/driver')->with('success', 'Driver unblocked ');
        }
    }
}
