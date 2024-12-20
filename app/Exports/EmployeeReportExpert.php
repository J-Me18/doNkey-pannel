<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeReportExpert implements FromView, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $employee;

    public function __construct($employee)
    {
        // dd($employee);
        $this->employee = $employee;
    }

    public function view(): View
    {
        return view('admin.attendance.excel', [
             'employee' => $this->employee,
        ]);
    }

    public function headings(): array
    {
        return [
            'Employee Name',
            'Employee ID',
            'Check In Date',
            'Check In Time',
            'Check Out Date',
            'Check Out Time'
        ];
    }
}
