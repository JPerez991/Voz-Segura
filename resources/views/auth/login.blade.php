<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="preload" as="image" href="/img/vista-login/mujerPuerpe.webp" type="image/webp">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Delius', sans-serif;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(4px);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        h1 {
            font-family: 'Delius', sans-serif;
        }
    </style>
</head>

<body class="flex items-center justify-center" style="background-image: url('/img/vista-login/mujerPuerpe.webp');">

    <div class="form-container">
        <h1 class="text-2xl font-bold text-center mb-6">Iniciar Sesión</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="nombre_usuario" class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                <input id="nombre_usuario" name="nombre_usuario" type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required autofocus>
            </div>

            <div class="mb-6">
                <label for="contraseña" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input id="contraseña" name="contraseña" type="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900">¿No tienes una cuenta?</a>
                <button type="submit" class="ml-3 bg-pink-700 text-white px-4 py-2 rounded-md hover:bg-yellow-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-600">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>

</body>

</html>