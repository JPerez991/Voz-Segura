<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login'); // Asegúrate de que este sea el nombre correcto de la vista
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar los campos de entrada
        $request->validate([
            'nombre_usuario' => ['required', 'string'],
            'contraseña' => ['required', 'string'],
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt(['nombre_usuario' => $request->nombre_usuario, 'password' => $request->contraseña])) {
            // Regenerar la sesión
            $request->session()->regenerate();

            // Redirigir a la ruta de destino (profile)
            return redirect()->route('dashboard'); // Cambié la redirección a la vista 'profile'
        }

        // Si la autenticación falla, redirigir de nuevo con un mensaje de error
        return back()->withErrors([
            'nombre_usuario' => 'Las credenciales proporcionadas son incorrectas.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirige a la ruta de tu dashboard
    }
}
