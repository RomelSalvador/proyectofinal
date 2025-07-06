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

    public function index()
    {
        $this->autorizarAdmin();
        $eventos = Evento::all();
        return view('eventos.eventosMostrar', compact('eventos')); 
    }

    public function create()
    {
        $this->autorizarAdmin();
        return view('eventos.eventosCrear'); 
    }

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
            'precio' => 'required|numeric|min:0',
            'estado' => 'required|in:activo,inactivo',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('eventos', 'public');
        }

        Evento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'ubicacion' => $request->ubicacion,
            'aforo' => $request->aforo,
            'precio' => $request->precio,
            'estado' => $request->estado,
            'imagen' => $rutaImagen,
        ]);

        return redirect()->route('eventos.index')->with('success', 'Evento creado correctamente.');
    }

    public function edit($id)
    {
        $this->autorizarAdmin();
        $evento = Evento::findOrFail($id);
        return view('eventos.eventosEditar', compact('evento'));
    }

    public function update(Request $request, $id)
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
            'precio' => 'required|numeric|min:0',
            'estado' => 'required|in:activo,inactivo',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $evento = Evento::findOrFail($id);

        $rutaImagen = $evento->imagen;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('eventos', 'public');
        }

        $evento->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'ubicacion' => $request->ubicacion,
            'aforo' => $request->aforo,
            'precio' => $request->precio,
            'estado' => $request->estado,
            'imagen' => $rutaImagen,
        ]);

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $this->autorizarAdmin();

        $evento = Evento::findOrFail($id);
        $evento->delete();

        return redirect()->route('eventos.index')->with('success', 'Evento eliminado correctamente.');
    }

    public function listarDisponibles()
    {
        $eventos = Evento::where('estado', 'activo')->get();
        return view('eventos.eventosDisponibles', compact('eventos'));
    }

    private function autorizarAdmin()
    {
        if (Auth::user()->rol !== 'administrador') {
            abort(403, 'Acceso no autorizado.');
        }
    }
}
