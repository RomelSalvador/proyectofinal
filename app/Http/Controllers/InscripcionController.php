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

    // Mostrar inscripciones 
    public function index(){

    if (Auth::user()->rol === 'administrador') {
        $inscripciones = Inscripcion::with('user', 'evento')->get();
        return view('inscripciones.inscripcionesVer', compact('inscripciones'));
    }

    $inscripciones = Inscripcion::with('evento')
        ->where('user_id', Auth::id())
        ->get();

    return view('inscripciones.inscripcionesMostrar', compact('inscripciones'));
    }

    // Formulario para inscribirse
    public function create()
    {
        $this->autorizarParticipante();

        $eventos = Evento::where('estado', 'activo')->get();
        return view('inscripciones.inscripcionesCrear', compact('eventos'));
    }

    // Guardar inscripción
    public function store(Request $request){

    $this->autorizarParticipante();
    $request->validate([
        'evento_id' => 'required|exists:eventos,id',
        'estado' => 'required|in:pendiente,confirmada,cancelada', 
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
        'estado' => $request->estado, 
    ]);

    return redirect()->route('inscripciones.index')->with('success', 'Inscripción registrada.');
    }


    // Formulario para editar inscripción
    public function edit($id)
    {
        $this->autorizarParticipante();

        $inscripcion = Inscripcion::findOrFail($id);

        if (Auth::id() !== $inscripcion->user_id) {
            abort(403, 'Acceso no autorizado.');
        }

        return view('inscripciones.inscripcionesEditar', compact('inscripcion'));
    }

    // Guardar edición
    public function update(Request $request, $id)
    {
        $this->autorizarParticipante();

        $inscripcion = Inscripcion::findOrFail($id);

        if (Auth::id() !== $inscripcion->user_id) {
            abort(403, 'Acceso no autorizado.');
        }

        $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required|in:pendiente,confirmada,cancelada', 
        ]);

        $inscripcion->update([
            'fecha' => $request->fecha,
            'estado' => $request->estado,
        ]);

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción actualizada.');
    }

    // Cancelar inscripción
    public function destroy($id)
    {
        $this->autorizarParticipante();

        $inscripcion = Inscripcion::findOrFail($id);

        if (Auth::id() !== $inscripcion->user_id) {
            abort(403, 'Acceso no autorizado.');
        }

        $inscripcion->delete();
        return redirect()->route('inscripciones.index')->with('success', 'Inscripción cancelada.');
    }

    // Métodos de autorización 

    private function autorizarAdmin()
    {
        if (Auth::user()->rol !== 'administrador') {
            abort(403, 'Acceso no autorizado.');
        }
    }

    private function autorizarParticipante()
    {
        if (Auth::user()->rol !== 'participante') {
            abort(403, 'Acceso no autorizado.');
        }
    }
}
