<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile; // Asegúrate de importar el modelo
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\Forum;  // Asegúrate de importar el modelo Forum
use App\Models\forums;
use Illuminate\Support\Facades\Auth; // Asegúrate de importar Auth



class ProfileController extends Controller
{
    /**
     * Mostrar el formulario de edición del perfil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'profile' => $request->user()->profile, // Cargar el perfil del usuario
        ]);
    }

    /**
     * Actualizar el perfil del usuario.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user(); // Definir el usuario
    $profile = $request->user()->profile;

    if (!$profile) {
        // Crear un nuevo perfil si no existe
        $profile = new Profile();
        $profile->user_id = $request->user()->id; // Asignar el ID del usuario
    }

    // Actualizar el correo
    $user->email = $request->email;

       // Si se proporciona una nueva contraseña, actualizarla
       if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }


    // Rellenar el perfil con los datos validados
    $profile->nombre_completo = $request->input('nombre_completo');
    $profile->descripcion = $request->input('descripcion');
    $profile->nombre_anonimo = $request->input('nombre_anonimo');


    $profile->save(); // Guardar los cambios
    $user->save(); // Guardar el usuario

    return Redirect::route('profile.edit')->with('status', 'Profile updated successfully.');

}


    

    /**
     * Crear un nuevo perfil para el usuario.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'nombre_anonimo' => 'nullable|string',
        ]);

        $profile = new Profile();
        $profile->user_id = $request->user()->id; // Asignar user_id
        $profile->nombre_completo = $request->input('nombre_completo');
        $profile->descripcion = $request->input('descripcion');
        $profile->nombre_anonimo = $request->input('nombre_anonimo');
        $profile->save();

        return redirect()->route('profile.edit')->with('success', 'Profile created successfully.');
    }

    /**
     * Eliminar el perfil del usuario.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $profile = $request->user()->profile;

        if ($profile) {
            $profile->delete(); // Eliminar el perfil
        }

        return redirect()->route('welcome2')->with('success', 'Profile deleted successfully.');
    }

    /**
     * Mostrar el dashboard con la información del perfil del usuario.
     */
    public function dashboard(Request $request): View
    {
        return view('dashboard', [
            'user' => $request->user(),
            'profile' => $request->user()->profile, // Cargar el perfil del usuario
            'rol' => $request->user(),
        ]);

       
    }


    

  
}