<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseMessageController extends Controller
{
    // Método genérico para enviar mensajes
    public function sendMessage(Request $request, $recipientId)
    {
        // Validar el contenido del mensaje
        $request->validate([
            'contenido' => 'required',
        ]);

        // Crear el mensaje
        Message::create([
            'envia_id' => Auth::id(),
            'recibe_id' => $recipientId,
            'contenido' => $request->contenido,
        ]);
    }

    // Método genérico para mostrar mensajes entre usuario autenticado y destinatario
    public function getMessages($recipientId)
    {
        return Message::where(function ($query) use ($recipientId) {
            $query->where('envia_id', Auth::id())
                  ->where('recibe_id', $recipientId);
        })->orWhere(function ($query) use ($recipientId) {
            $query->where('envia_id', $recipientId)
                  ->where('recibe_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();
    }
}
