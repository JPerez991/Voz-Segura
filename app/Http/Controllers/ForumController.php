<?php

namespace App\Http\Controllers;

use App\Models\Forums;
use App\Models\ForumReply;
use App\Models\User;
use App\Services\CacheStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    protected $cache;

    public function __construct(CacheStorageService $cache)
    {
        $this->cache = $cache;
    }

    public function index()
    {
        try {
            $foros = Forums::with('user')->get();
        } catch (\Exception $e) {
            $forosData = $this->cache->getAll(CacheStorageService::FORUMS_KEY);
            $foros = [];
            foreach ($forosData as $f) {
                $user = $this->cache->getById(CacheStorageService::USERS_KEY, $f['creado_por']);
                $foros[] = (object) [
                    'id' => $f['id'],
                    'tema' => $f['tema'],
                    'descripcion' => $f['descripcion'],
                    'user' => (object) ($user ?? ['nombre_usuario' => 'Desconocido']),
                ];
            }
            $foros = collect($foros);
        }
        return view('forums.index', compact('foros'));
    }

    public function show($id)
    {
        try {
            $foro = Forums::with('replies.user')->findOrFail($id);
        } catch (\Exception $e) {
            $foroData = $this->cache->getById(CacheStorageService::FORUMS_KEY, (int) $id);
            if (!$foroData) {
                abort(404);
            }
            $user = $this->cache->getById(CacheStorageService::USERS_KEY, $foroData['creado_por']);
            $repliesData = $this->cache->findWhere(CacheStorageService::FORUM_REPLIES_KEY, function ($r) use ($id) {
                return $r['forum_id'] === (int) $id;
            });
            $replies = [];
            foreach ($repliesData as $r) {
                $replyUser = $this->cache->getById(CacheStorageService::USERS_KEY, $r['user_id']);
                $replies[] = (object) [
                    'id' => $r['id'],
                    'responder' => $r['responder'],
                    'es_anonimo' => $r['es_anonimo'],
                    'user' => (object) ($replyUser ?? ['nombre_usuario' => 'Desconocido']),
                ];
            }
            $foro = (object) [
                'id' => $foroData['id'],
                'tema' => $foroData['tema'],
                'descripcion' => $foroData['descripcion'],
                'user' => (object) ($user ?? ['nombre_usuario' => 'Desconocido']),
                'replies' => collect($replies),
            ];
        }
        return view('forums.show', compact('foro'));
    }

    public function create()
    {
        return view('forums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tema' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        try {
            Forums::create([
                'tema' => $request->tema,
                'descripcion' => $request->descripcion,
                'creado_por' => Auth::id(),
            ]);
        } catch (\Exception $e) {
            $this->cache->create(CacheStorageService::FORUMS_KEY, [
                'tema' => $request->tema,
                'descripcion' => $request->descripcion,
                'creado_por' => Auth::id(),
            ]);
        }

        return redirect()->route('forums.index')->with('success', 'Foro creado exitosamente.');
    }

    public function storeReply(Request $request, $id)
    {
        $request->validate([
            'responder' => 'required',
        ]);

        try {
            ForumReply::create([
                'forum_id' => $id,
                'user_id' => Auth::id(),
                'responder' => $request->responder,
                'es_anonimo' => $request->has('es_anonimo'),
            ]);
        } catch (\Exception $e) {
            $this->cache->create(CacheStorageService::FORUM_REPLIES_KEY, [
                'forum_id' => (int) $id,
                'user_id' => Auth::id(),
                'responder' => $request->responder,
                'es_anonimo' => $request->has('es_anonimo'),
            ]);
        }

        return redirect()->route('forums.show', $id);
    }
}
