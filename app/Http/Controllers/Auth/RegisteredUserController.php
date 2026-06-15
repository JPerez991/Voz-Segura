<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\CacheStorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request, CacheStorageService $cache): RedirectResponse
    {
        $request->validate([
            'nombre_usuario' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol' => ['required', 'string', 'max:255'],
            'es_anonimo' => ['required', 'boolean'],
        ]);

        $existingUser = $cache->findFirstWhere(CacheStorageService::USERS_KEY, function ($u) use ($request) {
            return $u['nombre_usuario'] === $request->nombre_usuario || $u['email'] === $request->email;
        });

        if ($existingUser) {
            return back()->withErrors(['nombre_usuario' => 'El nombre de usuario o email ya existe.'])->withInput();
        }

        $user = $cache->create(CacheStorageService::USERS_KEY, [
            'nombre_usuario' => $request->nombre_usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'es_anonimo' => $request->boolean('es_anonimo'),
        ]);

        $cache->create(CacheStorageService::PROFILES_KEY, [
            'user_id' => $user['id'],
            'nombre_completo' => $request->nombre_usuario,
            'descripcion' => $request->input('descripcion', ''),
            'nombre_anonimo' => $request->input('nombre_anonimo'),
        ]);

        Auth::loginUsingId($user['id']);

        return redirect()->route('dashboard')->with('success', 'Usuario registrado exitosamente.');
    }
}
