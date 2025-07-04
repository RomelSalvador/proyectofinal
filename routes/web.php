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

    // EVENTOS 
    Route::get('/eventos/create', [EventoController::class, 'create'])->name('eventos.create'); 
    Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');         
    Route::get('/eventos/mostrar', [EventoController::class, 'index'])->name('eventos.index');  
    Route::delete('/eventos/{id}', [EventoController::class, 'destroy'])->name('eventos.destroy');

    // Ruta para listar eventos disponibles (ambos roles)
    Route::get('/eventos/disponibles', [EventoController::class, 'listarDisponibles'])->name('eventos.disponibles');

    // INSCRIPCIONES 
    Route::get('/inscripciones/mostrar', [InscripcionController::class, 'index'])->name('inscripciones.index'); 
    Route::get('/inscripciones/create', [InscripcionController::class, 'create'])->name('inscripciones.create');
    Route::post('/inscripciones', [InscripcionController::class, 'store'])->name('inscripciones.store');
    Route::get('/inscripciones/{id}/edit', [InscripcionController::class, 'edit'])->name('inscripciones.edit');
    Route::put('/inscripciones/{id}', [InscripcionController::class, 'update'])->name('inscripciones.update');
    Route::delete('/inscripciones/{id}', [InscripcionController::class, 'destroy'])->name('inscripciones.destroy');

    // RECURSOS 
    Route::get('/recursos/create', [RecursoController::class, 'create'])->name('recursos.create'); 
    Route::post('/recursos', [RecursoController::class, 'store'])->name('recursos.store');         
    Route::get('/recursos/mostrar', [RecursoController::class, 'index'])->name('recursos.index');  

    // ASIGNAR RECURSOS 
    Route::get('/asignarRecursos/create', [AsignarRecursoController::class, 'create'])->name('asignarRecursos.create'); 
    Route::post('/asignarRecursos', [AsignarRecursoController::class, 'store'])->name('asignarRecursos.store');         
});
