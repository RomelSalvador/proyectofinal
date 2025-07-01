<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar todos los eventos 
    public function index()
    {
        $this->autorizarAdmin();
        $eventos = Evento::all();
        return view('eventos.eventosMostrar', compact('eventos')); 
    }

    // Mostrar formulario para crear evento
    public function create()
    {
        $this->autorizarAdmin();
        return view('eventos.eventosCrear'); 
    }

    // Guardar nuevo evento
    public function store(Request $request)
    {
        $this->autorizarAdmin();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required',
            'tipo' => 'required|in:cultural,deportivo,social',
            'fecha' => 'required|date',
            'hora' => 'required',
            'ubicacion' => 'required|string|max:255',
            'aforo' => 'required|integer|min:1',
            'estado' => 'required|in:activo,inactivo',
        ]);

        Evento::create($request->all());

        return redirect()->route('eventos.index')->with('success', 'Evento creado correctamente.');
    }

    private function autorizarAdmin()
    {
        if (Auth::user()->rol !== 'administrador') {
            abort(403, 'Acceso no autorizado.');
        }
    }
}
