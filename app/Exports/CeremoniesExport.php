<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\mail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CeremoniesExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
      return view('reports.exportCeremonies',[
        'informeCeremonias' => mail::select([
            'FECHA as Fecha_Ceremonia',
            'HORA as Hora_Ceremonia',
            DB::raw('SUM(ASISTENCIA_CEREMONIA is not null) as sum_Asistentes'),
            DB::raw('COUNT(*) as Total_Citados')
          ])
            ->groupBy('FECHA', 'HORA')
            ->orderBy('FECHA')
            ->orderBy('HORA')
          ->get()
      ]);
    }
}
