@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mensajes con {{ $recipientId }}</h1>

    <div class="messages">
        @foreach ($messages as $message)
            <div class="message">
                <strong>{{ $message->sender->nombre_usuario }}:</strong> {{ $message->contenido }}
                <span>{{ $message->created_at->diffForHumans() }}</span>
            </div>
        @endforeach
    </div>

    <form action="{{ route('messages.store', $recipientId) }}" method="POST">
    @csrf
    <textarea name="contenido" rows="3" required></textarea>
    <button type="submit">Enviar</button>
</form>

</div>
@endsection
