<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use App\Models\User;
use App\Services\CacheStorageService;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    protected $cache;

    public function __construct(CacheStorageService $cache)
    {
        $this->cache = $cache;
    }

    public function index()
    {
        try {
            $sessions = Sessions::with('psicologa', 'usuario')->get();
        } catch (\Exception $e) {
            $sessionsData = $this->cache->getAll(CacheStorageService::SESSIONS_KEY);
            $sessions = [];
            foreach ($sessionsData as $s) {
                $psicologa = $this->cache->getById(CacheStorageService::USERS_KEY, $s['psicologa_id']);
                $usuario = $this->cache->getById(CacheStorageService::USERS_KEY, $s['usuario_id']);
                $sessions[] = (object) [
                    'id' => $s['id'],
                    'tipo_sesion' => $s['tipo_sesion'],
                    'descripcion' => $s['descripcion'] ?? '',
                    'fecha_hora' => $s['fecha_hora'],
                    'completada' => $s['completada'] ?? false,
                    'psicologa' => (object) ($psicologa ?? ['nombre_usuario' => 'Desconocida']),
                    'usuario' => (object) ($usuario ?? ['nombre_usuario' => 'Desconocida']),
                ];
            }
            $sessions = collect($sessions);
        }
        return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        try {
            $psicologas = User::where('rol', 'psicologa')->get();
            $usuarios = User::where('rol', 'usuaria')->get();
        } catch (\Exception $e) {
            $allUsers = $this->cache->getAll(CacheStorageService::USERS_KEY);
            $psicologas = collect();
            $usuarios = collect();
            foreach ($allUsers as $u) {
                $userObj = (object) ['id' => $u['id'], 'nombre_usuario' => $u['nombre_usuario']];
                if (($u['rol'] ?? '') === 'psicologa') {
                    $psicologas->push($userObj);
                } else {
                    $usuarios->push($userObj);
                }
            }
        }
        return view('sessions.create', compact('psicologas', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'psicologa_id' => 'required|integer',
            'usuario_id' => 'required|integer',
            'tipo_sesion' => 'required|string',
            'fecha_hora' => 'required|date',
        ]);

        try {
            Sessions::create([
                'psicologa_id' => $request->psicologa_id,
                'usuario_id' => $request->usuario_id,
                'tipo_sesion' => $request->tipo_sesion,
                'descripcion' => $request->descripcion,
                'fecha_hora' => $request->fecha_hora,
            ]);
        } catch (\Exception $e) {
            $this->cache->create(CacheStorageService::SESSIONS_KEY, [
                'psicologa_id' => (int) $request->psicologa_id,
                'usuario_id' => (int) $request->usuario_id,
                'tipo_sesion' => $request->tipo_sesion,
                'descripcion' => $request->descripcion ?? '',
                'fecha_hora' => $request->fecha_hora,
                'completada' => false,
            ]);
        }

        return redirect()->route('sessions.index')->with('success', 'Sesion creada exitosamente.');
    }

    public function edit($id)
    {
        try {
            $session = Sessions::findOrFail($id);
            $psicologas = User::where('rol', 'psicologa')->get();
            $usuarios = User::where('rol', 'usuaria')->get();
        } catch (\Exception $e) {
            $sessionData = $this->cache->getById(CacheStorageService::SESSIONS_KEY, (int) $id);
            if (!$sessionData) {
                abort(404);
            }
            $session = (object) $sessionData;
            $allUsers = $this->cache->getAll(CacheStorageService::USERS_KEY);
            $psicologas = collect();
            $usuarios = collect();
            foreach ($allUsers as $u) {
                $userObj = (object) ['id' => $u['id'], 'nombre_usuario' => $u['nombre_usuario']];
                if (($u['rol'] ?? '') === 'psicologa') {
                    $psicologas->push($userObj);
                } else {
                    $usuarios->push($userObj);
                }
            }
        }
        return view('sessions.edit', compact('session', 'psicologas', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_hora' => 'required|date',
            'tipo_sesion' => 'required|string',
        ]);

        try {
            $session = Sessions::findOrFail($id);
            $session->update([
                'fecha_hora' => $request->fecha_hora,
                'tipo_sesion' => $request->tipo_sesion,
                'descripcion' => $request->descripcion,
            ]);
        } catch (\Exception $e) {
            $this->cache->update(CacheStorageService::SESSIONS_KEY, (int) $id, [
                'fecha_hora' => $request->fecha_hora,
                'tipo_sesion' => $request->tipo_sesion,
                'descripcion' => $request->descripcion ?? '',
            ]);
        }

        return redirect()->route('sessions.index')->with('success', 'Sesion actualizada exitosamente.');
    }

    public function destroy($id)
    {
        try {
            $session = Sessions::findOrFail($id);
            $session->delete();
        } catch (\Exception $e) {
            $this->cache->delete(CacheStorageService::SESSIONS_KEY, (int) $id);
        }

        return redirect()->route('sessions.index')->with('success', 'Sesion eliminada.');
    }
}
