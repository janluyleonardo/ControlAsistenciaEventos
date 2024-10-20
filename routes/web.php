<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\consultController;
// use App\Http\Controllers\DownloadController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::resource('/consult', consultController::class);
Route::get('/printPDF/{id}', [consultController::class, 'printPDF'])->name('printPDF');
Route::get('respuesta', [AdminController::class, 'respuesta'])->name('respuesta');

Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified'
])->group(function () {
  // Route::get('/dashboard', function () {
  //   return view('dashboard');
  // })->name('dashboard');
  Route::resource('/loads', LoadController::class);
  // Route::resource('/downloads', DownloadController::class);
  Route::resource('/admin', AdminController::class);
  Route::get('/report', [AdminController::class, 'report'])->name('report');
  Route::get('ceremonies', [AdminController::class, 'export_ceremonies'])->name('ceremonies');
  Route::get('assistance', [AdminController::class, 'export_assistance'])->name('assistance');
  Route::get('noAssistance', [AdminController::class, 'export_no_assistance'])->name('noAssistance');
  Route::post('load', [LoadController::class, 'load'])->name('load');
  Route::post('asistencia', [AdminController::class, 'asistencia'])->name('asistencia');
  // TODO: verificar funcionalidad de las variables que se cambiaron
  Route::get('/validateQr/{id?}', [AdminController::class, 'validateQr'])->name('validateQr');
  Route::get('/cierre/{hora?}', [AdminController::class, 'cierre'])->name('cierre');
  // Route::get('/validateQr/{name?}/{document?}/{fecha?}/{hora?}/{correo?}', [AdminController::class, 'validateQr'])->name('validateQr');
  // Route::get('printPDF', [LoadController::class, 'printPDF'])->name('printPDF');
});
