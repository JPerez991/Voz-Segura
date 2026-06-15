<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Services\CacheStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class ChatController extends Controller
{
    protected $cache;

    public function __construct(CacheStorageService $cache)
    {
        $this->cache = $cache;
    }

    public function index($recipientId)
    {
        $authUserId = auth()->id();

        try {
            $messages = Message::where(function ($query) use ($authUserId, $recipientId) {
                $query->where('envia_id', $authUserId)
                      ->where('recibe_id', $recipientId);
            })->orWhere(function ($query) use ($authUserId, $recipientId) {
                $query->where('envia_id', $recipientId)
                      ->where('recibe_id', $authUserId);
            })->orderBy('created_at', 'asc')->get();
        } catch (\Exception $e) {
            $allMessages = $this->cache->getAll(CacheStorageService::MESSAGES_KEY);
            $filtered = [];
            foreach ($allMessages as $m) {
                if (($m['envia_id'] === $authUserId && $m['recibe_id'] == $recipientId) ||
                    ($m['envia_id'] == $recipientId && $m['recibe_id'] === $authUserId)) {
                    $enviaUser = $this->cache->getById(CacheStorageService::USERS_KEY, $m['envia_id']);
                    $filtered[] = (object) [
                        'id' => $m['id'],
                        'mensaje' => $m['mensaje'],
                        'es_anonimo' => $m['es_anonimo'] ?? false,
                        'created_at' => $m['created_at'] ?? now(),
                        'userEnvia' => (object) ($enviaUser ?? ['nombre_usuario' => 'Desconocido']),
                    ];
                }
            }
            $messages = collect($filtered);
        }

        return view('chat.index', compact('messages', 'recipientId'));
    }

    public function store(Request $request, $recipientId)
    {
        $request->validate([
            'mensaje' => 'required|string',
        ]);

        $data = [
            'envia_id' => Auth::id(),
            'recibe_id' => (int) $recipientId,
            'mensaje' => $request->mensaje,
            'es_anonimo' => $request->has('es_anonimo'),
        ];

        try {
            $message = Message::create($data);
            broadcast(new MessageSent($message))->toOthers();
        } catch (\Exception $e) {
            $message = $this->cache->create(CacheStorageService::MESSAGES_KEY, $data);
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['message' => $message], 201);
        }

        return redirect()->route('chat.index', $recipientId);
    }
}
