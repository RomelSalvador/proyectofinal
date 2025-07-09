<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Inscripcion;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->rol === 'administrador') {
            return $this->adminDashboard();
        } else {
            return $this->participanteHome();
        }
    }

    private function adminDashboard()
    {
        // Estadísticas generales
        $totalEventos = Evento::count();
        $totalParticipantes = User::where('rol', 'participante')->count();
        $totalInscripciones = Inscripcion::count();

        // Eventos recientes
        $eventosRecientes = Evento::latest()->take(5)->get();

        //Cantidad de eventos por tipo
        $eventosPorTipo = Evento::selectRaw('tipo, COUNT(*) as total')
            ->groupBy('tipo')
            ->pluck('total', 'tipo')
            ->toArray();

        $inscripcionesPorMes = Inscripcion::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->pluck('total', 'mes')
            ->toArray();

        return view('adminHome', compact(
            'totalEventos',
            'totalParticipantes',
            'totalInscripciones',
            'eventosRecientes',
            'eventosPorTipo',
            'inscripcionesPorMes'
        ));
    }

    private function participanteHome()
    {
        $eventosDestacados = Evento::where('estado', 'activo')
            ->latest()
            ->take(4)
            ->get();

        return view('participanteHome', compact('eventosDestacados'));
    }
}
