<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Categorias;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('categorias', Categorias::class);

Route::get('clientes',\App\Http\Livewire\Clientes::class);
Route::get('telefonoclientes',\App\Http\Livewire\TelefonoClientes::class);
Route::get('telefonousers',\App\Http\Livewire\TelefonoUsuarios::class);
Route::get('viaticos',\App\Http\Livewire\Viaticos::class);
