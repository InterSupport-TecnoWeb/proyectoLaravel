<?php

use App\Http\Livewire\Actividades;
use App\Http\Livewire\Almacens;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Categorias;
use App\Http\Livewire\Plans;
use App\Http\Livewire\Product;
use App\Http\Livewire\Promocions;
use App\Http\Livewire\Reportes;
use App\Http\Livewire\Servicios;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('categorias', Categorias::class);
Route::get('almacenes', Almacens::class);
Route::get('promociones', Promocions::class);
Route::get('productos', Product::class);
Route::get('plan', Plans::class);
Route::get('actividades', Actividades::class);
Route::get('servicios', Servicios::class);
Route::get('reportes', Reportes::class);
Route::get('report/pdf/{reportType}', [ExportController::class, 'reportPDF']);