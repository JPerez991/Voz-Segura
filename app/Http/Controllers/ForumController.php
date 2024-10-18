<?php

namespace App\Http\Controllers;

use App\Models\Forums;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ForumController extends Controller
{

 
    
    public function index()
    {
        // Obtenemos todos los foros con los usuarios relacionados
        $foros = Forums::with('user')->get();

        // Retornamos la vista con los foros
        return view('forums.index', compact('foros'));
    }

    public function show($id)
    {
        // Obtener el foro por su ID con las respuestas
        $foro = Forums::with('replies.user')->findOrFail($id);

        // Retornar la vista con los detalles del foro y sus respuestas
        return view('forums.show', compact('foro'));
    }


    // Guardar un nuevo foro
    public function store(Request $request)
    {
        $request->validate([
            'tema' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        Forums::create([
            'tema' => $request->tema,
            'descripcion' => $request->descripcion,
            'creado_por' => Auth::id(),
        ]);

        return redirect()->route('forums.index')->with('success', 'Foro creado exitosamente.');
    }


     // Guardar una respuesta a un foro
     public function storeReply(Request $request, $id)
     {
         $request->validate([
             'responder' => 'required',
         ]);
 
         ForumReply::create([
             'forum_id' => $id,
             'user_id' => Auth::id(),
             'responder' => $request->responder,
             'es_anonimo' => $request->has('es_anonimo'),
         ]);
 
         return redirect()->route('forums.show', $id);
     }
}