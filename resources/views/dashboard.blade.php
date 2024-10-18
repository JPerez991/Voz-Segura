@vite(['resources/css/app.css', 'resources/js/app.js'])
@extends('layouts.app')

@section('content')
    <body class="min-h-screen bg-gradient-to-br from-purple-50 to-indigo-100">

    <div class="container mx-auto p-4">
        <!-- Usamos el componente ProfileCard y pasamos la información del perfil -->
        <x-profile-card :profile="$profile" />
        <!-- Fin de la sección del perfil -->
    </div>

    <main class="container mx-auto px-4 py-12">
        <!-- Sección de Bienvenida -->
        <section class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-purple-900 mb-4">Tu espacio seguro</h1>
          
        </section>

        <!-- Sección de Servicios -->
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Tarjeta Chat de Apoyo -->
            <a href="{{ route('messages.index') }}" class="block group">
                <x-card class="transition transform hover:scale-105">
                    <x-card-header>
                        <x-card-title>
                            <x-message-circle class="h-6 w-6 text-purple-600" />
                            <span>Chat de Apoyo</span>
                        </x-card-title>
                    </x-card-header>
                    <x-card-content>
                        <p class="text-gray-600">Conéctate con otros en nuestro chat seguro y moderado. Comparte experiencias y encuentra apoyo mutuo.</p>
                    </x-card-content>
                </x-card>
            </a>

            <!-- Tarjeta Grupos Temáticos -->
            <a href="{{ route('forums.index') }}" class="block group">
                <x-card class="transition transform hover:scale-105">
                    <x-card-header>
                        <x-card-title>
                            <x-users class="h-6 w-6 text-purple-600" />
                            <span>Grupos Temáticos</span>
                        </x-card-title>
                    </x-card-header>
                    <x-card-content>
                        <p class="text-gray-600">Únete a grupos específicos según tus intereses o necesidades. Encuentra personas que entienden tu situación.</p>
                    </x-card-content>
                </x-card>
            </a>

            <!-- Tarjeta Sesiones Programadas -->
            <a href="{{ route('forums.index') }}" class="block group">
                <x-card class="transition transform hover:scale-105">
                    <x-card-header>
                        <x-card-title>
                            <x-calendar-icon class="h-6 w-6 text-purple-600" />
                            <span>Sesiones Programadas</span>
                        </x-card-title>
                    </x-card-header>
                    <x-card-content>
                        <p class="text-gray-600">Participa en sesiones guiadas por profesionales. Aprende técnicas de afrontamiento y crecimiento personal.</p>
                    </x-card-content>
                </x-card>
            </a>

            <!-- Tarjeta Recursos de Seguridad -->
            <a href="{{ route('forums.index') }}" class="block group">
                <x-card class="transition transform hover:scale-105">
                    <x-card-header>
                        <x-card-title>
                            <x-shield-icon class="h-6 w-6 text-purple-600" />
                            <span>Recursos de Seguridad</span>
                        </x-card-title>
                    </x-card-header>
                    <x-card-content>
                        <p class="text-gray-600">Accede a información vital y recursos de ayuda. Tu seguridad y bienestar son nuestra prioridad.</p>
                    </x-card-content>
                </x-card>
            </a>
        </div>

        <!-- Sección de Llamada a la Acción -->
    
    </main>

    <footer class="bg-purple-900 text-purple-100 mt-16">
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <!-- Puedes quitar el ícono si no quieres el logo aquí -->
                    <span class="text-xl font-semibold">Voz Segura</span>
                </div>
                <nav class="flex space-x-4">
                    <a href="#" class="text-sm hover:text-white transition-colors duration-200">Acerca de</a>
                    <a href="#" class="text-sm hover:text-white transition-colors duration-200">Contacto</a>
                    <a href="#" class="text-sm hover:text-white transition-colors duration-200">Privacidad</a>
                    <a href="#" class="text-sm hover:text-white transition-colors duration-200">Términos</a>
                </nav>
            </div>
        </div>
    </footer>
@endsection
