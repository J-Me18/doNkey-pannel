<?php

namespace App\Http\Controllers;

use App\Exports\DriverReportExport;
use App\Http\Controllers\API\Booking;
use App\Models\Booking as ModelsBooking;
use App\Models\Pincode;
use App\Models\Subscriber;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DriverBookingReport extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber, Request $request)
    {
     $types=[
            '0'=>'0',
            '1'=> '1',
            '2'=>'2'
        ];
        $pinnumber = json_decode($subscriber->pincode);
        //dd($pinnumber);
        $users = User::select('id', 'user_id')->get();
        $pincodes = Pincode::whereIn('id', $pinnumber)->get();
         //dd($pincodes);
        $drivers = $subscriber->driver;
        $driverIds = $drivers->pluck('userid')->all();
         //dd($driverIds);
        $statuses = [
            '0' => '0',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4'
        ];
        $bookings = ModelsBooking::when(request('from_date'), function ($query, $fromDate) {
            $query->where(function ($innerQuery) use ($fromDate) {
                $formattedFromDate = date('Y-m-d', strtotime($fromDate));
                $innerQuery->whereDate('updated_at', '>=', $formattedFromDate);
            });
        })
            ->when(request('to_date'), function ($query, $toDate) {
                $query->where(function ($innerQuery) use ($toDate) {
                    $formattedToDate = date('Y-m-d', strtotime($toDate));
                    $innerQuery->whereDate('updated_at', '<=', $formattedToDate);
                });
            })    
             ->when(request('type'), function ($query, $type) {
                // dd(request('type'));
                $query->where(function ($query) use ($type) {
                    $query->whereRelation('bookingPayment','type', '=', $type);
                });
            })       
            ->when(request('status'), function ($query, $status) {
                $query->where(function ($query) use ($status) {
                    $query->where('status', '=', $status);
                });
            })
            ->whereIn('accepted', $driverIds)
           ->when(request('search'), function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('pincode', 'LIKE', "$search%");
                    $query->orWhere('booking_id', 'LIKE', "$search%");
                    $query->orWhereRelation('user', 'name', 'LIKE', "$search%");
                    $query->orWhereRelation('driverasuser', 'user_id', 'LIKE', "$search%");
                    $query->orWhereRelation('driverasuser', 'phone', 'LIKE', "$search%");
                    $query->orWhereRelation('driverasuser', 'name', 'LIKE', "$search%");
                });
            })
            ->with('bookingPayment', 'driver', 'user', 'driverasuser');
            if($request->type != ''){
            $bookings = $bookings->whereRelation('bookingPayment','type', '=', $request->type);
            }
            
            $bookings = $bookings->latest()->get();
           
//dd($bookings);
        return view('subscriber.driver_report.driverReport', [
            'subscriber' => $subscriber->load('driver'),
            'pincodes' => $pincodes,
            'bookings' => $bookings->load('bookingPayment'),
            'users' => $users,
            'statuses' => $statuses,
            'types'=>$types
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        //
    }

    public function downloadExcel(Subscriber $driver)
    {
    $subscriber = $driver;
        $pinnumber = json_decode($subscriber->pincode);
        //dd($pinnumber);
        $users = User::select('id', 'user_id')->get();
        $pincodes = Pincode::whereIn('id', $pinnumber)->get();
         //dd($pincodes);
        $drivers = $subscriber->driver;
        $driverIds = $drivers->pluck('userid')->all();
         //dd($driverIds);
        $statuses = [
            '0' => '0',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4'
        ];
        $bookings = ModelsBooking::when(request('from_date'), function ($query, $fromDate) {
            $query->where(function ($innerQuery) use ($fromDate) {
                $formattedFromDate = date('Y-m-d', strtotime($fromDate));
                $innerQuery->whereDate('updated_at', '>=', $formattedFromDate);
            });
        })
            ->when(request('to_date'), function ($query, $toDate) {
                $query->where(function ($innerQuery) use ($toDate) {
                    $formattedToDate = date('Y-m-d', strtotime($toDate));
                    $innerQuery->whereDate('updated_at', '<=', $formattedToDate);
                });
            })           
            ->when(request('status'), function ($query, $status) {
                $query->where(function ($query) use ($status) {
                    $query->where('status', '=', $status);
                });
            })
            ->whereIn('accepted', $driverIds)
           ->when(request('search'), function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('pincode', 'LIKE', "$search%");
                    $query->orWhere('booking_id', 'LIKE', "$search%");
                    $query->orWhereRelation('user', 'name', 'LIKE', "$search%");
                    $query->orWhereRelation('driverasuser', 'user_id', 'LIKE', "$search%");
                    $query->orWhereRelation('driverasuser', 'phone', 'LIKE', "$search%");
                    $query->orWhereRelation('driverasuser', 'name', 'LIKE', "$search%");
                });
            })
            ->with('bookingPayment', 'driver', 'user', 'driverasuser')
            ->get();
        $exportData = [
            'subscriber' => $driver->load('driver'),
            'pincodes' => $pincodes,
            'bookings' => $bookings->load('bookingPayment'),
            'users' => $users,
            'statuses' => $statuses
        ];        
        return Excel::download(new DriverReportExport($exportData), 'Subscriber Based Driver Report.xlsx');
    }

    public function downloadPDF(Subscriber $driver)
    {
    $subscriber = $driver;
        $pinnumber = json_decode($driver->pincode);
        //dd($pinnumber);
        $users = User::select('id', 'user_id')->get();
        $pincodes = Pincode::whereIn('id', $pinnumber)->get();
         //dd($pincodes);
        $drivers = $subscriber->driver;
        $driverIds = $drivers->pluck('userid')->all();
         //dd($driverIds);
        $statuses = [
            '0' => '0',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4'
        ];
        $bookings = ModelsBooking::when(request('from_date'), function ($query, $fromDate) {
            $query->where(function ($innerQuery) use ($fromDate) {
                $formattedFromDate = date('Y-m-d', strtotime($fromDate));
                $innerQuery->whereDate('updated_at', '>=', $formattedFromDate);
            });
        })
            ->when(request('to_date'), function ($query, $toDate) {
                $query->where(function ($innerQuery) use ($toDate) {
                    $formattedToDate = date('Y-m-d', strtotime($toDate));
                    $innerQuery->whereDate('updated_at', '<=', $formattedToDate);
                });
            })           
            ->when(request('status'), function ($query, $status) {
                $query->where(function ($query) use ($status) {
                    $query->where('status', '=', $status);
                });
            })
            ->whereIn('accepted', $driverIds)
           ->when(request('search'), function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('pincode', 'LIKE', "$search%");
                    $query->orWhere('booking_id', 'LIKE', "$search%");
                    $query->orWhereRelation('user', 'name', 'LIKE', "$search%");
                    $query->orWhereRelation('driverasuser', 'user_id', 'LIKE', "$search%");
                    $query->orWhereRelation('driverasuser', 'phone', 'LIKE', "$search%");
                    $query->orWhereRelation('driverasuser', 'name', 'LIKE', "$search%");
                });
            })
            ->with('bookingPayment', 'driver', 'user', 'driverasuser')
            ->get();
        $view = view('subscriber.driver_report.pdf', [
            'subscriber' => $driver->load('driver'),
            'pincodes' => $pincodes,
            'bookings' => $bookings->load('bookingPayment'),
            'users' => $users,
            'statusValues' => $statuses
        ]);
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
