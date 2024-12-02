<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use App\Models\User;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
     // Muestra todas las sesiones programadas
    public function index()
    {
        $sessions = Sessions::with('psicologa', 'usuario')->get(); // Muestra todas las sesiones
        return view('sessions.index', compact('sessions'));
    }

    // Muestra el formulario para crear una nueva sesión
    
        public function create()
        {
            $psicologas = User::where('rol', 'psicóloga')->get();
            $usuarios = User::where('rol', 'usuaria')->get();
            return view('sessions.create', compact('psicologas', 'usuarios'));
        }
    

    

    // Almacena la nueva sesión en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'psicologa_id' => 'required|exists:users,id',
            'usuario_id' => 'required|exists:users,id',
            'tipo_sesion' => 'required|string',
            'fecha_hora' => 'required|date',
        ]);

        // Crear la nueva sesión
        Sessions::create([
            'psicologa_id' => $request->psicologa_id,
            'usuario_id' => $request->usuario_id,
            'tipo_sesion' => $request->tipo_sesion,
            'descripcion' => $request->descripcion,
            'fecha_hora' => $request->fecha_hora,
        ]);

        return redirect()->route('sessions.index')->with('success', 'Sesión creada exitosamente.');
    }

    // Muestra el formulario para editar una sesión
    public function edit($id)
    {
        $session = Sessions::findOrFail($id);
        return view('sessions.edit', compact('session'));
    }

    // Actualiza la información de la sesión
    public function update(Request $request, $id)
    {
        $session = Sessions::findOrFail($id);

        $request->validate([
            'fecha_hora' => 'required|date',
            'tipo_sesion' => 'required|string',
        ]);

        $session->update([
            'fecha_hora' => $request->fecha_hora,
            'tipo_sesion' => $request->tipo_sesion,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('sessions.index')->with('success', 'Sesión actualizada exitosamente.');
    }

    // Elimina una sesión programada
    public function destroy($id)
    {
        $session = Sessions::findOrFail($id);
        $session->delete();

        return redirect()->route('sessions.index')->with('success', 'Sesión eliminada.');
    }
}
