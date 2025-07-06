<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Recurso;
use App\Models\EventoRecurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsignarRecursoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Formulario para asignar recurso a evento
    public function create()
    {
        $this->autorizarAdmin();
        $eventos = Evento::all();
        $recursos = Recurso::all();

        return view('asignarRecursos.asignarRecursos', compact('eventos', 'recursos'));
    }

    // Guardar la asignación
    public function store(Request $request)
    {
        $this->autorizarAdmin();

        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'recurso_id' => 'required|exists:recursos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $recurso = Recurso::findOrFail($request->recurso_id);

        // Sumamos todas las cantidades asignadas del recurso
        $cantidadAsignada = EventoRecurso::where('recurso_id', $recurso->id)->sum('cantidad');
        $cantidadDisponible = $recurso->cantidad - $cantidadAsignada;

        if ($request->cantidad > $cantidadDisponible) {
            return redirect()->back()->withErrors(['cantidad' => 'no es posible asignar esa cantida']);
        }

        $evento = Evento::findOrFail($request->evento_id);
        $evento->recursos()->syncWithoutDetaching([
            $request->recurso_id => ['cantidad' => $request->cantidad]
        ]);

        return redirect()->route('asignarRecursos.index')->with('success', 'Recurso asignado correctamente.');
    }

    // Listar asignaciones
    public function index()
    {
        $this->autorizarAdmin();
        $asignaciones = EventoRecurso::with(['evento', 'recurso'])->get();
        return view('asignarRecursos.asignarRecursosMostrar', compact('asignaciones'));
    }

    // Formulario de edición
    public function edit($evento_id, $recurso_id)
    {
        $this->autorizarAdmin();

        $evento = Evento::findOrFail($evento_id);
        $recursos = Recurso::all();
        $eventos = Evento::all();

        $pivot = $evento->recursos()->where('recurso_id', $recurso_id)->first();
        $cantidad = $pivot ? $pivot->pivot->cantidad : 0;

        return view('asignarRecursos.asignarRecursosEditar', compact('evento', 'eventos', 'recursos', 'recurso_id', 'cantidad'));
    }

    // Actualizar asignación
    public function update(Request $request, $evento_id, $recurso_id)
    {
        $this->autorizarAdmin();

        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'recurso_id' => 'required|exists:recursos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $recurso = Recurso::findOrFail($recurso_id);
        $cantidadAsignada = EventoRecurso::where('recurso_id', $recurso_id)
            ->where('evento_id', '!=', $evento_id)
            ->sum('cantidad');

        $cantidadDisponible = $recurso->cantidad - $cantidadAsignada;

        if ($request->cantidad > $cantidadDisponible) {
            return redirect()->back()->withErrors(['cantidad' => 'no es posible asignar esa cantidad']);
        }

        $evento = Evento::findOrFail($evento_id);
        $evento->recursos()->updateExistingPivot($recurso_id, ['cantidad' => $request->cantidad]);
        return redirect()->route('asignarRecursos.index')->with('success', 'Asignación actualizada correctamente.');
    }

    // Eliminar asignación
    public function destroy($evento_id, $recurso_id)
    {
        $this->autorizarAdmin();

        $evento = Evento::findOrFail($evento_id);
        $evento->recursos()->detach($recurso_id);

        return redirect()->route('asignarRecursos.index')->with('success', 'Asignación eliminada correctamente.');
    }

    // Verificar si el usuario es administrador
    private function autorizarAdmin()
    {
        if (Auth::user()->rol !== 'administrador') {
            abort(403, 'No autorizado');
        }
    }
}
