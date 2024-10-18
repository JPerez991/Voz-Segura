<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
      // Mostrar mensajes entre usuario autenticado y destinatario
    public function index($recipientId)
    {
        $messages = Message::where(function ($query) use ($recipientId) {
            $query->where('envia_id', Auth::id())
                  ->where('recibe_id', $recipientId);
        })->orWhere(function ($query) use ($recipientId) {
            $query->where('envia_id', $recipientId)
                  ->where('recibe_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return view('messages.index', compact('messages', 'recipientId'));
    }

    // Enviar un nuevo mensaje
    public function store(Request $request, $recipientId)
    {
        $request->validate([
            'contenido' => 'required',
        ]);

        Message::create([
            'envia_id' => Auth::id(),
            'recibe_id' => $recipientId,
            'contenido' => $request->contenido,
        ]);

        return redirect()->route('messages.index', ['recipientId' => $recipientId]);
    }
}
