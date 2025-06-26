@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto mt-8 p-6 bg-white rounded-2xl shadow-xl">
    <h2 class="text-2xl font-semibold mb-4">Registrar Recurso</h2>
    <form action="#" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nombre" class="block font-medium">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="w-full border rounded-lg p-2">
        </div>
        <div class="mb-4">
            <label for="tipo" class="block font-medium">Tipo</label>
            <input type="text" name="tipo" id="tipo" class="w-full border rounded-lg p-2">
        </div>
        <div class="mb-6">
            <label for="cantidad" class="block font-medium">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="w-full border rounded-lg p-2">
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Registrar</button>
    </form>
</div>
@endsection