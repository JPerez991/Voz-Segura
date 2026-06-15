@vite(['resources/css/app.css', 'resources/js/app.js'])
@extends('layouts.app')

@section('content')
    <!-- Session Status -->

    <form method="POST" action="{{ route('register') }}" class="bg-white p-8 rounded-lg shadow-lg max-w-xl mx-auto ">
        @csrf

        <!-- Nombre de Usuario -->
        <div class="mb-4">
            <x-input-label for="nombre_usuario" :value="__('Nombre de Usuario')" class="text-purple-600" />
            <x-text-input id="nombre_usuario" class="block mt-1 w-full border-2 border-gray-300 rounded-md p-2" type="text" name="nombre_usuario" :value="old('nombre_usuario')" required autofocus />
            <x-input-error :messages="$errors->get('nombre_usuario')" class="mt-2 text-red-500" />
        </div>

        <!-- Correo Electrónico -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" class="text-purple-600" />
            <x-text-input id="email" class="block mt-1 w-full border-2 border-gray-300 rounded-md p-2" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Contraseña -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Contraseña')" class="text-purple-600" />
            <x-text-input id="password" class="block mt-1 w-full border-2 border-gray-300 rounded-md p-2" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Confirmar Contraseña -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-purple-600" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-2 border-gray-300 rounded-md p-2" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <!-- Rol -->
        <div class="mb-4">
            <x-input-label for="rol" :value="__('Rol')" class="text-purple-600" />
            <select id="rol" name="rol" class="block mt-1 w-full border-2 border-gray-300 rounded-md p-2" required onchange="toggleAnonimoField()">
                <option value="usuaria">Usuaria</option>
                <option value="psicóloga">Psicóloga</option>
             <!--   <option value="admin">Admin</option> -->
            </select>
            <x-input-error :messages="$errors->get('rol')" class="mt-2 text-red-500" />
        </div>

        <!-- Anonimato (solo para Usuaria) -->
        <div class="mb-4" id="anonimo-field" style="display: none;">
            <x-input-label for="es_anonimo" :value="__('Desea ser anónimo?')" class="text-purple-600" />
            <select id="es_anonimo" name="es_anonimo" class="block mt-1 w-full border-2 border-gray-300 rounded-md p-2">
                <option value="0">No</option>
                <option value="1">Sí</option>
            </select>
            <x-input-error :messages="$errors->get('es_anonimo')" class="mt-2 text-red-500" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-purple-600 hover:text-purple-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500" href="{{ route('login') }}">
                {{ __('Ya estás registrado?') }}
            </a>

            <x-primary-button class="ml-3 bg-purple-600 text-white hover:bg-purple-700 focus:ring-2 focus:ring-yellow-500">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
    </div>

    @endsection

<script>
    function toggleAnonimoField() {
        var rol = document.getElementById('rol').value;
        var anonimoField = document.getElementById('anonimo-field');
        anonimoField.style.display = rol === 'usuaria' ? 'block' : 'none';
    }
    window.onload = toggleAnonimoField;

    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        var username = document.getElementById('nombre_usuario').value.trim();
        var email = document.getElementById('email').value.trim();
        var password = document.getElementById('password').value;
        var passwordConf = document.getElementById('password_confirmation').value;
        var rol = document.getElementById('rol').value;
        var esAnonimo = document.getElementById('es_anonimo') ? document.getElementById('es_anonimo').value : '0';

        if (password !== passwordConf) {
            alert('Las contraseñas no coinciden.');
            return;
        }
        if (username.length < 3) {
            alert('El nombre de usuario debe tener al menos 3 caracteres.');
            return;
        }

        var users = JSON.parse(localStorage.getItem('voz_users') || '[]');
        if (users.some(function(u) { return u.nombre_usuario === username; })) {
            alert('El nombre de usuario ya existe.');
            return;
        }

        var newUser = {
            id: users.length + 1,
            nombre_usuario: username,
            email: email,
            password: password,
            rol: rol === 'psicóloga' ? 'psicologa' : 'usuaria',
            es_anonimo: parseInt(esAnonimo),
            nombre_completo: '',
            descripcion: '',
            nombre_anonimo: esAnonimo === '1' ? 'Anónima' : null
        };
        users.push(newUser);
        localStorage.setItem('voz_users', JSON.stringify(users));
        localStorage.setItem('voz_currentUser', JSON.stringify(newUser));
        window.location.href = '/dashboard';
    });
</script>
