<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubscriberReportExport implements FromView, WithHeadings
{
    protected $exportData;


    public function __construct($exportData)
    {
        $this->exportData = $exportData;
    //    dd($this->exportData['subscriber']);

    }

    public function view(): View
    {
        return view('admin.subscriber_report.excel', [
            'users' => $this->exportData['users'],
            'bookings' => $this->exportData['bookings'],
            'pincodes' => $this->exportData['pincodes'],
            'subscriber' => $this->exportData['subscriber'],
        ]);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Rider Name',
            'Rider ID',
            'Mobile',
            'Booking Date',
            'Booking ID',
            'Booking Cost',
            'Service Cost'
        ];
    }
}
