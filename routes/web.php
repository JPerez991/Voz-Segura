<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SessionsController;






/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
| Aquí puedes registrar las rutas web para tu aplicación.
| Todas se cargarán en el grupo de middleware "web".
*/

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome2');
})->name('welcome');

// Ruta de dashboard, protegida por autenticación
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
});



// Rutas de perfil protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show'); // Solo esta ruta
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //ruta para los mensajes privados

    Route::get('/messages/{recipientId}', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{recipientId}', [MessageController::class, 'store'])->name('messages.store');




    // Rutas para foros
    Route::resource('forums', ForumController::class);
    Route::get('/forums/create', [ForumController::class, 'create'])->name('forums.create'); // Ruta para crear los foros
    Route::get('/forums', [ForumController::class, 'index'])->name('forums.index'); // Ruta para listar los foros
    Route::get('/forums/{id}', [ForumController::class, 'show'])->name('forums.show'); // Ruta para mostrar un foro específico con sus respuestas
    Route::post('/forums/{id}/reply', [ForumController::class, 'storeReply'])->name('forums.storeReply'); // Ruta para enviar una respuesta a un foro


    
    // Rutas para mensajes privados
    Route::get('messages/{recipientId}', [MessageController::class, 'index'])->name('messages.index');
    Route::post('messages/{recipientId}', [MessageController::class, 'store'])->name('messages.store');
    
    // Rutas para chat
    Route::middleware('auth')->group(function() {
        Route::get('/chat/{recipientId}', [ChatController::class, 'index'])->name('chat.index');
        Route::post('/chat/{recipientId}', [ChatController::class, 'store']);
    });

    //ruta foros

});

// Rutas de autenticación
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Ruta de registro
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);


//

Route::resource('messages', MessageController::class);


//Programar Session
Route::resource('sessions', SessionsController::class);

Route::get('/sessions', [SessionsController::class, 'index'])->name('sessions.index');
Route::get('/sessions/create', [SessionsController::class, 'create'])->name('sessions.create');
Route::post('/sessions', [SessionsController::class, 'store'])->name('sessions.store');
Route::get('/sessions/{session}', [SessionsController::class, 'show'])->name('sessions.show');
Route::get('/sessions/{session}/edit', [SessionsController::class, 'edit'])->name('sessions.edit');
Route::put('/sessions/{session}', [SessionsController::class, 'update'])->name('sessions.update');
Route::delete('/sessions/{session}', [SessionsController::class, 'destroy'])->name('sessions.destroy');




// Ruta de bienvenida (opcional, ya está definida arriba)
Route::get('/welcome2', function () {
    return view('welcome2');
})->name('welcome2');

// Incluir las rutas de autenticación
require __DIR__ . '/auth.php';
