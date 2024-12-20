<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DriverReportExport implements FromView, WithHeadings
{
    protected $exportData;

    public function __construct($exportData)
    {
        $this->exportData = $exportData;
        //dd($exportData);
    }

    public function view(): View
    {
        return view('subscriber.driver_report.excel', [
            'subscriber' => $this->exportData['subscriber'],
            'pincodes' => $this->exportData['pincodes'],
            'bookings' => $this->exportData['bookings'],
            'users' => $this->exportData['users'],
            'statusValues' => $this->exportData['statuses']
        ]);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Rider Name',
            'Rider ID',
            'Rider Status',
            'Mobile',
            'Booking Count',
            'Total Booking Cost',
        ];
    }
}
