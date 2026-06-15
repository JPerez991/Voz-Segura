<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome2');
})->name('welcome');

Route::get('/welcome2', function () {
    return view('welcome2');
})->name('welcome2');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/messages/{recipientId}', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/{recipientId}', [MessageController::class, 'store'])->name('messages.store');

    Route::get('/chat/{recipientId}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/{recipientId}', [ChatController::class, 'store']);

    Route::get('/forums/create', [ForumController::class, 'create'])->name('forums.create');
    Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
    Route::get('/forums/{id}', [ForumController::class, 'show'])->name('forums.show');
    Route::post('/forums', [ForumController::class, 'store'])->name('forums.store');
    Route::post('/forums/{id}/reply', [ForumController::class, 'storeReply'])->name('forums.storeReply');

    Route::get('/sessions', [SessionsController::class, 'index'])->name('sessions.index');
    Route::get('/sessions/create', [SessionsController::class, 'create'])->name('sessions.create');
    Route::post('/sessions', [SessionsController::class, 'store'])->name('sessions.store');
    Route::get('/sessions/{session}/edit', [SessionsController::class, 'edit'])->name('sessions.edit');
    Route::put('/sessions/{session}', [SessionsController::class, 'update'])->name('sessions.update');
    Route::delete('/sessions/{session}', [SessionsController::class, 'destroy'])->name('sessions.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
