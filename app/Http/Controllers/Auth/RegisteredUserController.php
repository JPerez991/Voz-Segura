<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'nombre_usuario' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol' => ['required', 'string', 'max:255'],
            'es_anonimo' => ['required', 'boolean'],
            // Agregar aquí cualquier otro campo que necesites validar
        ]);
    
        try {
            // Creación del usuario
            $user = User::create([
                'nombre_usuario' => $validatedData['nombre_usuario'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'rol' => $validatedData['rol'],
                'es_anonimo' => $validatedData['es_anonimo'],
            ]);
    
            // Creación del perfil asociado al usuario
            Profile::create([
                'user_id' => $user->id,
                'nombre_completo' => $validatedData['nombre_usuario'], // Usar el nombre de usuario como nombre completo
                'descripcion' => $request->input('descripcion'),
                'nombre_anonimo' => $request->input('nombre_anonimo'),
            ]);
    
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al registrar el usuario: ' . $e->getMessage()]);
        }
    
        // Iniciar sesión después del registro
        auth()->login($user);
    
        // Redirigir a la vista del perfil o donde desees
        return redirect()->route('profile.edit')->with('success', 'User registered successfully.');
    }
    
}
