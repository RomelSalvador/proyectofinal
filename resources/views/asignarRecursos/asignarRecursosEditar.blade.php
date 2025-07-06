@extends('layouts.app')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="w-50">
        <h4 class="text-center mb-5 text-uppercase fw-bold">Editar Asignación de Recurso</h4>

        <form action="{{ route('asignarRecursos.update', ['evento_id' => $evento->id, 'recurso_id' => $recurso_id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="evento_id" class="form-label fw-bold">Evento:</label>
                <select name="evento_id" id="evento_id" class="form-control w-100" required>
                    <option value="">Seleccionar evento</option>
                    @foreach($eventos as $ev)
                        <option value="{{ $ev->id }}" {{ (old('evento_id', $evento->id) == $ev->id) ? 'selected' : '' }}>
                            {{ $ev->titulo }}
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
                    @foreach($recursos as $re)
                        <option value="{{ $re->id }}" {{ (old('recurso_id', $recurso_id) == $re->id) ? 'selected' : '' }}>
                            {{ $re->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('recurso_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cantidad" class="form-label fw-bold">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control w-100" value="{{ old('cantidad', $cantidad) }}" required min="1">
                @error('cantidad')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success rounded-pill px-4">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection
