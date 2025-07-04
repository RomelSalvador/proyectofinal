@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="bg-white p-5 rounded-4 shadow-lg w-100" style="max-width: 500px;">
        <h4 class="text-center mb-4 text-uppercase fw-bold">Inscribirse a un evento</h4>

        <form action="{{ route('inscripciones.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="evento_id" class="form-label fw-semibold">Evento</label>
                <select name="evento_id" id="evento_id" class="form-select" required>
                    <option disabled selected>Seleccionar evento</option>
                    @foreach($eventos as $evento)
                        <option value="{{ $evento->id }}">{{ $evento->titulo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label fw-semibold">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="estado" class="form-label fw-semibold">Estado de inscripción</label>
                <select name="estado" id="estado" class="form-select" required>
                    <option value="pendiente">Pendiente</option>
                    <option value="confirmada">Confirmada</option>
                    <option value="cancelada">Cancelada</option>
                </select>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary px-4">Inscribirse</button>
            </div>
        </form>
    </div>
</div>
@endsection
