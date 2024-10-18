



<x-app-layout>

    <x-slot name="forums">
        

@section('content')
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4">{{ $foro->tema }}</h2>
        <p>{{ $foro->descripcion }}</p>
        <p><strong>Creado por:</strong> {{ $foro->user->nombre_usuario }}</p>

        <h3 class="text-xl font-bold mt-6">Respuestas</h3>
        @if($foro->replies->isEmpty())
            <p>No hay respuestas aún.</p>
        @else
            <div class="mt-4">
                @foreach ($foro->replies as $reply)
                    <div class="reply-item bg-gray-100 p-3 rounded mb-4">
                        <p>{{ $reply->responder }}</p>
                        <p><strong>Respondido por:</strong> 
                            {{ $reply->es_anonimo ? 'Anónimo' : $reply->user->nombre_usuario }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif

        <h3 class="text-xl font-bold mt-6">Responder al foro</h3>
        <form method="POST" action="{{ route('forums.storeReply', $foro->id) }}" class="mt-4">
            @csrf
            <textarea name="responder" class="w-full p-2 border rounded" required></textarea><br>
            <label class="mt-2 inline-flex items-center">
                <input type="checkbox" name="es_anonimo" class="form-checkbox">
                <span class="ml-2">Responder de forma anónima</span>
            </label><br>
            <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Enviar respuesta</button>
        </form>
    </div>
@endsection

    </x-slot>
    
    
</x-app-layout>    




