<?php

namespace App\Http\Controllers;

use App\Exports\EmployeePerformanceExport;
use App\Models\Admin;
use App\Models\Subscriber;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeePerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Admin::with('roles')
            ->latest()->get();
        return view('admin.performance.index', ['employees' => $employees]);
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
        $subscribers = Subscriber::where('created_by', $admin->id)
            ->when(request('from_date'), function ($query, $from_date) {
                $query->where(function ($query) use ($from_date) {
                    $query->whereDate('created_at', '>=', $from_date);
                    //$query->orWhereDate('subscriptionDate', '>=', $from_date);
                    //$query->orWhereDate('expiryDate', '>=', $from_date);
                });
            })
            ->when(request('to_date'), function ($query, $to_date) {
                $query->where(function ($query) use ($to_date) {
                    $query->whereDate('created_at', '<=', $to_date);
                    //$query->orWhereDate('subscriptionDate', '<=', $to_date);
                    //$query->orWhereDate('expiryDate', '<=', $to_date);
                });
            })
            ->latest()
            ->get();
        return view('admin.performance.show', ['employee' => $admin, 'subscribers' => $subscribers]);
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


    public function downloadExcel(Admin $employee)
    {
        $id = $employee->emp_id;
        // dd($employee);
        //$employee = Subscriber::where('created_by', $employee->id)->get();
       $employee = Subscriber::where('created_by', $employee->id)
            ->when(request('from_date'), function ($query, $from_date) {
                $query->where(function ($query) use ($from_date) {
                    $query->whereDate('created_at', '>=', $from_date);
                    //$query->orWhereDate('subscriptionDate', '>=', $from_date);
                    //$query->orWhereDate('expiryDate', '>=', $from_date);
                });
            })
            ->when(request('to_date'), function ($query, $to_date) {
                $query->where(function ($query) use ($to_date) {
                    $query->whereDate('created_at', '<=', $to_date);
                    //$query->orWhereDate('subscriptionDate', '<=', $to_date);
                    //$query->orWhereDate('expiryDate', '<=', $to_date);
                });
            })
            ->latest()
            ->get();
        // dd($employee);
        return Excel::download(new EmployeePerformanceExport($employee), $id . 'Performance.xlsx');
    }

    public function downloadPdf(Admin $employee)
    {
        $employee = Subscriber::where('created_by', $employee->id)
            ->when(request('from_date'), function ($query, $from_date) {
                $query->where(function ($query) use ($from_date) {
                    $query->whereDate('created_at', '>=', $from_date);
                    //$query->orWhereDate('subscriptionDate', '>=', $from_date);
                    //$query->orWhereDate('expiryDate', '>=', $from_date);
                });
            })
            ->when(request('to_date'), function ($query, $to_date) {
                $query->where(function ($query) use ($to_date) {
                    $query->whereDate('created_at', '<=', $to_date);
                    //$query->orWhereDate('subscriptionDate', '<=', $to_date);
                    //$query->orWhereDate('expiryDate', '<=', $to_date);
                });
            })
            ->latest()
            ->get();
        $view = view('admin.performance.pdf', ['employee' => $employee]);
        $html = $view->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="employee_performance.pdf"');
    }
}
