<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SafeHaven</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>





    <body class="min-h-screen bg-gradient-to-br from-purple-50 to-indigo-100">
        <header class="bg-white shadow-sm">
            <div class="container mx-auto px-4 py-6 flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <x-heart-icon class="h-8 w-8 text-purple-600" />
                    <span class="text-2xl font-bold text-purple-800">Voz Segura</span>
                </div>
                <nav>
                <a href="{{ route('login') }}">
                    <x-button variant="ghost">Iniciar Sesión</x-button>
                    <x-button class="ml-2">Registrarse</x-button>
                 </a>
                </nav>
            </div>
        </header>





        <main class="container mx-auto px-4 py-12">
    <!-- Sección de Bienvenida -->
    <section class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-bold text-purple-900 mb-4">Bienvenido a tu espacio seguro</h1>
        <p class="text-xl text-purple-700 max-w-2xl mx-auto">
            Voz Segura es una plataforma de apoyo donde puedes compartir, conectar y crecer en un ambiente de confianza y comprensión.
        </p>
    </section>

    <!-- Sección de Servicios -->
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <x-card>
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

        <x-card>
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

        <x-card>
            <x-card-header>
                <x-card-title>
                    <x-calendar-icon class="h-6 w-6  " />
                    <span>Sesiones Programadas</span>
                </x-card-title>
            </x-card-header>
            <x-card-content>
                <p class="text-gray-600">Participa en sesiones guiadas por profesionales. Aprende técnicas de afrontamiento y crecimiento personal.</p>
            </x-card-content>
        </x-card>

        <x-card>
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
    </div>

    <!-- Sección de Llamada a la Acción -->
    <section class="mt-16 text-center">
        <h2 class="text-3xl font-semibold text-purple-800 mb-4">Comienza tu viaje hacia el bienestar</h2>
        <p class="text-lg text-purple-700 mb-6">Únete a nuestra comunidad de apoyo y descubre un lugar donde puedes ser tú mismo/a.</p>
        <a href="{{ route('register') }}">
              <x-button-d size="lg" class="bg-purple-600 hover:bg-purple-700 text-white">Únete Ahora</x-button-d>
         </a>
    </section>
</main>


<footer class="bg-purple-900 text-purple-100 mt-16">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <!-- Puedes quitar el ícono si no quieres el logo aquí -->
                <span class="text-xl font-semibold">Vos Segura</span>
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
