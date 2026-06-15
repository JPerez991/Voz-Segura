<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Services\CacheStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    protected $cache;

    public function __construct(CacheStorageService $cache)
    {
        $this->cache = $cache;
    }

    public function index($recipientId)
    {
        $authUserId = Auth::id();

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
                        'contenido' => $m['mensaje'],
                        'created_at' => \Carbon\Carbon::parse($m['created_at'] ?? now()),
                        'sender' => (object) ($enviaUser ?? ['nombre_usuario' => 'Desconocido']),
                    ];
                }
            }
            $messages = collect($filtered);
        }

        return view('messages', compact('messages', 'recipientId'));
    }

    public function store(Request $request, $recipientId)
    {
        $request->validate([
            'contenido' => 'required|string',
        ]);

        $data = [
            'envia_id' => Auth::id(),
            'recibe_id' => (int) $recipientId,
            'mensaje' => $request->contenido,
        ];

        try {
            Message::create($data);
        } catch (\Exception $e) {
            $this->cache->create(CacheStorageService::MESSAGES_KEY, $data + ['es_anonimo' => false]);
        }

        return redirect()->route('messages.index', ['recipientId' => $recipientId]);
    }
}
