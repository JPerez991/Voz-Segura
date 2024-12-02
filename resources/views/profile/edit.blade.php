@extends('layouts.app')

@section('content')
<section class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <header>
        <h2 class="text-2xl font-semibold text-purple-700">
            {{ __('Profile Information') }}
        </h2>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Nombre Completo -->
        <div>
            <x-input-label for="nombre_completo" :value="__('Full Name')" class="text-purple-600" />
            <x-text-input id="nombre_completo" name="nombre_completo" type="text" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" :value="old('nombre_completo', $profile->nombre_completo)" required autofocus />
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('nombre_completo')" />
        </div>

        <!-- Descripción -->
        <div>
            <x-input-label for="descripcion" :value="__('Description')" class="text-purple-600" />
            <x-text-input id="descripcion" name="descripcion" type="text" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" :value="old('descripcion', $profile->descripcion)" required />
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('descripcion')" />
        </div>

        @if (auth()->user()->rol === 'usuaria')
            <div>
                <x-input-label for="nombre_anonimo" :value="__('Anonymous Name')" class="text-purple-600" />
                <x-text-input id="nombre_anonimo" name="nombre_anonimo" type="text" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" :value="old('nombre_anonimo', $profile->nombre_anonimo)" />
                <x-input-error class="mt-2 text-red-600" :messages="$errors->get('nombre_anonimo')" />
            </div>
        @endif

        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-purple-600" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" :value="old('email', auth()->user()->email)" required />
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Contraseña')" class="text-purple-600" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" autocomplete="new-password" />
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-purple-600" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" autocomplete="new-password" />
            <x-input-error class="mt-2 text-red-600" :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-purple-600 hover:bg-purple-700 text-white">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
@endsection
