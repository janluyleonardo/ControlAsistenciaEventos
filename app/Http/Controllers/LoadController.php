<?php

namespace App\Http\Controllers;

use App\Mail\LoadMailable;
use App\Models\Load;
use App\Models\mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LoadsImport;
use Illuminate\Support\Facades\Mail as FacadesMail;

class LoadController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    // CAPTURAMOS FECHA ACTUAL
    $fechaActual = now()->format('Y-m-d');
    // FILTRAMOS REGISTROS DE LA FECHA ACTUAL (HOY)
    $registrosHoy = mail::whereDate('FECHA', $fechaActual)->orderBy('HORA')->get();
    $conteosPorHora = [];
    // DEFINIMOS Y ASIGNAMOS VALORES AL ARRAY DE CONTEOSPOR HORA
    foreach ($registrosHoy as $registro) {
      $hora = $registro->HORA;
      if (!isset($conteosPorHora[$hora])) {
        $conteosPorHora[$hora] = [
          'citados' => 0,
          'asistentes' => 0,
        ];
      }
      $conteosPorHora[$hora]['citados']++;
      if ($registro->ASISTENCIA_CEREMONIA >= 1) {
        $conteosPorHora[$hora]['asistentes']++;
      }
    }
    // FILTRAMOS TODOS LOS REGISTROS PARA CONTEO GENERAL
    $loadscount = mail::all();
    // CAPTURAMOS LA VARIABLE TEXTO SI LLEGA EN LA PETICION
    $texto = trim($request->get('texto'));
    // FILTRAMOS REGISTROS EN LA BASE DE DATOS
    $loads = mail::where('NOMBRES', 'LIKE', '%' . $texto . '%')
      ->orWhere('CODIGO_UNICO', 'LIKE', '%' . $texto . '%')
      ->orderByDesc('id')
      ->paginate(15);
    return view('loads.index', compact('loadscount', 'texto', 'loads', 'conteosPorHora'));
  }

  /**
   * Show the form for importing a new file whit certificates for generate.
   *
   * @return \Illuminate\Http\Response
   */
  public function load(Request $request)
  {
    // VALIDACION DEL CAMPO QUE TRAE EL ARCHIVO DESDE EL FORMULARIO
    $request->validate([
      'file' => 'required'
    ]);
    try {
      // EJECUTA LA IMPORTACION DE LOS DATOS Y LOS GUARDA EN LA TABLA MAILS
      Excel::import(new LoadsImport, request()->file('file'));
      return redirect()->route('admin.index')->banner('Archivo cargado, con éxito');
    } catch (\Throwable $th) {
      return redirect()->route('admin.index')->dangerBanner('ERROR: ' . $th->getMessage());
    }
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // return "create";
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
    // return "EDIT";
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, mail $load)
  {
    try {
      // TOMAMOS EL OBJETO $MAIL PARA PODER ACTUALIZAR LOS CAMPOS QUE LLEGAN DEL FORMULARIO
      $load->update($request->all());
      return redirect()->route('loads.index')->banner('Registro actualizado exitosamente.');
    } catch (\Throwable $th) {
      return redirect()->route('loads.index')->dangerBanner('Registro no modificado, revisar por que: ' . $th->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(mail $load)
  {
    try {
      // TOMAMOS EL OBJETO $load PARA PODER ELIMINAR EL REGISTRO CORRESPONDIENTE
      $load->delete();
      return redirect()->route('loads.index')->banner('Registro eliminado exitosamente.');
    } catch (\Throwable $th) {
      return redirect()->route('loads.index')->dangerBanner('Registro no eliminad, revisar por que: ' . $th->getMessage());
    }
  }
}
