<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\mail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AssistanceExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
      return view('reports.exportAssistances',[
        'informeAsistencias' => mail::select([
          'FECHA',
          DB::raw('count(*) as estudiantes_citados'),
          DB::raw('SUM(ASISTENCIA_CEREMONIA) as asistencia_con_invitados'),
          DB::raw('count(ASISTENCIA_CEREMONIA) as estudiantes_asistentes')
        ])
          ->selectRaw('SUM(ASISTENCIA_CEREMONIA) - count(ASISTENCIA_CEREMONIA) as invitados_asistentes')
          ->groupBy('FECHA')
          ->get()
      ]);
    }
}
