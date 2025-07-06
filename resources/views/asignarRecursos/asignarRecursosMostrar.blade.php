@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="bg-white p-5 rounded-4 shadow-lg">
        <h4 class="text-center mb-4 text-uppercase fw-bold">Recursos Asignados a Eventos</h4>

        @if(session('success'))
            <div class="alert alert-success text-center fw-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-primary text-uppercase">
                    <tr>
                        <th>#</th>
                        <th>Evento</th>
                        <th>Recurso</th>
                        <th>Cantidad Asignada</th>
                        <th>Fecha Asignación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($asignaciones as $asignacion)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $asignacion->evento->titulo }}</td>
                            <td>{{ $asignacion->recurso->nombre }}</td>
                            <td>{{ $asignacion->cantidad }}</td>
                            <td>{{ $asignacion->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('asignarRecursos.edit', ['evento_id' => $asignacion->evento_id, 'recurso_id' => $asignacion->recurso_id]) }}"
                                    class="btn btn-sm btn-primary px-3 rounded-pill">
                                    Editar
                                </a>

                                <form action="{{ route('asignarRecursos.destroy', ['evento_id' => $asignacion->evento_id, 'recurso_id' => $asignacion->recurso_id]) }}" 
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger px-3 rounded-pill" onclick="return confirm('¿Eliminar esta asignación?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted text-center py-3">No hay recursos asignados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
