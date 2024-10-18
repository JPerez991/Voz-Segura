<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> <!-- Fuente de Google Fonts -->
    <link rel="stylesheet" href="ruta/a/tu/estilo.css"> <!-- Cambia esto por la ruta a tu archivo CSS -->
    <title>Título de tu aplicación</title>
    <style>
        /* Estilo global para cambiar la fuente */
        body {
            font-family: 'Roboto', sans-serif;
            /* Cambia 'Roboto' por la fuente que desees */
        }

        .nav-link,
        .dropdown-link,
        .responsive-nav-link {
            font-family: 'Roboto', sans-serif;
            /* Cambia 'Roboto' por la fuente que desees */
        }
    </style>
</head>

<body>
    <nav x-data="{ open: false }" class="bg-purple-50 border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center space-x-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center">
                            <x-logo-heart class="block h-9 w-auto fill-current text-purple-800" /> <!-- Logo -->
                            <span class="text-2xl font-bold text-purple-800">Voz Segura</span> <!-- Texto -->
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-purple-800">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-purple-600 bg-white hover:text-purple-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::check() ? Auth::user()->nombre_usuario : 'Invitado' }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4 text-purple-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if(auth()->check())
                            <x-dropdown-link :href="route('profile.edit')" class="text-purple-800">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                        this.closest('form').submit();" class="text-purple-800">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                            @else
                            <x-dropdown-link :href="route('login')" class="text-purple-800">
                                {{ __('Login') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')" class="text-purple-800">
                                {{ __('Register') }}
                            </x-dropdown-link>
                            @endif
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-purple-400 hover:text-purple-500 hover:bg-purple-100 focus:outline-none focus:bg-purple-100 focus:text-purple-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-purple-800">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    @if(auth()->check())
                    <div class="font-medium text-base text-purple-800">{{ Auth::user()->nombre_usuario }}</div>
                    <div class="font-medium text-sm text-purple-600">{{ Auth::user()->email }}</div>
                    @else
                    <div class="font-medium text-base text-purple-800">Invitado</div>
                    @endif
                </div>

                <div class="mt-3 space-y-1">
                    @if(auth()->check())
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-purple-800">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-purple-800">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                    @else
                    <x-responsive-nav-link :href="route('login')" class="text-purple-800">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="text-purple-800">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</body>

</html>