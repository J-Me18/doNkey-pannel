<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NewsLetterExport implements FromView, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $newsletters;

    public function __construct($newsletters)
    {
        $this->newsletters = $newsletters;

    }

    public function view(): View
    {
        return view('admin.newsletter.excel', [
            'newsletters' => $this->newsletters,
        ]);
    }

    public function headings(): array
    {
        return [
            'S.No',
            'Email',
            'Created_at',
          
        ];
    }
}

