<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/usuarios/create', 'usuarios.create')->name('usuarios.create');
Route::view('/eventos/create', 'eventos.create')->name('eventos.create');
Route::view('/inscripcions/create', 'inscripcions.create')->name('inscripcions.create');
Route::view('/recursos/create', 'recursos.create')->name('recursos.create');
Route::view('/asignarRecursos/create', 'asignarRecursos.create')->name('asignarRecursos.create');

