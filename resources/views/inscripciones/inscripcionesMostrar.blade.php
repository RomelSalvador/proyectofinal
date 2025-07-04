@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-lg">
        <h4 class="text-center fw-bold mb-4 text-uppercase">Inscripciones</h4>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Evento</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inscripciones as $inscripcion)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $inscripcion->evento->titulo ?? 'No disponible' }}</td>
                            <td>{{ $inscripcion->fecha }}</td>
                            <td class="text-capitalize">{{ $inscripcion->estado }}</td>
                            <td>
                                <a href="{{ route('inscripciones.edit', $inscripcion->id) }}" class="btn btn-warning btn-sm">Editar</a>

                                <form action="{{ route('inscripciones.destroy', $inscripcion->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Cancelar esta inscripción?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Cancelar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">No tienes inscripciones registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
