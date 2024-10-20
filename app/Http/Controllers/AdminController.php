<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CeremoniesExport;
use App\Exports\AssistanceExport;
use App\Exports\noAssistanceExport;
use App\Exports\ReportExport;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Mail\LoadMailable;
use Illuminate\Support\Facades\Mail as FacadesMail;

class AdminController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // CONSULTA QUE GENERA TABLA PARA CONTROL DE CEREMONIAS EN EL DIA QUE TRASCURRE
    $informeCeremonias = mail::select([
      'FECHA as Fecha_Ceremonia',
      'HORA as Hora_Ceremonia',
      DB::raw('SUM(ASISTENCIA_CEREMONIA is not null) as sum_Asistentes'),
      DB::raw('COUNT(*) as Total_Citados')
    ])
      ->groupBy('FECHA', 'HORA')
      ->orderBy('FECHA')
      ->orderBy('HORA')
    ->get();
    // consuota que genera informede asistencias
    $informeAsistencias = mail::select([
      'FECHA',
      DB::raw('count(*) as estudiantes_citados'),
      DB::raw('SUM(ASISTENCIA_CEREMONIA) as asistencia_con_invitados'),
      DB::raw('count(ASISTENCIA_CEREMONIA) as estudiantes_asistentes')
      ])
      ->selectRaw('SUM(ASISTENCIA_CEREMONIA) - count(ASISTENCIA_CEREMONIA) as invitados_asistentes')
      ->groupBy('FECHA')
      ->get();
    // consuota que genera informede no asistencias
    $noAsistentes = mail::select('FECHA')
    ->selectRaw('COUNT(*) as estudiantes_citados')
    ->selectRaw('COUNT(*) - COUNT(ASISTENCIA_CEREMONIA) as no_asistentes')
    ->groupBy('FECHA')
    ->get();
    // redirección a la vista de admin (dashboard) con los datos de las consutas genreadas
    return view('dashboard', compact('informeCeremonias', 'informeAsistencias','noAsistentes'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function report(Request $request)
  {
    // GENERACION REPORTE DE TODOS LOS REGISTROS EN BASE DE DATOS TABLA MAILS
    try {
      return Excel::download(new ReportExport, 'Total graduandos.xlsx');
    } catch (\Throwable $th) {
      Log::error("No se descargo el excel con los registros de la tabla mails => ".$th);
      $title = "Tenemos problemas!";
      $text = "El Informe ceremonias no se pudo generar por: {$th}.";
      $html = "!COMUNIQUESE CON SERVICIOS DIGITALES¡";
      $icon = "warning";
      return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
    }
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function export_ceremonies(Request $request)
  {
    // Generacion reporte de Informe ceremonias en base de datos tabla mails
    try {
      return Excel::download(new CeremoniesExport, 'Informe ceremonias.xlsx');
    } catch (\Throwable $th) {
      Log::error("No se descargo el excel con el Informe ceremonias");
      $title = "Tenemos problemas!";
      $text = "El Informe ceremonias no se pudo generar por: {$th}.";
      $html = "!COMUNIQUESE CON SERVICIOS DIGITALES¡";
      $icon = "warning";
      return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
    }
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function export_assistance(Request $request)
  {
    // Generacion reporte de Informe asistencias en base de datos tabla mails
    try {
      return Excel::download(new AssistanceExport, 'Informe asistencias.xlsx');
    } catch (\Throwable $th) {
      Log::error("No se descargo el excel con el Informe asistencias");
      $title = "Tenemos problemas!";
      $text = "El Informe asistencias no se pudo generar por: {$th}.";
      $html = "!COMUNIQUESE CON SERVICIOS DIGITALES¡";
      $icon = "warning";
      return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
    }
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function export_no_assistance(Request $request)
  {
    // Generacion reporte de Informe no asistentes en base de datos tabla mails
    try {
      return Excel::download(new noAssistanceExport, 'Informe no asistentes.xlsx');
    } catch (\Throwable $th) {
      Log::error("No se descargo el excel con el Informe no asistentes");
      $title = "Tenemos problemas!";
      $text = "El Informe no asistentes no se pudo generar por: {$th}.";
      $html = "!COMUNIQUESE CON SERVICIOS DIGITALES¡";
      $icon = "warning";
      return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
    }
  }

  public function asistencia(Request $request)
  {
    // TOMAMOS LOS VALORES DEL REQUEST PARA PROCESARLOS
    $document = $request->document;
    $fecha = $request->fecha;
    $hora = $request->hora;
    $invitado_uno = $request->invitado_uno;
    $invitado_dos = $request->invitado_dos;
    // VALIDAMOS LA CANTIDAD DE ASISTENCIAS INGRESADAS
    if ($invitado_dos == 'on') {
      $asistencia_invitados = 3;
      $text = "Las {$asistencia_invitados} asistencias se registraron con éxito! permite que el graduando ingrese con sus invitados";
    } else if ($invitado_uno == 'on') {
      $asistencia_invitados = 2;
      $text = "Las {$asistencia_invitados} asistencias se registraron con éxito! permiteque el graduando ingrese con sus invitados";
    } else {
      $asistencia_invitados = 1;
      $text = "La asistencia se registro con éxito! permiteque el graduando ingrese";
    }
    // VERIFICAMOS QUE NO TENGA INGRESOS REGISTRADOS EN DB
    $asistencia = mail::select('ASISTENCIA_CEREMONIA', 'FECHA','CORREO')
    ->where('CODIGO_UNICO', $document)
      ->where('FECHA', $fecha)
      ->where('HORA', $hora)
    ->get();
    //VALIDAMOS QUE LA CONSULTA NO ESTE VACIA CON LOS DATOS QUE TRAE EL QR
    if (!$asistencia->isEmpty()) {
      // ASIGNAMOS EL VALOR DE ASISTENCIA CEREMONIA A UNA VARIABLE INDEPENDIENTE
      foreach ($asistencia as $value) {
        $asistenciaValidate = $value->ASISTENCIA_CEREMONIA;
        $fechaValidate = $value->FECHA;
        $correoValidate = $value->CORREO;
      }
      $dateSystem = Carbon::now()->format('Y-m-d');
      // VALIDAMOS LA FECHA DE CITACION CON RESPECTO DE LA FECHA DEL SISTEMA
      if ($dateSystem == $fechaValidate) {
        // VALIDACION DE LA HORA DE ASISTENCIA AL EVENTO
        $dateSystem = Carbon::now()->format('H:i');
        $dateMax = Carbon::parse($hora)->addMinute(30)->format('H:i');
        $dateMin = Carbon::parse($hora)->subMinute(120)->format('H:i');
        // if ($dateSystem <= $dateMax && $dateSystem >= $dateMin) {
          // SI ESTA DENTRO DE LA HORA DE CITACION VALIDAMOS SI YA CUENTA CON REGISTRO DE INGRESOS A CEREMONIA
          if ($asistenciaValidate == null) {
            // ACTUALIZAMOS EL REGISTRO CON LAS ASISTENCIAS INGRESADAS EN EL FILTRO
            try {
              // VALIDACION DE ACTUALIZACION EN BAE DE DATOS
              $affected = DB::table('mails')->where('CODIGO_UNICO', $document)
              ->where('FECHA', $fecha)
              ->where('HORA', $hora)
              ->update([
                'ASISTENCIA_CEREMONIA' => $asistencia_invitados,
                'SCAN_QR' => "TRUE",
                'updated_at' => now()
              ]);
              $title = "Procesado con éxito";
              $text = "El graduando puede ingresar a su ceremonia.";
              $html = "!YA ESTAMOS POR INICIAR¡";
              $icon = "success";
              Log::info("El graduando con documento: {$document} cumple los requisitos y puede ingresar a ceremonia");
              // INVOCAMOS LA FUNCIO ENCARGADA DE ENVIAR EL CORREO
              // $this->correo($correoValidate,$document);
              // RETRONAMSO LA RESPUESTA
              return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
            } catch (\Throwable $th) {
              //ERROR EN INSERCION A LA BASE DE DATOS
              $title = "Procesado con error";
              $text = "No se actualizo el registro en base de datos.";
              $html = "!".$th->getMessage()."¡";
              $icon = "error";
              Log::error('Actualizando registro en base de datos => '.$th);
              return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
            }
          } else {
            // VALIDACION DE ASISTENCIA EXISTENTE
            $title = "Tenemos problemas!";
            $text = "El graduando ya cuenta con registros de ingreso en la plataforma.";
            $html = "!NO DEBERIAS DEJARLO PASAR¡";
            $icon = "warning";
            Log::warning("El graduando con docuemnto: {$document} ya cuenta con registros de ingreso en la plataforma.");
            return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
          }
          // TODO: corregir el tema de la hora para ceremonia = 'No' para no tener que comentar esta linea
        // } else {
          // VALIDACION DE HORA
          // $title = "Tenemos problemas! en validación de hora.";
          // $text = "El graduando está fuera del rango de horario estipulado en el protocolo de la ceremonia.";
          // $html = "!NO DEBERIAS DEJARLO PASAR¡";
          // $icon = "warning";
          // Log::warning("El graduando con docuemnto: {$document} está fuera del rango de horario.");
          // return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
        // }
      } else {
        // VALIDACION DE FECHA
        Log::info('entro en else de comparacion de fechas');
        $title = "Tenemos problemas! en validación de fecha.";
        $text = "El graduando no está citado hoy: {$dateSystem}, en base de datos registra citación a la ceremonia el día: {$fechaValidate} ";
        $html = "!NO DEBERIAS DEJARLO PASAR¡";
        $icon = "error";
        Log::error('Validacion de fecha fallo no esta citado para hoy '.$document);
        return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
      }
    }else{
      // VALIDACION DE CONSULTA VACIA
      $title = "Tenemos problemas!";
      $text = "Fecha citación QR: {$fecha} y Hora citación QR: {$hora}, y en base de datos no encontramos registros con esos parametros.";
      $html = "!VERIFICAR EN EL MODULO DE ASISTENCIA!";
      $icon = "error";
      Log::error('Validacion de fecha fallo no esta citado para hoy '.$document);
      return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
    }
  }

  public function respuesta(Request $request)
  {
    // Generamos pantallad e respuesta por medio de sweetalert pasandole varios parametros
    $title = $request->title;
    $text = $request->text;
    $html = $request->html;
    $icon = $request->icon;
    return view('students.response', compact('title','text','html','icon'));
  }

  public function validateQr(Request $request)
  {
    $student = mail::findOrFail($request->id);

    $name = $student->NOMBRES;
    $document = $student->CODIGO_UNICO;
    $fecha = $student->FECHA;
    $hora = $student->HORA;
    $correo = $student->CORREO;
    return view('students.asistencia', compact('name', 'document', 'fecha', 'hora', 'correo'));
  }

  public function cierre(Request $request)
  {
    $receivers = DB::table('mails')
    ->select('CORREO')
    ->where('HORA', $request->hora)
    ->where('FECHA', now()->format('Y-m-d'))
    ->where('CORREO', '<>', '')
    ->whereNotNull('CORREO')
    ->where('ASISTENCIA_CEREMONIA','<>', '')
    ->whereNotNull('ASISTENCIA_CEREMONIA')
    ->get();
    $copies = $receivers->pluck('CORREO')->map(function ($correo) {
      return str_replace(' ', '', trim(Str::lower($correo)));
    });

    if($copies->isEmpty()){
      $title = "No se encontraron registros para enviar correo";
      $text = "no hay asistencias registradas";
      $html = "!VALIDAR CON EL ÁREA ENCARGADA¡";
      $icon = "error";
      return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
    }else{
      // TODO:implementar envio de correo personalizado de encuesta
      // return $copies;
      try {
        // $urlImagenCode = base64_encode(file_get_contents(''));
        // $urlImagen = "data:image/jpeg;base64.$urlImagenCode";
        FacadesMail::bcc($copies)->send(new LoadMailable());
        Log::info("se envia asistencia a este correo => ".$copies);
        try {
          $affected = DB::table('mails')->whereIn('CORREO', $copies)
          ->update([
            'ENVIO_CORREO_INVITACION' => "ASISTENCIA ENVIADA DESDE NOTIFICACION",
            'updated_at' => now()
          ]);
          Log::info($affected . " registros actualizados en tabla mails");
        } catch (\Throwable $th) {
          Log::error("#ERRORR UPDATE=>" .  $th->getMessage());
          return redirect()->route('loads.index')->dangerBanner('no pude actualizar la tabla con los correos enviados.');
        }
        Log::info($affected . " correos se enviaron con éxito!");
        return redirect()->route('loads.index')->banner($affected . ' correos se enviaron con exito!');
      } catch (\Throwable $th) {
        Log::error("#ERRORR SENDMAIL=>" .  $th->getMessage());
        return redirect()->route('loads.index')->dangerBanner('no pude cargar el registro por que: ' . $th->getMessage());
      }
      // return redirect()->route('loads.index')->banner('Cierrre exitoso! {$affected} correos enviados.');
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
