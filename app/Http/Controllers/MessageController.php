<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
        // Mostrar los mensajes del foro
        public function index($recipientId)
        {
            $messages = $this->getMessages($recipientId);
            return view('messages.index', compact('messages', 'recipientId'));
        }
    
        // Enviar un nuevo mensaje en el foro
        public function store(Request $request, $recipientId)
        {
            $this->sendMessage($request, $recipientId);
            return redirect()->route('messages.index', ['recipientId' => $recipientId]);
        }
}
