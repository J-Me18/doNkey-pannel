<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubscriberExpiryListExport implements FromView, WithHeadings
{
    protected $exportData;


    public function __construct($exportData)
    {
        $this->exportData = $exportData;
       // dd($this->exportData);
    }

    public function view(): View
    {
        return view('admin.expired_subscriber.excel', [
            'expiredSubscribers' => $this->exportData['expiredSubscribersAndWithinFiveDays'],
            'pincode' => $this->exportData['pincode'],
            'id' => $this->exportData['id']
        ]);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Subscriber ID',
            'Driver ID',
            'Name',
            'Location',
            'Pincode',
            'Account Type',
            'Mobile',
            'Expiry Date'
        ];
    }
}
