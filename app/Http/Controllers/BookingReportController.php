<?php

namespace App\Http\Controllers;

use App\Exports\BookingReportExport;
use App\Models\Booking;
use App\Models\BookingLocation;
use App\Models\BookingLocationMapping;
use App\Models\BookingPayment;
use App\Models\Driver;
use App\Models\Pincode;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf; // Add this line for the Dompdf class
use Illuminate\Contracts\View\View;

class BookingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

   public function index(Request $request)
    {
   
        $pincodes = Pincode::all();
        $statuses = [
            '0' => '0',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4'
        ];
         $types=[
            '0'=>'0',
            '1'=> '1',
            '2'=>'2'
        ];
        // dd($status);
        $bookings = Booking::when(request('from_date'), function ($query, $fromDate) {
            $query->where(function ($query) use ($fromDate) {
                $query->whereDate('created_at', '>=', $fromDate);
            });
        })
            ->when(request('to_date'), function ($query, $toDate) {
                $query->where(function ($query) use ($toDate) {
                    $query->whereDate('created_at', '<=', $toDate);
                });
            })
            ->when(request('pincode'), function ($query, $pincode) {
                //dd(request('pincode'));
                $query->where(function ($query) use ($pincode) {
                    $query->whereRelation('pincode', 'id', '=', $pincode);
                });
            })
            ->when(request('status'), function ($query, $status) {
                // dd(request('status'));
                $query->where(function ($query) use ($status) {
                    $query->where('status', '=', $status);
                });
            })
           // ->when(request('type'), function ($query, $type) {
           //      dd(request('type'));
            //    $query->where(function ($query) use ($type) {
             //       $query->whereRelation('bookingPayment','type', '=', $type);
             //   });
          //  })
            ->when(request('search'), function ($query, $search) {
                  //dd(request('search'));
                $query->where(function ($query) use ($search) {
                    $query->where('pincode', 'LIKE', "$search%")
                    ->orWhere('booking_id', 'LIKE', "$search%")
                    ->orWhereRelation('user', 'name', 'LIKE', "$search%")
                    ->orWhereRelation('driverasuser', 'user_id', 'LIKE', "%$search%");
                });
            })
             ->when(request('status') !== null, function ($query) {
    $status = request('status');
    $validStatuses = ['0', '1', '2', '3', '4']; // Valid status codes
    if (in_array($status, $validStatuses)) {
        $query->where('status', '=', $status);
    }
})

            ->with(['user', 'bookingPayment', 'pincode', 'driver', 'driverasuser']);
            if($request->type != ''){
            $bookings = $bookings->whereRelation('bookingPayment','type', '=', $request->type);
            }
            
            $bookings = $bookings->latest()->get();
           
          //  dd($bookings);
            // dd($bookings);
        return view('admin.booking_report.index', ['bookings' => $bookings, 'pincodes' => $pincodes, 'statuses' => $statuses,'types'=>$types]);
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
    public function show(Booking $booking)
    {
        // $Tbooking = Booking::where('booking_id','doc-00432ce6-91df-41da-a05e-93d9e99bab64')->with('bookingRating')->first();
        //  dd($booking->pincode);
        $accepted =  $booking?->accepted;
        //dd($accepted);
        $subscriberID = Driver::where('userid', $accepted)->select('subscriberId')->first();
        $subscriber = Subscriber::where('id', $subscriberID?->subscriberId)->select('subscriberId')->first();
        //dd($subscriber);
        $driver = User::where('id', $booking->accepted)->first();
        //dd($driver);
        $customer = User::where('user_id', $booking->customer_id)->first();
        $location = BookingLocationMapping::where('booking_id', $booking->booking_id)->get();
if ($location->isNotEmpty()) {
    $start_location = BookingLocation::where('location_id', $location[0]->start_location_id)->first();
    $end_location = BookingLocation::where('location_id', $location[0]->end_location_id)->first();
} else {
    // Handle the case where $location is empty or not found
    $start_location = null;
    $end_location = null;
}
        $payment = BookingPayment::where('booking_id', $booking?->booking_id)?->first();
        return view('admin.booking_report.view', [
            'booking' => $booking->load('bookingRating','driverasuser','driver'),
            'driver' => $driver,
            'customer' => $customer,
            'start_location' => $start_location,
            'end_location' => $end_location,
            'payment' => $payment,
            'subscriber' => $subscriber,
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

    public function downloadexcel()
    {
        $bookings = Booking::when(request('from_date'), function ($query, $fromDate) {
            $query->where(function ($query) use ($fromDate) {
                $query->whereDate('created_at', '>=', $fromDate);
            });
        })
        ->when(request('to_date'), function ($query, $toDate) {
            $query->where(function ($query) use ($toDate) {
                $query->whereDate('created_at', '<=', $toDate);
            });
        })
        ->when(request('pincode'), function ($query, $pincode) {
            $query->where(function ($query) use ($pincode) {
                $query->whereRelation('pincode', 'id', '=', $pincode);
            });
        })
        ->when(request('status'), function ($query, $status) {
            $query->where(function ($query) use ($status) {
                $query->where('status', '=', $status);
            });
        })
        ->when(request('search'), function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('pincode', 'LIKE', "$search%")
                    ->orWhere('booking_id', 'LIKE', "$search%")
                    ->orWhereRelation('user', 'name', 'LIKE', "$search%")
                    ->orWhereRelation('driverasuser', 'user_id', 'LIKE', "%$search%");
            });
        })
         ->when(request('status') !== null, function ($query) {
    $status = request('status');
    $validStatuses = ['0', '1', '2', '3', '4']; // Valid status codes
    if (in_array($status, $validStatuses)) {
        $query->where('status', '=', $status);
    }
})
        ->with(['user', 'bookingPayment'])
        ->latest()
        ->get();
    return Excel::download(new BookingReportExport($bookings), 'Booking_Report.xlsx');
    }

    public function downloadPDF()
    {
        $bookings = Booking::when(request('from_date'), function ($query, $fromDate) {
            $query->where(function ($query) use ($fromDate) {
                $query->whereDate('created_at', '>=', $fromDate);
            });
        })
        ->when(request('to_date'), function ($query, $toDate) {
            $query->where(function ($query) use ($toDate) {
                $query->whereDate('created_at', '<=', $toDate);
            });
        })
        ->when(request('pincode'), function ($query, $pincode) {
            $query->where(function ($query) use ($pincode) {
                $query->whereRelation('pincode', 'id', '=', $pincode);
            });
        })
        ->when(request('status'), function ($query, $status) {
            $query->where(function ($query) use ($status) {
                $query->where('status', '=', $status);
            });
        })
        ->when(request('search'), function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('pincode', 'LIKE', "$search%")
                    ->orWhere('booking_id', 'LIKE', "$search%")
                    ->orWhereRelation('user', 'name', 'LIKE', "$search%")
                    ->orWhereRelation('driverasuser', 'user_id', 'LIKE', "%$search%");
            });
        })
         ->when(request('status') !== null, function ($query) {
    $status = request('status');
    $validStatuses = ['0', '1', '2', '3', '4']; // Valid status codes
    if (in_array($status, $validStatuses)) {
        $query->where('status', '=', $status);
    }
})
        ->with(['user', 'bookingPayment'])
        ->latest()
        ->get();

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
}
