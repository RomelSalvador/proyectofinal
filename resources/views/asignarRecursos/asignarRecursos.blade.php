@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto mt-8 p-6 bg-white rounded-2xl shadow-xl">
    <h2 class="text-2xl font-semibold mb-4">Asignar Recurso a Evento</h2>
    <form action="#" method="POST">
        @csrf
        <div class="mb-4">
            <label for="evento_id" class="block font-medium">Evento</label>
            <select name="evento_id" id="evento_id" class="w-full border rounded-lg p-2">
                <option>Seleccionar evento</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="recurso_id" class="block font-medium">Recurso</label>
            <select name="recurso_id" id="recurso_id" class="w-full border rounded-lg p-2">
                <option>Seleccionar recurso</option>
            </select>
        </div>
        <div class="mb-6">
            <label for="cantidad" class="block font-medium">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="w-full border rounded-lg p-2">
        </div>
        <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700">Asignar</button>
    </form>
</div>
@endsection