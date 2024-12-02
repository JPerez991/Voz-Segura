<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold text-purple-800 mb-4">Bienvenido, {{ auth()->user()->nombre_usuario }}</h1>
    
    <!-- Sección con imagen de fondo ajustada -->
    <section class="relative bg-white shadow rounded-lg p-6" 
             style="background-image: url('{{ asset('img/vista-login/ojos1.jpg') }}'); 
                    background-size: 80%; /* Ajusta el tamaño al 80% del contenedor */
                    background-position: right center; /* Mueve la imagen hacia la derecha y la centra verticalmente */
                    background-repeat: no-repeat;">

        <header>
            <h2 class="text-lg font-medium text-purple-900 mb-5">
                {{ __('⭐Profile Information') }}
            </h2>

          
        </header>

        <div class="space-y-2">
            <!-- Mostrar Descripción del Perfil -->
            <p class="text-gray-800"><strong>{{ __('') }}</strong> {{ $profile->descripcion ?? '' }}</p>

            <!-- Mostrar Nombre Anónimo si está definido -->
            <p class="text-gray-800"><strong>{{ __('Nombre Anónimo:') }}</strong> {{ $profile->nombre_anonimo ?? 'NO' }}</p>

            <!-- Mostrar Rol del Usuario -->
            <p class="text-gray-800"><strong>{{ __('Rol:') }}</strong> {{ auth()->user()->rol }}</p>
        </div>
    </section>
</div>
