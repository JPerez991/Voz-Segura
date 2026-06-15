@extends('layouts.app')

@section('content')
<section class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-8">
    <header>
        <h2 class="text-2xl font-semibold text-purple-700">
            Perfil de Usuario
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Actualizá la información de tu cuenta.
        </p>
    </header>

    <form id="profileForm" class="mt-6 space-y-6">
        <div>
            <label for="nombre_usuario" class="block text-sm font-medium text-purple-600">Nombre de Usuario</label>
            <input id="nombre_usuario" name="nombre_usuario" type="text" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-purple-600">Correo Electrónico</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required />
        </div>

        <div>
            <label for="nombre_completo" class="block text-sm font-medium text-purple-600">Nombre Completo</label>
            <input id="nombre_completo" name="nombre_completo" type="text" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" />
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-medium text-purple-600">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" rows="3"></textarea>
        </div>

        <div id="anonimo-field">
            <label for="nombre_anonimo" class="block text-sm font-medium text-purple-600">Nombre Anónimo</label>
            <input id="nombre_anonimo" name="nombre_anonimo" type="text" class="mt-1 block w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                Guardar
            </button>
            <span id="savedMsg" class="text-sm text-green-600 hidden">Guardado.</span>
        </div>
    </form>
</section>

<script>
(function() {
    var user = JSON.parse(localStorage.getItem('voz_currentUser') || 'null');
    if (!user) return;

    document.getElementById('nombre_usuario').value = user.nombre_usuario || '';
    document.getElementById('email').value = user.email || '';
    document.getElementById('nombre_completo').value = user.nombre_completo || '';
    document.getElementById('descripcion').value = user.descripcion || '';
    document.getElementById('nombre_anonimo').value = user.nombre_anonimo || '';

    if (user.rol !== 'usuaria') {
        document.getElementById('anonimo-field').style.display = 'none';
    }

    document.getElementById('profileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var users = JSON.parse(localStorage.getItem('voz_users') || '[]');
        var idx = users.findIndex(function(u) { return u.id === user.id; });
        if (idx === -1) return;

        users[idx].nombre_usuario = document.getElementById('nombre_usuario').value.trim();
        users[idx].email = document.getElementById('email').value.trim();
        users[idx].nombre_completo = document.getElementById('nombre_completo').value.trim();
        users[idx].descripcion = document.getElementById('descripcion').value.trim();
        users[idx].nombre_anonimo = document.getElementById('nombre_anonimo').value.trim() || null;

        localStorage.setItem('voz_users', JSON.stringify(users));
        user = users[idx];
        localStorage.setItem('voz_currentUser', JSON.stringify(user));

        var msg = document.getElementById('savedMsg');
        msg.classList.remove('hidden');
        setTimeout(function() { msg.classList.add('hidden'); }, 2000);
    });
})();
</script>
@endsection
