<x-app-layout>
    <x-slot name="header">
        

      

      @section('content')
    <div class="container">
        <h1>Foros</h1>
        </x-slot>

    <!-- Contenido principal -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <!-- Formulario para crear un nuevo foro -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-lg font-semibold text-purple-800 mb-4">Crear nuevo foro</h3>
                <form action="{{ route('forums.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="tema" class="block text-gray-700 font-bold mb-2">Título del foro</label>
                        <input type="text" name="tema" id="tema" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>
                    <div class="mb-4">
                        <label for="descripcion" class="block text-gray-700 font-bold mb-2">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-purple-500" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">Crear foro</button>
                </form>
            </div>


        <!-- Lista de foros -->
<!-- Lista de foros -->
<div class="mt-8">
    @if($foros->isEmpty())
        <p class="text-gray-500 text-center">No hay foros disponibles.</p>
    @else
        @foreach ($foros as $foro)
            <div class="mb-6 p-4 border border-gray-300 rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-xl font-semibold text-purple-800">{{ $foro->tema }}</h3>
                <p class="text-gray-700 mt-2">{{ $foro->descripcion }}</p>
                <p class="text-sm text-gray-500"><strong>Creado por:</strong> {{ $foro->user->nombre_usuario }}</p>
                <a href="{{ route('forums.show', $foro->id) }}" class="inline-block mt-2 text-purple-600 hover:text-purple-800 transition duration-200">Ver detalles</a>
                <hr class="mt-4 border-gray-300">
            </div>
        @endforeach
    @endif
</div>

    </div>
@endsection

   
    
    
</x-app-layout>    


