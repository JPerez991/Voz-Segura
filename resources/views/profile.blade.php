@extends('layouts.app')

@section('content')
<section class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-8">
    <header>
        <h2 class="text-2xl font-semibold text-purple-700">
            Perfil de Usuario
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Actualizá la información de tu cuenta.
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="nombre_usuario" class="block text-sm font-medium text-purple-600">Nombre de Usuario</label>
            <input id="nombre_usuario" name="nombre_usuario" type="text" value="{{ Auth::user()->nombre_usuario ?? '' }}" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" readonly disabled />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-purple-600">Correo Electrónico</label>
            <input id="email" name="email" type="email" value="{{ Auth::user()->email ?? '' }}" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required />
        </div>

        <div>
            <label for="nombre_completo" class="block text-sm font-medium text-purple-600">Nombre Completo</label>
            <input id="nombre_completo" name="nombre_completo" type="text" value="{{ $profile->nombre_completo ?? '' }}" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" />
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-purple-600">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" rows="3">{{ $profile->descripcion ?? '' }}</textarea>
        </div>

        <div id="anonimo-field" @if(Auth::user()->rol !== 'usuaria') style="display:none" @endif>
            <label for="nombre_anonimo" class="block text-sm font-medium text-purple-600">Nombre Anónimo</label>
            <input id="nombre_anonimo" name="nombre_anonimo" type="text" value="{{ $profile->nombre_anonimo ?? '' }}" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" />
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('profile.edit') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 text-center">
                Editar Perfil
            </a>
        </div>
    </form>
</section>
@endsection
