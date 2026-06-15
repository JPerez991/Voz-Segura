<?php

namespace App\Http\Controllers;

use App\Services\CacheStorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function dashboard(Request $request, CacheStorageService $cache): View
    {
        $userId = Auth::id();
        $profile = $cache->findFirstWhere(CacheStorageService::PROFILES_KEY, function ($p) use ($userId) {
            return ($p['user_id'] ?? null) === $userId;
        });
        return view('dashboard', [
            'user' => $request->user(),
            'profile' => (object) ($profile ?? []),
        ]);
    }

    public function show(CacheStorageService $cache): View
    {
        $userId = Auth::id();
        $profile = $cache->findFirstWhere(CacheStorageService::PROFILES_KEY, function ($p) use ($userId) {
            return $p['user_id'] === $userId;
        });
        return view('profile', ['profile' => (object) ($profile ?? [])]);
    }

    public function edit(Request $request, CacheStorageService $cache): View
    {
        $userId = $request->user()->id;
        $profile = $cache->findFirstWhere(CacheStorageService::PROFILES_KEY, function ($p) use ($userId) {
            return $p['user_id'] === $userId;
        });
        return view('profile.edit', [
            'user' => $request->user(),
            'profile' => (object) ($profile ?? []),
        ]);
    }

    public function update(Request $request, CacheStorageService $cache): RedirectResponse
    {
        $user = $request->user();
        $userId = $user->id;

        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'nombre_anonimo' => 'nullable|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $cache->update(CacheStorageService::USERS_KEY, $userId, [
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        $existingProfile = $cache->findFirstWhere(CacheStorageService::PROFILES_KEY, function ($p) use ($userId) {
            return $p['user_id'] === $userId;
        });

        if ($existingProfile) {
            $cache->update(CacheStorageService::PROFILES_KEY, $existingProfile['id'], [
                'nombre_completo' => $request->nombre_completo,
                'descripcion' => $request->descripcion ?? '',
                'nombre_anonimo' => $request->nombre_anonimo,
            ]);
        } else {
            $cache->create(CacheStorageService::PROFILES_KEY, [
                'user_id' => $userId,
                'nombre_completo' => $request->nombre_completo,
                'descripcion' => $request->descripcion ?? '',
                'nombre_anonimo' => $request->nombre_anonimo,
            ]);
        }

        try {
            $dbUser = \App\Models\User::find($userId);
            if ($dbUser) {
                $dbUser->email = $request->email;
                if ($request->filled('password')) {
                    $dbUser->password = Hash::make($request->password);
                }
                $dbUser->save();
            }
            $profile = \App\Models\Profile::where('user_id', $userId)->first();
            if ($profile) {
                $profile->nombre_completo = $request->nombre_completo;
                $profile->descripcion = $request->descripcion;
                $profile->nombre_anonimo = $request->nombre_anonimo;
                $profile->save();
            }
        } catch (\Exception $e) {
        }

        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully.');
    }

    public function destroy(Request $request, CacheStorageService $cache): RedirectResponse
    {
        $userId = $request->user()->id;

        $cache->deleteWhere(CacheStorageService::PROFILES_KEY, function ($p) use ($userId) {
            return ($p['user_id'] ?? null) === $userId;
        });

        try {
            $profile = \App\Models\Profile::where('user_id', $userId)->first();
            if ($profile) {
                $profile->delete();
            }
            $dbUser = \App\Models\User::find($userId);
            if ($dbUser) {
                $dbUser->delete();
            }
        } catch (\Exception $e) {
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
