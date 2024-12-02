<x-app-layout>

    <x-slot name="forums">
        @section('content')
        <div class="container mx-auto px-4 py-8 bg-white bg-opacity-90 shadow-md rounded-lg">
            <!-- Título del foro -->
            <h2 class="text-3xl font-bold mb-6 text-gray-800">{{ $foro->tema }}</h2>
            <p class="text-lg text-gray-600 mb-2">{{ $foro->descripcion }}</p>
            <p class="text-sm text-gray-500 mb-4">
                <strong>Creado por:</strong> {{ $foro->user->nombre_usuario }}
            </p>

            <!-- Respuestas -->
            <h3 class="text-2xl font-semibold mt-8 mb-4 text-gray-800">Respuestas</h3>
            @if($foro->replies->isEmpty())
                <p class="text-gray-600">No hay respuestas aún.</p>
            @else
                <div class="space-y-4 mt-4">
                    @foreach ($foro->replies as $reply)
                        <div class="reply-item bg-gray-100 p-4 rounded-lg shadow-sm border border-gray-200">
                            <p class="text-gray-700">{{ $reply->responder }}</p>
                            <p class="text-sm text-gray-500 mt-2">
                                <strong>Respondido por:</strong> 
                                {{ $reply->es_anonimo ? 'Anónimo' : $reply->user->nombre_usuario }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Formulario para responder -->
            <h3 class="text-2xl font-semibold mt-10 mb-4 text-gray-800">Responder al foro</h3>
            <form method="POST" action="{{ route('forums.storeReply', $foro->id) }}" class="space-y-6">
                @csrf
                <textarea name="responder" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-purple-300 focus:outline-none" rows="4" placeholder="Escribe tu respuesta..." required></textarea>

                <label class="inline-flex items-center text-gray-600">
                    <input type="checkbox" name="es_anonimo" class="form-checkbox h-5 w-5 text-purple-600">
                    <span class="ml-2">Responder de forma anónima</span>
                </label>

                <button type="submit" class="block w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-lg shadow-lg transition duration-300">Enviar respuesta</button>
            </form>
        </div>
        @endsection
    </x-slot>

</x-app-layout>
