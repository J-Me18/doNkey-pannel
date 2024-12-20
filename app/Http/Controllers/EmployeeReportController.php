<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeReportExpert;
use App\Models\Admin;
use App\Models\Checking;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeeList = Admin::with('checking')
            ->latest()
            ->get();
        return view('admin.attendance.index', ['employeeList' => $employeeList]);
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
        $datewise = Checking::where('admin_id', $admin->id)
            ->when(request('from_date'), function ($query, $from_date) {
                $query->where(function ($query) use ($from_date) {
                    $query->whereDate('created_at', '>=', $from_date);
                });
            })
            ->when(request('to_date'), function ($query, $to_date) {
                $query->where(function ($query) use ($to_date) {
                    $query->whereDate('created_at', '<=', $to_date);
                });
            })
            ->latest()
            ->get();
        // dd($datewise);
        return view('admin.attendance.show', ['employee' => $admin, 'datewise' => $datewise]);
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
   $employeee = $employee; // Preserve the original employee instance
    $employee = Admin::where('id', $employee->id)
        ->with(['checking' => function ($query) {
            $query->when(request('from_date'), function ($subQuery, $from_date) {
                    $subQuery->whereDate('created_at', '>=', $from_date);
                })
                ->when(request('to_date'), function ($subQuery, $to_date) {
                    $subQuery->whereDate('created_at', '<=', $to_date);
                });
        }])
        ->latest()
        ->first(); // Use first() instead of get()

    return Excel::download(new EmployeeReportExpert($employee->load('checking')), $employeee->emp_id.'.xlsx');
    }

    public function downloadPdf(Admin $employee)
    {
         $employee = Admin::where('id', $employee->id)
        ->with(['checking' => function ($query) {
            $query->when(request('from_date'), function ($subQuery, $from_date) {
                    $subQuery->whereDate('created_at', '>=', $from_date);
                })
                ->when(request('to_date'), function ($subQuery, $to_date) {
                    $subQuery->whereDate('created_at', '<=', $to_date);
                });
        }])
        ->latest()
        ->first(); // Use first() instead of get()

    $view = view('admin.attendance.pdf', ['employee' => $employee->load('checking')]);
        $html = $view->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="employee_report.pdf"');
    }
}
