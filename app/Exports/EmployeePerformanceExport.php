<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeePerformanceExport implements FromView, WithHeadings
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
        return view('admin.performance.excel', [
             'employee' => $this->employee,
        ]);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Subscriber ID',
            'Subscription Amount',
            'Subscription Date',
            'ExpiryDate'
        ];
    }
}
