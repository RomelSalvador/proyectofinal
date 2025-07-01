<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\AsignarRecursoController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Auth::routes();

// Ruta principal luego de login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // === EVENTOS (solo administrador) ===
    Route::get('/eventos/create', [EventoController::class, 'create'])->name('eventos.create');
    Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
    Route::get('/eventos/mostrar', [EventoController::class, 'index'])->name('eventos.index');

    // === INSCRIPCIONES (para todos los autenticados, controlado en controlador) ===
    Route::get('/inscripciones/create', [InscripcionController::class, 'create'])->name('inscripciones.create');
    Route::post('/inscripciones', [InscripcionController::class, 'store'])->name('inscripciones.store');
    Route::get('/inscripciones/mostrar', [InscripcionController::class, 'index'])->name('inscripciones.index');

    // === RECURSOS (solo administrador) ===
    Route::get('/recursos/create', [RecursoController::class, 'create'])->name('recursos.create');
    Route::post('/recursos', [RecursoController::class, 'store'])->name('recursos.store');
    Route::get('/recursos/mostrar', [RecursoController::class, 'index'])->name('recursos.index');

    // === ASIGNAR RECURSOS (solo administrador) ===
    Route::get('/asignarRecursos/create', [AsignarRecursoController::class, 'create'])->name('asignarRecursos.create');
    Route::post('/asignarRecursos', [AsignarRecursoController::class, 'store'])->name('asignarRecursos.store');
});
