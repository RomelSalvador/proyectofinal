<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar todas las inscripciones
    public function index()
    {
        if (Auth::user()->rol === 'administrador') {
            $inscripciones = Inscripcion::with('user', 'evento')->get();
        } else {
            $inscripciones = Inscripcion::with('evento')
                ->where('user_id', Auth::id())
                ->get();
        }

        return view('inscripciones.inscripcionesMostrar', compact('inscripciones')); 
    }

    // Mostrar formulario para inscribirse
    public function create()
    {
        $eventos = Evento::where('estado', 'activo')->get();
        return view('inscripciones.inscripcionesCrear', compact('eventos')); 
    }

    // Guardar inscripción
    public function store(Request $request)
    {
        $request->validate([
            'evento_id' => 'required|exists:eventos,id',
        ]);

        $yaInscrito = Inscripcion::where('user_id', Auth::id())
            ->where('evento_id', $request->evento_id)
            ->exists();

        if ($yaInscrito) {
            return redirect()->back()->with('error', 'Ya estás inscrito en este evento.');
        }

        Inscripcion::create([
            'user_id' => Auth::id(),
            'evento_id' => $request->evento_id,
            'fecha' => now()->toDateString(),
            'estado' => 'pendiente',
        ]);

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción registrada.');
    }
}
