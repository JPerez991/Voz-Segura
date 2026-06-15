<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'VozSegura') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet"> <!-- Cambié esto -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body  class="font-delius antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
<script>
(function() {
    var raw = localStorage.getItem('voz_currentUser');
    var path = window.location.pathname;
    var publicPages = ['/', '/login', '/register', '/welcome2'];

    if (!raw && publicPages.indexOf(path) === -1) {
        window.location.href = '/login';
        return;
    }
    if (!raw) return;

    var user = JSON.parse(raw);

    var navEl = document.getElementById('nav-username');
    if (navEl) navEl.textContent = user.nombre_usuario || 'Usuario';

    if (path === '/dashboard') {
        var container = document.getElementById('profile-card-container');
        if (container) {
            var card = document.createElement('div');
            card.className = 'bg-white rounded-lg shadow-md p-6 flex items-center space-x-4';
            card.innerHTML = '<div class="w-16 h-16 rounded-full bg-purple-200 flex items-center justify-center text-2xl font-bold text-purple-700">' +
                (user.nombre_completo ? user.nombre_completo.charAt(0) : user.nombre_usuario.charAt(0)) +
                '</div>' +
                '<div>' +
                '<h2 class="text-xl font-semibold text-purple-900">' + (user.nombre_completo || user.nombre_usuario) + '</h2>' +
                '<p class="text-sm text-purple-600">' + (user.rol === 'psicologa' ? 'Psicóloga' : 'Usuaria') + '</p>' +
                '<p class="text-sm text-gray-500">' + (user.descripcion || '') + '</p>' +
                '</div>';
            container.appendChild(card);
        }
    }
})();
</script>
    </body>
</html>

