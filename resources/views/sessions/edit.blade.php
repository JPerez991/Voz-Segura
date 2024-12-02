@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-6 p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Editar Sesión</h1>
        <form action="{{ route('sessions.update', $session->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="psicologa_id" class="block text-gray-700">Psicóloga</label>
                <select class="form-control block w-full mt-1 p-2 border border-gray-300 rounded-lg" id="psicologa_id" name="psicologa_id" required>
                    @foreach($psicologas as $psicologa)
                        <option value="{{ $psicologa->id }}" {{ $session->psicologa_id == $psicologa->id ? 'selected' : '' }}>{{ $psicologa->nombre_usuario }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="usuario_id" class="block text-gray-700">Usuario</label>
                <select class="form-control block w-full mt-1 p-2 border border-gray-300 rounded-lg" id="usuario_id" name="usuario_id" required>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ $session->usuario_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->nombre_usuario }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="tipo_sesion" class="block text-gray-700">Tipo de Sesión</label>
                <input type="text" class="block w-full mt-1 p-2 border border-gray-300 rounded-lg" id="tipo_sesion" name="tipo_sesion" value="{{ $session->tipo_sesion }}" required>
            </div>
            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700">Descripción</label>
                <textarea class="block w-full mt-1 p-2 border border-gray-300 rounded-lg" id="descripcion" name="descripcion">{{ $session->descripcion }}</textarea>
            </div>
            <div class="mb-4">
                <label for="fecha_hora" class="block text-gray-700">Fecha y Hora</label>
                <input type="datetime-local" class="block w-full mt-1 p-2 border border-gray-300 rounded-lg" id="fecha_hora" name="fecha_hora" value="{{ $session->fecha_hora->format('Y-m-d\TH:i') }}" required>
            </div>
            <button type="submit" class="btn btn-primary inline-block px-6 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg">Actualizar Sesión</button>
        </form>
    </div>
@endsection
