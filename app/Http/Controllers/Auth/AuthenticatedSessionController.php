<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\CacheStorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(Request $request, CacheStorageService $cache): RedirectResponse
    {
        $request->validate([
            'nombre_usuario' => ['required', 'string'],
            'contraseña' => ['required', 'string'],
        ]);

        if (Auth::attempt(['nombre_usuario' => $request->nombre_usuario, 'password' => $request->contraseña])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        $user = $cache->findFirstWhere(CacheStorageService::USERS_KEY, function ($u) use ($request) {
            return $u['nombre_usuario'] === $request->nombre_usuario;
        });

        if ($user && Hash::check($request->contraseña, $user['password'])) {
            Auth::loginUsingId($user['id']);
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'nombre_usuario' => 'Las credenciales proporcionadas son incorrectas.',
        ])->onlyInput('nombre_usuario');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
