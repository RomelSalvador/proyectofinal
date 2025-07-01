<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Recurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsignarRecursoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar formulario para asignar recurso a evento
    public function create()
    {
        if (Auth::user()->rol !== 'administrador') {
            abort(403, 'No autorizado');
        }

        $eventos = Evento::all();
        $recursos = Recurso::all();

        return view('asignarRecursos.asignarRecursos', compact('eventos', 'recursos'));
    }

    // Guardar la asignación
    public function store(Request $request)
    {
        if (Auth::user()->rol !== 'administrador') {
            abort(403, 'No autorizado');
        }

        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'recurso_id' => 'required|exists:recursos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $evento = Evento::findOrFail($request->evento_id);

        $evento->recursos()->syncWithoutDetaching([
            $request->recurso_id => ['cantidad' => $request->cantidad]
        ]);

        return redirect()->route('asignar-recursos.create')->with('success', 'Recurso asignado correctamente.');
    }
}
