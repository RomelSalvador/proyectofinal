@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-lg">
        <h4 class="text-center fw-bold mb-4 text-uppercase">Lista de Inscripciones</h4>

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
                        <th>Usuario</th>
                        <th>Evento</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inscripciones as $inscripcion)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $inscripcion->user->nombre ?? 'No disponible' }}</td>
                            <td>{{ $inscripcion->evento->titulo ?? 'No disponible' }}</td>
                            <td>{{ $inscripcion->fecha }}</td>
                            <td class="text-capitalize">{{ $inscripcion->estado }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">No hay inscripciones registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
