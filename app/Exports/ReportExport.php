<?php

namespace App\Exports;

use App\Models\mail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
      return view('reports.allData',[
        'allData' => mail::all()
        // 'allData' => mail::where('FECHA','<=',now()->format('Y-m-d'))->get()
      ]);
    }
}
