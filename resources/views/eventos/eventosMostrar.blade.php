@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="bg-white p-5 rounded-4 shadow-lg">
        <h4 class="text-center mb-4 text-uppercase fw-bold">Lista de Eventos</h4>

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
                        <th>Título</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Ubicación</th>
                        <th>Aforo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($eventos as $evento)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $evento->titulo }}</td>
                            <td class="text-capitalize">{{ $evento->tipo }}</td>
                            <td>{{ $evento->fecha }}</td>
                            <td>{{ $evento->hora }}</td>
                            <td>{{ $evento->ubicacion }}</td>
                            <td>{{ $evento->aforo }}</td>
                            <td class="text-capitalize">{{ $evento->estado }}</td>
                            <td>
                                <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este evento?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger px-3 rounded-pill">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-muted text-center py-3">No hay eventos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
