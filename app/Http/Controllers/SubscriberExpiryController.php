<?php

namespace App\Http\Controllers;

use App\Exports\SubscriberExpiryListExport;
use App\Models\Admin;
use App\Models\Pincode;
use App\Models\Subscriber;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class SubscriberExpiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $currentDate = Carbon::now();
        $expiredSubscribersAndWithinFiveDays = Subscriber::where(function ($query) use ($currentDate) {
            $query->whereDate('expiryDate', '<', $currentDate->copy()->addDays());
               
        })
            ->latest()
            ->get();
        $id = $expiredSubscribersAndWithinFiveDays->pluck('created_by');
        // dd($id);
        $empolyee_id = Admin::whereIn('id', $id)->get();
        $emp_id = $empolyee_id->pluck('emp_id');
        // dd($emp_id);
        $expiredSubscriberCount = $expiredSubscribersAndWithinFiveDays->count();
        // dd($expiredSubscriberCount);
        $pincode = Pincode::all();
        $id = $expiredSubscribersAndWithinFiveDays->pluck('created_by');
        $role = Role::whereIn('id', $id)->get();
       
        return view('admin.expired_subscriber.index', [
            'expiredSubscribers' => $expiredSubscribersAndWithinFiveDays,
            'pincode' => $pincode,
            'count' => $expiredSubscriberCount,
            'roleName' => $emp_id,
            'currentDate' => $currentDate,
            
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function downloadexcel()
    {
        // dd($subscriber);
        $currentDate = Carbon::now();
        $expiredSubscribersAndWithinFiveDays = Subscriber::where(function ($query) use ($currentDate) {
            $query->where('expiryDate', '<', $currentDate)
                ->orWhere('expiryDate', '>', $currentDate->copy()->subDays(5))
                ->where('expiryDate', '<', $currentDate);
        })
            ->latest()
            ->get();
        $id = $expiredSubscribersAndWithinFiveDays->pluck('created_by');
        // dd($id);
        $empolyee_id = Admin::whereIn('id', $id)->get();
        $emp_id = $empolyee_id->pluck('emp_id');
        //dd($expiredSubscribersAndWithinFiveDays);
        $pincode = Pincode::all();
        $exportData = [
            'expiredSubscribersAndWithinFiveDays' => $expiredSubscribersAndWithinFiveDays,
            'pincode' => $pincode,
            'id' => $emp_id
        ];
        return Excel::download(new SubscriberExpiryListExport($exportData), 'Subscriber_Expiry_Report.xlsx');
    }

    public function downloadPDF()
    {
        //dd($subscriber->load('driver'));
        $currentDate = Carbon::now();
        $expiredSubscribersAndWithinFiveDays = Subscriber::where(function ($query) use ($currentDate) {
            $query->where('expiryDate', '<', $currentDate)
                ->orWhere('expiryDate', '>', $currentDate->copy()->subDays(5))
                ->where('expiryDate', '<', $currentDate);
        })
            ->latest()
            ->get();
        $id = $expiredSubscribersAndWithinFiveDays->pluck('created_by');
        // dd($id);
        $empolyee_id = Admin::whereIn('id', $id)->get();
        $emp_id = $empolyee_id->pluck('emp_id');
        $pincode = Pincode::all();
        $view = view('admin.expired_subscriber.pdf', [
            'expiredSubscribers' => $expiredSubscribersAndWithinFiveDays,
            'pincode' => $pincode,
            'id' => $emp_id
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
    public function show(Subscriber $subscriber)
    {
        dd($subscriber);
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
}


