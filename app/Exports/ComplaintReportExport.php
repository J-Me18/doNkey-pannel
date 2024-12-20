<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ComplaintReportExport implements FromView, WithHeadings
{
    protected $exportData;

    public function __construct($exportData)
    {
        $this->exportData = $exportData;
        // dd($exportData['admin']);
    }

    public function view(): View
    {
        return view('admin.complaint_report.excel', [
            'admin' => $this->exportData['admin'],
            'complaints' => $this->exportData['complaints']
        ]);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Complaint ID',
            'Status',
            'complained By',
            'complained At',
            'Solved By',
            'Solved At'
        ];
    }
}
