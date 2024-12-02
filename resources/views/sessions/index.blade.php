@extends('layouts.app')

@section('content')
    <div class="container mx-auto my-6 p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-gray-700 mb-4">Sesiones Programadas</h1>
        <a href="{{ route('sessions.create') }}" class="btn btn-primary inline-block px-6 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg mb-4">
            Programar nueva sesión
        </a>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-indigo-100 text-gray-700">
                        <th class="px-4 py-2 text-left">Psicóloga</th>
                        <th class="px-4 py-2 text-left">Usuario</th>
                        <th class="px-4 py-2 text-left">Tipo de Sesión</th>
                        <th class="px-4 py-2 text-left">Fecha y Hora</th>
                        <th class="px-4 py-2 text-left">Estado</th>
                        <th class="px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessions as $session)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $session->psicologa->nombre_usuario }}</td>
                            <td class="px-4 py-2">{{ $session->usuario->nombre_usuario }}</td>
                            <td class="px-4 py-2">{{ $session->tipo_sesion }}</td>
                            <td class="px-4 py-2">{{ $session->fecha_hora }}</td>
                            <td class="px-4 py-2">
                                <span class="{{ $session->completada ? 'text-green-500' : 'text-yellow-500' }}">
                                    {{ $session->completada ? 'Completada' : 'Pendiente' }}
                                </span>
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('sessions.edit', $session->id) }}" class="text-yellow-600 hover:text-yellow-700 px-4 py-2 border border-yellow-600 rounded-lg">
                                    Editar
                                </a>
                                <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700 px-4 py-2 border border-red-600 rounded-lg">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
