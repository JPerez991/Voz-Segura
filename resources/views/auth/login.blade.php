<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Estilos para el fondo de la página */
        body {
            background-image: url('img/vista-login/6.jpg');
            /* Ruta relativa directa */
            background-size: cover;
            /* Cambia 'cover' a 'contain' */
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            /* Mantiene la altura del viewport */
            width: 100%;
            /* Asegúrate de que cubra todo el ancho */
            display: flex;
            /* Flexbox para centrar contenido */
            align-items: center;
            /* Centra verticalmente */
            justify-content: center;
            /* Centra horizontalmente */
        }

        /* Estilos para el contenedor del formulario */
        .form-container {
            background-color: rgba(255, 255, 255, 0.3);
            /* Fondo semitransparente */
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>

<body class="flex items-center justify-center">

    <!-- Contenedor del formulario de login -->
    <div class="form-container">
        <h1 class="text-2xl font-bold text-center mb-6">Iniciar Sesión</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Nombre de Usuario -->
            <div class="mb-4">
                <label for="nombre_usuario" class="block text-sm font-medium text-gray-700">Nombre de Usuario</label>
                <input id="nombre_usuario" name="nombre_usuario" type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required autofocus>
            </div>

            <!-- Contraseña -->
            <div class="mb-6">
                <label for="contraseña" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input id="contraseña" name="contraseña" type="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Enlace para registrar cuenta y botón de login -->
            <div class="flex items-center justify-between">
                <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900">¿No tienes una cuenta?</a>
                <button type="submit" class="ml-3 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>

</body>

</html>