<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    @include('layouts.navigation') <!-- Incluye la navegación aquí -->

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold">Bienvenido, {{ $user->name }}</h1>
        <h2 class="text-xl">Perfil</h2>

        <section>
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Profile Information') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __("Update your account's profile information and email address.") }}
                </p>
            </header>

            <!-- Formulario para enviar la verificación de correo -->
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <!-- Formulario para actualizar el perfil -->
            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <!-- Campo Nombre -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <!-- Campo Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    <!-- Verificación de correo electrónico -->
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Campo Nombre Completo -->
                <div>
                    <x-input-label for="nombre_completo" :value="__('Nombre Completo')" />
                    <x-text-input id="nombre_completo" name="nombre_completo" type="text" class="mt-1 block w-full" :value="old('nombre_completo', $profile->nombre_completo)" />
                    <x-input-error class="mt-2" :messages="$errors->get('nombre_completo')" />
                </div>

                <!-- Campo Descripción -->
                <div>
                    <x-input-label for="descripcion" :value="__('Descripción')" />
                    <x-text-input id="descripcion" name="descripcion" type="text" class="mt-1 block w-full" :value="old('descripcion', $profile->descripcion)" />
                    <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
                </div>

                <!-- Campo Nombre Anónimo -->
                <div>
                    <x-input-label for="nombre_anonimo" :value="__('Nombre Anónimo')" />
                    <x-text-input id="nombre_anonimo" name="nombre_anonimo" type="text" class="mt-1 block w-full" :value="old('nombre_anonimo', $profile->nombre_anonimo)" />
                    <x-input-error class="mt-2" :messages="$errors->get('nombre_anonimo')" />
                </div>

                <!-- Botón Guardar -->
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600"
                        >{{ __('Saved.') }}</p>
                    @endif
                </div>
            </form>
        </section>
    </div>
</body>
</html>
