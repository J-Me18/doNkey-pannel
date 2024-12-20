<?php

namespace App\Http\Controllers;

use App\Exports\SubscriberReportExport;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Pincode;
use App\Models\Subscriber;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class SubscriberReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::when(request('from_date'), function ($query, $fromDate) {
            $query->where(function ($query) use ($fromDate) {
                $query->whereDate('created_at', '>=', $fromDate);
            });
        })
            ->when(request('to_date'), function ($query, $toDate) {
                $query->where(function ($query) use ($toDate) {
                    $query->whereDate('created_at', '<=', $toDate);
                });
            })
            ->latest()->with(['driver', 'pincode'])->get();
        $id = $subscribers->pluck('created_by');
         //dd($id);
        $role = Role::whereIn('id', $id)->get();
        //dd($role);
        $empolyee_id = Admin::whereIn('id', $id)->get();
        $emp_id = $empolyee_id->pluck('emp_id');
        // dd($emp_id);
        //$roleName = $role[0]->name;
        // dd($roleName);
        // dd($subscribers);
        $pincode = Pincode::all();
        return view('admin.subscriber_report.index', ['subscribers' => $subscribers, 'pincode' => $pincode, 'roleName' => $emp_id]);
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
         //dd($subscriber);
           $types=[
            '0'=>'0',
            '1'=> '1',
            '2'=>'2'
        ];
       $pinnumber = json_decode($subscriber->pincode);
        //dd($pinnumber);
        $users = User::select('id', 'user_id')->get();
        $pincodes = Pincode::whereIn('id', $pinnumber)->get();
        $drivers = $subscriber->driver;
        $driverIds = $drivers->pluck('userid')->all();
        //dd($driverIds);
        $bookings = Booking::when(request('from_date'), function ($query, $fromDate) {
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
            ->whereIn('accepted', $driverIds)
            //->where('status', 3)
            ->with('bookingPayment','driver','user','driverasuser');
            if($request->type != ''){
              $bookings = $bookings->whereRelation('bookingPayment','type', '=', $request->type);
            }
            
            $bookings = $bookings->latest()->get();
            
        $statuses = [
            '0' => '0',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4'
        ];
//dd($bookings);
        return view('admin.subscriber_report.show', [
            'subscriber' => $subscriber->load('driver'),
            'pincodes' => $pincodes,
            'bookings' => $bookings->load('bookingPayment','driver','driverasuser'),
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

    public function downloadexcel(Subscriber $subscriber)
    {
        // dd($subscriber);
       $pinnumber = json_decode($subscriber->pincode);
        //dd($pinnumber);
        $users = User::select('id', 'user_id')->get();
        $pincodes = Pincode::whereIn('id', $pinnumber)->get();
        $drivers = $subscriber->driver;
        $driverIds = $drivers->pluck('userid')->all();
        //dd($driverIds);
        $bookings = Booking::when(request('from_date'), function ($query, $fromDate) {
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
            ->whereIn('accepted', $driverIds)
            //->where('status', 3)
            ->with('bookingPayment','driver','user','driverasuser')
            ->get();  
        $exportData = [
            'subscriber' => $subscriber->load('driver'),
            'pincodes' => $pincodes,
            'bookings' => $bookings->load('bookingPayment'),
            'users' => $users
        ];
        return Excel::download(new SubscriberReportExport($exportData), $subscriber->name . " " . 'Report.xlsx');
    }

    public function downloadPDF(Subscriber $subscriber)
    {
       $pinnumber = json_decode($subscriber->pincode);
        //dd($pinnumber);
        $users = User::select('id', 'user_id')->get();
        $pincodes = Pincode::whereIn('id', $pinnumber)->get();
        $drivers = $subscriber->driver;
        $driverIds = $drivers->pluck('userid')->all();
        //dd($driverIds);
        $bookings = Booking::when(request('from_date'), function ($query, $fromDate) {
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
            ->whereIn('accepted', $driverIds)
            //->where('status', 3)
            ->with('bookingPayment','driver','user','driverasuser')
            ->get();
       
        $view = view('admin.subscriber_report.pdf', [
            'subscriber' => $subscriber->load('driver'),
            'pincodes' => $pincodes,
            'bookings' => $bookings->load('bookingPayment'),
            'users' => $users
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
