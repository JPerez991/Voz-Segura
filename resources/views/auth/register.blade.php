<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre de Usuario -->
        <div>
            <x-input-label for="nombre_usuario" :value="__('Nombre de Usuario')" />
            <x-text-input id="nombre_usuario" class="block mt-1 w-full" type="text" name="nombre_usuario" :value="old('nombre_usuario')" required autofocus />
            <x-input-error :messages="$errors->get('nombre_usuario')" class="mt-2" />
        </div>

        <!-- Correo Electrónico -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Contraseña -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Rol -->
        <div class="mt-4">
            <x-input-label for="rol" :value="__('Rol')" />
            <select id="rol" name="rol" class="block mt-1 w-full" required onchange="toggleAnonimoField()">
                <option value="usuaria">Usuaria</option>
                <option value="psicóloga">Psicóloga</option>
                <option value="admin">Admin</option>
            </select>
            <x-input-error :messages="$errors->get('rol')" class="mt-2" />
        </div>

        <!-- Anonimato (solo para Usuaria) -->
        <div class="mt-4" id="anonimo-field" style="display: none;">
            <x-input-label for="es_anonimo" :value="__('Desea ser anónimo?')" />
            <select id="es_anonimo" name="es_anonimo" class="block mt-1 w-full">
                <option value="0">No</option>
                <option value="1">Sí</option>
            </select>
            <x-input-error :messages="$errors->get('es_anonimo')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Ya estás registrado?') }}
            </a>

            <x-primary-button class="ml-3">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<script>
    // Mostrar/ocultar el campo de anonimato basado en el rol seleccionado
    function toggleAnonimoField() {
        const rol = document.getElementById('rol').value;
        const anonimoField = document.getElementById('anonimo-field');

        if (rol === 'usuaria') {
            anonimoField.style.display = 'block';
        } else {
            anonimoField.style.display = 'none';
        }
    }

    // Ejecutar la función al cargar la página para verificar la opción inicial
    window.onload = toggleAnonimoField;
</script>
