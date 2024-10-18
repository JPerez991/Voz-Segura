<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold text-purple-800 mb-4">Bienvenido, {{ auth()->user()->nombre_usuario }}</h1>
    
    <section class="bg-white shadow rounded-lg p-6">
        <header>
            <h2 class="text-lg font-medium text-purple-900 mb-2">
                {{ __('Profile Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 mb-4">
                {{ __("Here's your profile information.") }}
            </p>
        </header>

        <div class="space-y-2">
            <!-- Mostrar Descripción del Perfil -->
            <p class="text-gray-800"><strong>{{ __('Descripción:') }}</strong> {{ $profile->descripcion ?? '' }}</p>

            <!-- Mostrar Nombre Anónimo si está definido -->
            <p class="text-gray-800"><strong>{{ __('Nombre Anónimo:') }}</strong> {{ $profile->nombre_anonimo ?? 'N/A' }}</p>

            <!-- Mostrar Rol del Usuario -->
            <p class="text-gray-800"><strong>{{ __('Rol:') }}</strong> {{ auth()->user()->rol }}</p>
        </div>
    </section>
</div>
