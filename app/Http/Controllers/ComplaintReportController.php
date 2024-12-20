<?php

namespace App\Http\Controllers;

use App\Exports\ComplaintReportExport;
use App\Models\Admin;
use App\Models\Complaints;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ComplaintReportController extends Controller
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        // dd($admin);
        $complaints = Complaints::where(function ($query) use ($admin) {
            $query->where('status', 'Done')
                ->where('complained_id', $admin->id)
                ->orWhere('solved_id', $admin->id);
        })
            ->when(request('from_date'), function ($query, $fromDate) {
                $query->where(function ($query) use ($fromDate) {
                    $query->whereDate('created_at', '>=', $fromDate);
                    $query->orWhereDate('updated_at', '>=', $fromDate);
                });
            })
            ->when(request('to_date'), function ($query, $toDate) {
                $query->where(function ($query) use ($toDate) {
                    $query->whereDate('created_at', '<=', $toDate);
                    $query->orWhereDate('updated_at', '<=', $toDate);
                });
            })
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('complained_by', 'LIKE', "$search%");
                    $query->orWhere('solved_by', 'LIKE', "$search%");
                });
            })
            ->latest()
            ->get();

        // dd($complaints);
        return view('admin.complaint_report.show', ['admin' => $admin, 'complaints' => $complaints]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function downloadExcel(Admin $admin)
    {

        $complaints = Complaints::where(function ($query) use ($admin) {
            $query->where('status', 'Done')
                ->where('complained_id', $admin->id)
                ->orWhere('solved_id', $admin->id);
        })
            ->when(request('from_date'), function ($query, $fromDate) {
                $query->where(function ($query) use ($fromDate) {
                    $query->whereDate('created_at', '>=', $fromDate);
                    $query->orWhereDate('updated_at', '>=', $fromDate);
                });
            })
            ->when(request('to_date'), function ($query, $toDate) {
                $query->where(function ($query) use ($toDate) {
                    $query->whereDate('created_at', '<=', $toDate);
                    $query->orWhereDate('updated_at', '<=', $toDate);
                });
            })
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('complained_by', 'LIKE', "$search%");
                    $query->orWhere('solved_by', 'LIKE', "$search%");
                });
            })
            ->latest()
            ->get();


        $exportData = [
            'admin' => $admin,
            'complaints' => $complaints
        ];

        return Excel::download(new ComplaintReportExport($exportData), $admin->name . 'Complaint_Report.xlsx');
    }

    public function downloadPDF(Admin $admin)
    {
        $complaints = Complaints::where(function ($query) use ($admin) {
            $query->where('status', 'Done')
                ->where('complained_id', $admin->id)
                ->orWhere('solved_id', $admin->id);
        })
            ->when(request('from_date'), function ($query, $fromDate) {
                $query->where(function ($query) use ($fromDate) {
                    $query->whereDate('created_at', '>=', $fromDate);
                    $query->orWhereDate('updated_at', '>=', $fromDate);
                });
            })
            ->when(request('to_date'), function ($query, $toDate) {
                $query->where(function ($query) use ($toDate) {
                    $query->whereDate('created_at', '<=', $toDate);
                    $query->orWhereDate('updated_at', '<=', $toDate);
                });
            })
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('complained_by', 'LIKE', "$search%");
                    $query->orWhere('solved_by', 'LIKE', "$search%");
                });
            })
            ->latest()
            ->get();


        $view = view('admin.complaint_report.pdf', ['admin' => $admin,'complaints'=>$complaints]);
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
