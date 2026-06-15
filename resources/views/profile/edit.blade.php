@extends('layouts.app')

@section('content')
<section class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-8">
    <header>
        <h2 class="text-2xl font-semibold text-purple-700">
            Editar Perfil
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Actualizá la información de tu cuenta.
        </p>
    </header>

    @if(session('status'))
        <div class="mt-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
            @foreach($errors->all() as $error)
                <p class="text-sm">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="nombre_completo" class="block text-sm font-medium text-purple-600">Nombre Completo</label>
            <input id="nombre_completo" name="nombre_completo" type="text" value="{{ $profile->nombre_completo ?? $user->nombre_usuario ?? '' }}" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required />
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-purple-600">Descripción</label>
            <input id="descripcion" name="descripcion" type="text" value="{{ $profile->descripcion ?? '' }}" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required />
        </div>

        <div id="anonimo-field" @if($user->rol !== 'usuaria') style="display:none" @endif>
            <label for="nombre_anonimo" class="block text-sm font-medium text-purple-600">Nombre Anónimo</label>
            <input id="nombre_anonimo" name="nombre_anonimo" type="text" value="{{ $profile->nombre_anonimo ?? '' }}" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-purple-600">Correo Electrónico</label>
            <input id="email" name="email" type="email" value="{{ $user->email ?? '' }}" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-purple-600">Contraseña</label>
            <input id="password" name="password" type="password" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" autocomplete="new-password" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-purple-600">Confirmar Contraseña</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" autocomplete="new-password" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                Guardar
            </button>
        </div>
    </form>
</section>
@endsection
