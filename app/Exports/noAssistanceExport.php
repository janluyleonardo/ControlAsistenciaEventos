<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\mail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class noAssistanceExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
      return view('reports.exportNoAssistances',[
        'informeNoAsistencias' => mail::select('FECHA')
        ->selectRaw('COUNT(*) as estudiantes_citados')
        ->selectRaw('COUNT(*) - COUNT(ASISTENCIA_CEREMONIA) as no_asistentes')
        ->groupBy('FECHA')
        ->get()
      ]);
    }
}
