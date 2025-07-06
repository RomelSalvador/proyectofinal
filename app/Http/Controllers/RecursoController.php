<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecursoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar todos los recursos
    public function index()
    {
        $this->autorizarAdmin();
        $recursos = Recurso::all();
        return view('recursos.recursosMostrar', compact('recursos'));
    }

    // Mostrar formulario para crear recurso
    public function create()
    {
        $this->autorizarAdmin();
        return view('recursos.recursosCrear');
    }

    // Guardar nuevo recurso
    public function store(Request $request)
    {
        $this->autorizarAdmin();

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo' => 'required|string|max:100',
            'cantidad' => 'required|integer|min:1',
        ]);

        Recurso::create($request->all());

        return redirect()->route('recursos.index')->with('success', 'Recurso creado correctamente.');
    }

    // Mostrar formulario para editar recurso
    public function edit($id)
    {
        $this->autorizarAdmin();
        $recurso = Recurso::findOrFail($id);
        return view('recursos.recursosEditar', compact('recurso'));
    }

    // Guardar cambios del recurso
    public function update(Request $request, $id)
    {
        $this->autorizarAdmin();

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo' => 'required|string|max:100',
            'cantidad' => 'required|integer|min:1',
        ]);

        $recurso = Recurso::findOrFail($id);
        $recurso->update($request->all());

        return redirect()->route('recursos.index')->with('success', 'Recurso actualizado correctamente.');
    }

    // Eliminar recurso
    public function destroy($id)
    {
        $this->autorizarAdmin();

        $recurso = Recurso::findOrFail($id);
        $recurso->delete();

        return redirect()->route('recursos.index')->with('success', 'Recurso eliminado correctamente.');
    }

    private function autorizarAdmin()
    {
        if (Auth::user()->rol !== 'administrador') {
            abort(403, 'Acceso no autorizado.');
        }
    }
}
