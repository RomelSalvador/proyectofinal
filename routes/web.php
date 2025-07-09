<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\RecursoController;
use App\Http\Controllers\AsignarRecursoController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect()->route('login'); 
});

// Rutas de autenticación
Auth::routes();

// Ruta principal luego del login (cada rol ve su propia vista)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // EVENTOS
    Route::get('/eventos', [EventoController::class, 'index'])->name('eventos.index');
    Route::get('/eventos/create', [EventoController::class, 'create'])->name('eventos.create');
    Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
    Route::get('/eventos/{id}/edit', [EventoController::class, 'edit'])->name('eventos.edit');
    Route::put('/eventos/{id}', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('/eventos/{id}', [EventoController::class, 'destroy'])->name('eventos.destroy');

    // Eventos disponibles (ambos roles)
    Route::get('/eventos/disponibles', [EventoController::class, 'listarDisponibles'])->name('eventos.disponibles');

    // INSCRIPCIONES
    Route::get('/inscripciones/mostrar', [InscripcionController::class, 'index'])->name('inscripciones.index');
    Route::get('/inscripciones/create', [InscripcionController::class, 'create'])->name('inscripciones.create');
    Route::post('/inscripciones', [InscripcionController::class, 'store'])->name('inscripciones.store');
    Route::get('/inscripciones/{id}/edit', [InscripcionController::class, 'edit'])->name('inscripciones.edit');
    Route::put('/inscripciones/{id}', [InscripcionController::class, 'update'])->name('inscripciones.update');
    Route::delete('/inscripciones/{id}', [InscripcionController::class, 'destroy'])->name('inscripciones.destroy');

    // RECURSOS
    Route::get('/recursos/mostrar', [RecursoController::class, 'index'])->name('recursos.index');
    Route::get('/recursos/create', [RecursoController::class, 'create'])->name('recursos.create');
    Route::post('/recursos', [RecursoController::class, 'store'])->name('recursos.store');
    Route::get('/recursos/{id}/edit', [RecursoController::class, 'edit'])->name('recursos.edit');
    Route::put('/recursos/{id}', [RecursoController::class, 'update'])->name('recursos.update');
    Route::delete('/recursos/{id}', [RecursoController::class, 'destroy'])->name('recursos.destroy');

    // ASIGNAR RECURSOS
    Route::get('/asignarRecursos', [AsignarRecursoController::class, 'index'])->name('asignarRecursos.index');
    Route::get('/asignarRecursos/create', [AsignarRecursoController::class, 'create'])->name('asignarRecursos.create');
    Route::post('/asignarRecursos', [AsignarRecursoController::class, 'store'])->name('asignarRecursos.store');
    Route::get('/asignarRecursos/{evento_id}/{recurso_id}/edit', [AsignarRecursoController::class, 'edit'])->name('asignarRecursos.edit');
    Route::put('/asignarRecursos/{evento_id}/{recurso_id}', [AsignarRecursoController::class, 'update'])->name('asignarRecursos.update');
    Route::delete('/asignarRecursos/{evento_id}/{recurso_id}', [AsignarRecursoController::class, 'destroy'])->name('asignarRecursos.destroy');

});
