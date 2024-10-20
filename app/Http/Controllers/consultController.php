<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\invitation;
use App\Models\mail;
use Carbon\Carbon;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\LoadMailable;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Str;

class consultController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // CONSULTAMOS TIPOS DE DOCUMENTOS REGISTRADOS EN LA BASE DE DATOS
    $documentsList = mail::select('TIPO_DOCUMENTO')
    ->distinct('TIPO_DOCUMENTO')
    ->orderBy('TIPO_DOCUMENTO','ASC')
    ->get();
    // GENERAMOS MAPEO DE POSIBLES TIPOS DE DOCUMENTOS EN BASE DE DATOS
    $documentMapping = [
        'CC'  => 'Cédula de Ciudadanía',
        'CE'  => 'Cédula Extranjería',
        'PAS' => 'Pasaporte',
        'TI'  => 'Tarjeta de Identidad',
    ];
    // GENERAMOS LISTADO DE DOCUMENTOS PARA MOSTRAR EN VISTA CON UN SELECT
    $documentsList = $documentsList->map(function ($document) use ($documentMapping) {
      $document->codigo = $document->TIPO_DOCUMENTO;
      $document->valor = $documentMapping[$document->TIPO_DOCUMENTO] ?? $document->TIPO_DOCUMENTO;
      return $document;
    });
    // RETORNAMOS LA VISTA QUE RENDERIZA Y PASAMOS PARAMETROS
    return view('students.index', compact('documentsList'));
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
    // ASIGNAMOS VARIABLES DEL REQUEST PARA SU POSTERIOR USO
    $tipoDocumento = $request->Tipo_documento;
    $documento = $request->documento;
    $correo = $request->correo;
    // FILTRAMOS DATOS EN BASE DE DATOS CON LOS CRITERIOS DE LAS VARIABLES
    $studentCertificates = mail::where('CODIGO_UNICO', $documento)
      ->where('CORREO', $correo)
      ->where('TIPO_DOCUMENTO', $tipoDocumento)
      ->orderBy('fecha','DESC')
      ->first();
    // VALIDAMOS SI EXISTE OBJETO CON DATOS FILTRADOS
    if ($studentCertificates) {
      // ASIGNAMOS VARIABLES EXTRAIDAS DEL OBJETO FILTRADO
      $dondeRecibe = $studentCertificates->DONDE_RECIBE;
      $horaRecibe = $studentCertificates->HORA;
      $fechaRecibe = $studentCertificates->FECHA;
      return view('students.show', compact('studentCertificates', 'documento'));
    } else {
      // GENERAMOS RESPUESTA EN CASO DE QUE EL OBJETO NO EXISTA
      $title = "No se encontraron registros";
      $text = "con los datos suministrados, ¡intenta de nuevo!";
      $html = "!VALIDAR CON EL ÁREA ENCARGADA¡";
      $icon = "error";
      Log::error("No se encontraron registros con los datos suministrados {$documento}, ¡intenta de nuevo!.");
      return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request)
  {
    //
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function printPDF($id)
  {
    // CAPTURAMOS INFORMACION DEL ESTUDIANTE GRADUANDO
    $graduando = mail::findOrFail($id);
    // ASIGNAMOS LAS VARIABLES PARA EL PDF
    $base = $_ENV['APP_URL'];
    $escuela = $graduando->ESCUELA;
    $name = $graduando->NOMBRES;
    $document = $graduando->CODIGO_UNICO;
    $carrera_titulo = $graduando->CARRERA_TITULO;
    $dia_numero = $graduando->DIA_NUMERO;
    $año_numero = $graduando->AÑO_NUMERO;
    $document_type = $graduando->TIPO_DOCUMENTO;
    $fecha = $graduando->FECHA;
    $hora = $graduando->HORA;
    $ciclo = $graduando->CICLO;
    $ceremonia = $graduando->CEREMONIA;
    $correo = $graduando->CORREO;
    $silla = $graduando->SILLA;
    $lugar = $graduando->LUGAR;
    // INVOCAMOS FUNCION QUE FORMATEA LA FECHA  Y LA HORA PARA MOSTRAR EN LA INVITACION
    $fechaPrint = $this->formatDateInvitation($fecha);
    // FORMATEA FECHA A 12 HORAS O PONE RANGO DE HORA PARA VENTANILLA
    if($hora =='0:00' || $hora == '0'){
      if($lugar == 'Sede Chía'){
        $horaFormat = "Desde las 9:00 AM hasta las 4:00 PM" ;
      }else{
        $horaFormat = "Desde las 9:00 AM hasta las 7:00 PM" ;
      }
    }else{
      $horaFormat = Carbon::parse($hora)->format('h:i A');
    }
    // GENERA URL QUE SE PASA AL QR PARA REDIRECCION
    $url_validate = $base . "validateQr/" . $id;
    // PARAMETRIZA EL QR
    $qr = QrCode::size(150)
    ->backgroundColor(255,255,255,25)
    ->color(31, 41, 54)
    ->margin(2)
    ->generate($url_validate);
    // VALIDACION DE CEREMONIA EN NO PARA GENERAR INVITACION PERSONALIZADA
    if($ceremonia === 'No'){
      $viweInvitation = "students.inv-ceremonia-no";
    }else{
      $viweInvitation = "students.inv-ceremonia";
    }
    // PARAMETRIZA EL PDF CON LOS DATOS REQUERIDOS PARA SU IMPRESION
    $pdf = PDF::loadView($viweInvitation,compact(
        'name',
        'fecha',
        'hora',
        'horaFormat',
        'qr',
        'url_validate',
        'fechaPrint',
        'silla',
        'lugar',
      )
    );
    $pdf->setPaper('A4');
    // CONSULTA REGISTRO DE DESCARGA
    $copy = invitation::where('DOCUMENTO', $document)->get();
    // VALIDA EL REGISTRO CONSULTADO
    if (count($copy) == 0) {
      $updateInvitation = new invitation();
      $updateInvitation->ESCUELA = $escuela;
      $updateInvitation->NOMBRES = $name;
      $updateInvitation->DOCUMENTO = $document;
      $updateInvitation->CARRERA_TITULO = $carrera_titulo;
      $updateInvitation->TIPO_DOCUMENTO = $document_type;
      $updateInvitation->FECHA = $fecha;
      $updateInvitation->HORA = $hora;
      $updateInvitation->CICLO = $ciclo;
      $updateInvitation->CEREMONIA = $ceremonia;
      $updateInvitation->CORREO  = $correo;
      try {
        // SI EXISTE UN REGISTRO LO ACTUALIZA
        $updateInvitation->save();
      } catch (\Throwable $th) {
        // SI NO SE PUEDE ACTUALIZAR SE GENERA RESPUESTA SWEET ALERT
        $title = "Tenemos problemas!";
        $text = "con los datos suministrados, ¡intenta de nuevo!";
        $html = "".$th->getMessage();
        $icon = "error";
        Log::error("No se actualizaron registros con los datos suministrados {$document}, ¡intenta de nuevo!.");
        return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
      }
    } else {
      try {
        // INSERTA EN BASE DE DATOS NUEVO REGISTRO DE DESCRAGA
        $affected = DB::table('invitations')->where('DOCUMENTO', $document)->update(['updated_at' => now()]);
        Log::info($affected . " registros actualizados en tabla invitations");
      } catch (\Throwable $th) {
        // $response = $th->getMessage();
        // return view('students.response', compact('response'));
        $title = "Tenemos problemas!";
        $text = "con los datos suministrados, ¡intenta de nuevo!";
        $html = "".$th->getMessage();
        $icon = "error";
        Log::error("No se insertaron registros con los datos suministrados {$document}, ¡intenta de nuevo!.");
        return redirect()->route('respuesta',compact('title','text','html','icon'))->with('response','ok');
      }
    }
    Log::info("se muestra el pdf de {$graduando->NOMBRES}");
    return $pdf->stream($graduando->NOMBRES . '.pdf');
  }

  public function formatDateInvitation($fecha)
  {
    // FORMATEAMOS LA FECHA A ESPAÑOL PARA PODER MOSTRAR EL MES Y EL DIA
    $dateEs = Carbon::parse($fecha)->locale('es');
    // EXTRAEMOS EL DIA EN NUMERO DE LA FECHA FORMATEADA
    $day_i = Carbon::parse($fecha)->format('d');
    // EXTRAEMOS EL DIA EN LETRAS
    $day_text = $dateEs->dayName;
    // EXTRAEMOS EL MES EN LETRAS
    $month_i = $dateEs->monthName;
    // EXTRAEMOS EL AÑO DE LA FECHA
    $year_i = Carbon::parse($fecha)->format('Y');
    // GENERAMOS EL STRING QUE CONTIENE LAS VARIABLES DE LA FECHA FORMATEADA PARA RETORNAR
    return $fecha_realizado =  Str::ucfirst($day_text)." ".$day_i . " de " . Str::ucfirst($month_i) . " del " . $year_i;
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
