@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">

        <h4 class="text-center mb-5 text-uppercase fw-bold">Asignar Recurso a Evento</h4>

        <form action="{{ route('asignarRecursos.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="evento_id" class="form-label fw-bold">EVENTO:</label>
                <select name="evento_id" id="evento_id" class="form-control w-100">
                    <option value="">Seleccionar evento</option>
                    @foreach($eventos as $evento)
                        <option value="{{ $evento->id }}">{{ $evento->titulo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="recurso_id" class="form-label fw-bold">RECURSO:</label>
                <select name="recurso_id" id="recurso_id" class="form-control w-100">
                    <option value="">Seleccionar recurso</option>
                    @foreach($recursos as $recurso)
                        <option value="{{ $recurso->id }}">{{ $recurso->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="cantidad" class="form-label fw-bold">CANTIDAD:</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control w-100">
            </div>

            
            <div class="text-center">
                <button type="submit" class="btn btn-primary rounded-pill px-4">ASIGNAR</button>
            </div>
        </form>
    </div>
</div>
@endsection
