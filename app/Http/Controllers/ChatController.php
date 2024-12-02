<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;


class ChatController extends Controller
{
    // Mostrar la vista del chat con los mensajes
    public function index($recipientId)
    {
        // Obtener el ID del usuario autenticado
        $authUserId = auth()->id();
        
        // Obtener los mensajes entre el usuario autenticado y el destinatario
        $messages = Message::where(function ($query) use ($authUserId, $recipientId) {
            $query->where('envia_id', $authUserId)
                  ->where('recibe_id', $recipientId);
        })->orWhere(function ($query) use ($authUserId, $recipientId) {
            $query->where('envia_id', $recipientId)
                  ->where('recibe_id', $authUserId);
        })->orderBy('created_at', 'asc')->get();
    


        // Pasar los mensajes a la vista
        return view('chat.index', compact('messages', 'recipientId'));
    }
    
    
    // Guardar un nuevo mensaje
    public function store(Request $request, $recipientId)
    {
        $request->validate([
            'mensaje' => 'required|string',
        ]);


        // Depurar para verificar que la solicitud POST llega correctamente
        // dd($userEnvia, $recipientId, $request->all());

        $message = Message::create([
            'envia_id' => Auth::id(),
            'recibe_id' => $recipientId,
            'mensaje' => $request->mensaje,
            'es_anonimo' => $request->has('es_anonimo'),
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['message' => $message], 201);
    }
}
