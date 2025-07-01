@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-lg">
        <h4 class="text-center fw-bold mb-4 text-uppercase">Lista de Recursos</h4>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-end mb-3">
            <a href="{{ route('recursos.create') }}" class="btn btn-success">+ Crear Recurso</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recursos as $recurso)
                        <tr class="text-center">
                            <td>{{ $recurso->nombre }}</td>
                            <td>{{ $recurso->descripcion }}</td>
                            <td>{{ $recurso->tipo }}</td>
                            <td>{{ $recurso->cantidad }}</td>
                            <td>
                                <a href="{{ route('recursos.edit', $recurso->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('recursos.destroy', $recurso->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este recurso?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No hay recursos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
