<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotificacionInscripcionEvento;


class InscripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar inscripciones
    public function index()
    {
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
    public function store(Request $request)
{
    $this->autorizarParticipante();

    $request->validate([
        'evento_id' => 'required|exists:eventos,id',
    ]);

    $evento = Evento::findOrFail($request->evento_id);

    // Verificar si el evento está activo
    if ($evento->estado !== 'activo') {
        return redirect()->back()->with('error', 'El evento no está disponible para inscripciones.');
    }

    // Verificar si el aforo está completo
    $inscritos = Inscripcion::where('evento_id', $evento->id)->count();
    if ($inscritos >= $evento->aforo) {
        return redirect()->back()->with('error', 'El aforo del evento ya está completo.');
    }

    // Verificar si el usuario ya está inscrito
    $yaInscrito = Inscripcion::where('user_id', Auth::id())
        ->where('evento_id', $evento->id)
        ->exists();

    if ($yaInscrito) {
        return redirect()->back()->with('error', 'Ya estás inscrito en este evento.');
    }

    // Registrar inscripción
    Inscripcion::create([
        'user_id' => Auth::id(),
        'evento_id' => $evento->id,
        'fecha' => now()->toDateString(),
        'estado' => 'pendiente',
    ]);


    Auth::user()->notify(new NotificacionInscripcionEvento($evento));

        return redirect()->route('inscripciones.index')->with('success', 'Inscripción registrada. Revisa tus notificaciones.');
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
