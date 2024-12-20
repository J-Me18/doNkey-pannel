<?php

namespace App\Http\Controllers;

use App\Exports\BookingReportExport;
use App\Models\Booking;
use App\Models\BookingLocation;
use App\Models\BookingLocationMapping;
use App\Models\BookingPayment;
use App\Models\Pincode;
use App\Models\Subscriber;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Maatwebsite\Excel\Facades\Excel;

class SubscriberBookingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     $types=[
            '0'=>'0',
            '1'=> '1',
            '2'=>'2'
        ];
        $pin = json_decode(session('subscribers')['pincode']);
        // dd($pin);
        if (isset($pin)) {
            $pincodeCollection = Pincode::whereIn('id', $pin)->get();
            //dd($pincodeCollection);
            $pincodeArray = [];
            foreach ($pincodeCollection as $pincodeObject) {
                $pincodeArray[] = $pincodeObject->pincode;
            }
             //dd($pincodeArray);
            $bookings = Booking::whereIn('pincode', $pincodeArray)
                ->when(request('from_date'), function ($query, $fromDate) {
                    $query->where(function ($query) use ($fromDate) {
                        $query->whereDate('created_at', '>=', $fromDate);
                    });
                })
                ->when(request('to_date'), function ($query, $toDate) {
                    $query->where(function ($query) use ($toDate) {
                        $query->whereDate('created_at', '<=', $toDate);
                    });
                })
              ->when(request('status') !== null, function ($query) {
    $status = request('status');
    $validStatuses = ['0', '1', '2', '3', '4']; // Valid status codes
    if (in_array($status, $validStatuses)) {
        $query->where('status', '=', $status);
    }
})
                ->when(request('search'), function ($query, $search) {
                    //  dd(request('search'));
                    $query->where(function ($query) use ($search) {
                        $query->where('pincode', 'LIKE', "$search%");
                        $query->orWhere('booking_id', 'LIKE', "$search%");
                        $query->orWhereRelation('user', 'name', 'LIKE', "$search%");
                        $query->orWhereRelation('driverasuser', 'user_id', 'LIKE', "$search%");
                    });
                })
                ->with(['user', 'bookingPayment', 'pincode', 'driverasuser']);
                if($request->type != ''){
            $bookings = $bookings->whereRelation('bookingPayment','type', '=', $request->type);
            
            }
            
            $bookings = $bookings->latest()->get();
               // dd($bookings);
              
        } else {
         $types=[
            '0'=>'0',
            '1'=> '1',
            '2'=>'2'
        ];
            $user = FacadesSession::get('subscribers');
            $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
            $pin = json_decode($subscriber->pincode);
            // dd($pin);
            $pincodeCollection = Pincode::whereIn('id', $pin)->get();
            $pincodeArray = [];
            foreach ($pincodeCollection as $pincodeObject) {
                $pincodeArray[] = $pincodeObject->pincode;
            }
            // dd($pincodeArray);
            $bookings = Booking::whereIn('pincode', $pincodeArray)
                ->when(request('from_date'), function ($query, $fromDate) {
                    $query->where(function ($query) use ($fromDate) {
                        $query->whereDate('created_at', '>=', $fromDate);
                    });
                })
                ->when(request('to_date'), function ($query, $toDate) {
                    $query->where(function ($query) use ($toDate) {
                        $query->whereDate('created_at', '<=', $toDate);
                    });
                })
              ->when(request('status') !== null, function ($query) {
    $status = request('status');
    $validStatuses = ['0', '1', '2', '3', '4']; // Valid status codes
    if (in_array($status, $validStatuses)) {
        $query->where('status', '=', $status);
    }
})
                ->when(request('search'), function ($query, $search) {
                // dd(request('search'));
                    $query->where(function ($query) use ($search) {
                        $query->where('pincode', 'LIKE', "$search%");
                        $query->orWhere('booking_id', 'LIKE', "$search%");
                        $query->orWhereRelation('user', 'name', 'LIKE', "$search%");
                        $query->orWhereRelation('driverasuser', 'user_id', 'LIKE', "$search%");
                    });
                })
                ->with(['user', 'bookingPayment', 'pincode','driverasuser']);
                if($request->type != ''){
            $bookings = $bookings->whereRelation('bookingPayment','type', '=', $request->type);
            }
           
            
            $bookings = $bookings->latest()->get();
               // dd($bookings);
                
        }

        $statuses = [
            '0' => '0',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4'
        ];
        // Return the view with the bookings data
        return view('subscriber.booking_report.index', ['bookings' => $bookings, 'statuses' => $statuses, 'types'=>$types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $bookingReport)
    {
        //dd($bookingReport);
        $driver = User::where('id', $bookingReport->accepted)->first();
        $customer = User::where('user_id', $bookingReport->customer_id)->first();
        $location = BookingLocationMapping::where('booking_id', $bookingReport->booking_id)->get();
       if (!$location->isEmpty()) {
            // Retrieve start and end locations based on location_id
            $start_location = BookingLocation::where('location_id', $location[0]->start_location_id)->first();
            $end_location = BookingLocation::where('location_id', $location[0]->end_location_id)->first();

        } else {            
               
                $start_location = null; // or any default value
                $end_location = null; // or any default value           
        }

        $payment = BookingPayment::where('booking_id', $bookingReport?->booking_id)?->first();
        return view('subscriber.booking_report.show', [
            'booking' => $bookingReport,
            'driver' => $driver,
            'customer' => $customer,
            'start_location' => $start_location,
            'end_location' => $end_location,
            'payment' => $payment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }


   public function downloadexcel(Request $request)
{
    // Fetch the status value from the request
    $status = $request->input('status');

    $pin = json_decode(session('subscribers')['pincode']);
        // dd($pin);
        if (isset($pin)) {
            $pincodeCollection = Pincode::whereIn('id', $pin)->get();
            //dd($pincodeCollection);
            $pincodeArray = [];
            foreach ($pincodeCollection as $pincodeObject) {
                $pincodeArray[] = $pincodeObject->pincode;
            }
             //dd($pincodeArray);
            $bookings = Booking::whereIn('pincode', $pincodeArray)
                ->when(request('from_date'), function ($query, $fromDate) {
                    $query->where(function ($query) use ($fromDate) {
                        $query->whereDate('created_at', '>=', $fromDate);
                    });
                })
                ->when(request('to_date'), function ($query, $toDate) {
                    $query->where(function ($query) use ($toDate) {
                        $query->whereDate('created_at', '<=', $toDate);
                    });
                })
              ->when(request('status') !== null, function ($query) {
    $status = request('status');
    $validStatuses = ['0', '1', '2', '3', '4']; // Valid status codes
    if (in_array($status, $validStatuses)) {
        $query->where('status', '=', $status);
    }
})
                ->when(request('search'), function ($query, $search) {
                    //  dd(request('search'));
                    $query->where(function ($query) use ($search) {
                        $query->where('pincode', 'LIKE', "$search%");
                        $query->orWhere('booking_id', 'LIKE', "$search%");
                        $query->orWhereRelation('user', 'name', 'LIKE', "$search%");
                        $query->orWhereRelation('driverasuser', 'user_id', 'LIKE', "$search%");
                    });
                })
                ->with(['user', 'bookingPayment', 'pincode', 'driverasuser']);
                if($request->type != ''){
            $bookings = $bookings->whereRelation('bookingPayment','type', '=', $request->type);
            
            }
            
            $bookings = $bookings->latest()->get();
               // dd($bookings);
              
        } else {
         $types=[
            '0'=>'0',
            '1'=> '1',
            '2'=>'2'
        ];
            $user = FacadesSession::get('subscribers');
            $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
            $pin = json_decode($subscriber->pincode);
            // dd($pin);
            $pincodeCollection = Pincode::whereIn('id', $pin)->get();
            $pincodeArray = [];
            foreach ($pincodeCollection as $pincodeObject) {
                $pincodeArray[] = $pincodeObject->pincode;
            }
            // dd($pincodeArray);
            $bookings = Booking::whereIn('pincode', $pincodeArray)
                ->when(request('from_date'), function ($query, $fromDate) {
                    $query->where(function ($query) use ($fromDate) {
                        $query->whereDate('created_at', '>=', $fromDate);
                    });
                })
                ->when(request('to_date'), function ($query, $toDate) {
                    $query->where(function ($query) use ($toDate) {
                        $query->whereDate('created_at', '<=', $toDate);
                    });
                })
              ->when(request('status') !== null, function ($query) {
    $status = request('status');
    $validStatuses = ['0', '1', '2', '3', '4']; // Valid status codes
    if (in_array($status, $validStatuses)) {
        $query->where('status', '=', $status);
    }
})
                ->when(request('search'), function ($query, $search) {
                // dd(request('search'));
                    $query->where(function ($query) use ($search) {
                        $query->where('pincode', 'LIKE', "$search%");
                        $query->orWhere('booking_id', 'LIKE', "$search%");
                        $query->orWhereRelation('user', 'name', 'LIKE', "$search%");
                        $query->orWhereRelation('driverasuser', 'user_id', 'LIKE', "$search%");
                    });
                })
                ->with(['user', 'bookingPayment', 'pincode','driverasuser']);
                if($request->type != ''){
            $bookings = $bookings->whereRelation('bookingPayment','type', '=', $request->type);
            }
           
            
            $bookings = $bookings->latest()->get();
               // dd($bookings);
                
        }

    return Excel::download(new BookingReportExport($bookings), 'Booking_Report.xlsx');
}

    public function downloadPDF(Request $request)
    {
      $status = $request->input('status');
         $pin = json_decode(session('subscribers')['pincode']);
        // dd($pin);
        if (isset($pin)) {
            $pincodeCollection = Pincode::whereIn('id', $pin)->get();
            //dd($pincodeCollection);
            $pincodeArray = [];
            foreach ($pincodeCollection as $pincodeObject) {
                $pincodeArray[] = $pincodeObject->pincode;
            }
             //dd($pincodeArray);
            $bookings = Booking::whereIn('pincode', $pincodeArray)
                ->when(request('from_date'), function ($query, $fromDate) {
                    $query->where(function ($query) use ($fromDate) {
                        $query->whereDate('created_at', '>=', $fromDate);
                    });
                })
                ->when(request('to_date'), function ($query, $toDate) {
                    $query->where(function ($query) use ($toDate) {
                        $query->whereDate('created_at', '<=', $toDate);
                    });
                })
              ->when(request('status') !== null, function ($query) {
    $status = request('status');
    $validStatuses = ['0', '1', '2', '3', '4']; // Valid status codes
    if (in_array($status, $validStatuses)) {
        $query->where('status', '=', $status);
    }
})
                ->when(request('search'), function ($query, $search) {
                    //  dd(request('search'));
                    $query->where(function ($query) use ($search) {
                        $query->where('pincode', 'LIKE', "$search%");
                        $query->orWhere('booking_id', 'LIKE', "$search%");
                        $query->orWhereRelation('user', 'name', 'LIKE', "$search%");
                        $query->orWhereRelation('driverasuser', 'user_id', 'LIKE', "$search%");
                    });
                })
                ->with(['user', 'bookingPayment', 'pincode', 'driverasuser']);
                if($request->type != ''){
            $bookings = $bookings->whereRelation('bookingPayment','type', '=', $request->type);
            
            }
            
            $bookings = $bookings->latest()->get();
               // dd($bookings);
              
        } else {
         $types=[
            '0'=>'0',
            '1'=> '1',
            '2'=>'2'
        ];
            $user = FacadesSession::get('subscribers');
            $subscriber = Subscriber::where('id', $user->subscriber_id)->first();
            $pin = json_decode($subscriber->pincode);
            // dd($pin);
            $pincodeCollection = Pincode::whereIn('id', $pin)->get();
            $pincodeArray = [];
            foreach ($pincodeCollection as $pincodeObject) {
                $pincodeArray[] = $pincodeObject->pincode;
            }
            // dd($pincodeArray);
            $bookings = Booking::whereIn('pincode', $pincodeArray)
                ->when(request('from_date'), function ($query, $fromDate) {
                    $query->where(function ($query) use ($fromDate) {
                        $query->whereDate('created_at', '>=', $fromDate);
                    });
                })
                ->when(request('to_date'), function ($query, $toDate) {
                    $query->where(function ($query) use ($toDate) {
                        $query->whereDate('created_at', '<=', $toDate);
                    });
                })
              ->when(request('status') !== null, function ($query) {
    $status = request('status');
    $validStatuses = ['0', '1', '2', '3', '4']; // Valid status codes
    if (in_array($status, $validStatuses)) {
        $query->where('status', '=', $status);
    }
})
                ->when(request('search'), function ($query, $search) {
                // dd(request('search'));
                    $query->where(function ($query) use ($search) {
                        $query->where('pincode', 'LIKE', "$search%");
                        $query->orWhere('booking_id', 'LIKE', "$search%");
                        $query->orWhereRelation('user', 'name', 'LIKE', "$search%");
                        $query->orWhereRelation('driverasuser', 'user_id', 'LIKE', "$search%");
                    });
                })
                ->with(['user', 'bookingPayment', 'pincode','driverasuser']);
                if($request->type != ''){
            $bookings = $bookings->whereRelation('bookingPayment','type', '=', $request->type);
            }
           
            
            $bookings = $bookings->latest()->get();
               // dd($bookings);
                
        }


        $view = view('admin.booking_report.pdf', ['bookings' => $bookings]);
        $html = $view->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="booking_report.pdf"');
    }

    public function driverBookingReport(Subscriber $subscriber)
    {
    }
}
