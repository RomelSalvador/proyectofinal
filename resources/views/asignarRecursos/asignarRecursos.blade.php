@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">

        <h4 class="text-center mb-5 text-uppercase fw-bold">Asignar Recurso a Evento</h4>

        <form action="{{ route('asignarRecursos.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="evento_id" class="form-label fw-bold">Evento:</label>
                <select name="evento_id" id="evento_id" class="form-control w-100" required>
                    <option value="">Seleccionar evento</option>
                    @foreach($eventos as $evento)
                        <option value="{{ $evento->id }}" {{ old('evento_id') == $evento->id ? 'selected' : '' }}>
                            {{ $evento->titulo }}
                        </option>
                    @endforeach
                </select>
                @error('evento_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="recurso_id" class="form-label fw-bold">Recurso:</label>
                <select name="recurso_id" id="recurso_id" class="form-control w-100" required>
                    <option value="">Seleccionar recurso</option>
                    @foreach($recursos as $recurso)
                        <option value="{{ $recurso->id }}" {{ old('recurso_id') == $recurso->id ? 'selected' : '' }}>
                            {{ $recurso->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('recurso_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cantidad" class="form-label fw-bold">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control w-100" value="{{ old('cantidad') }}" min="1" required>
                @error('cantidad')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary rounded-pill px-4">Asignar</button>
            </div>
        </form>
    </div>
</div>
@endsection
