@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-6">Crear un Nuevo Foro</h2>

        <form method="POST" action="{{ route('forums.store') }}">
            @csrf
            <div class="mb-4">
                <label for="tema" class="block text-sm font-medium text-gray-700">Título del Foro</label>
                <input type="text" name="tema" id="tema" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Crear Foro</button>
            </div>
        </form>
    </div>
@endsection
