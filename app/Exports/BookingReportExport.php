<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingReportExport implements FromView, WithHeadings
{
    protected $bookings;

    public function __construct($bookings)
    {
        $this->bookings = $bookings;
    }

    public function view(): View
    {
        return view('admin.booking_report.excel', [
            'bookings' => $this->bookings,
        ]);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Booking ID',
            'Cost',
            'Customer Name',
            'Driver ID',
            'Pincode',
            'Distance',
            'Status',
            'Date',
        ];
    }
}
