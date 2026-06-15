<?php

namespace App\Providers;

use App\Services\CacheStorageService;
use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Hash;

class CacheUserProvider implements UserProvider
{
    protected $cache;

    public function __construct(CacheStorageService $cache)
    {
        $this->cache = $cache;
    }

    public function retrieveById($identifier): ?Authenticatable
    {
        $userData = $this->cache->getById(CacheStorageService::USERS_KEY, (int) $identifier);
        if (!$userData) {
            return null;
        }
        return $this->genericUser($userData);
    }

    public function retrieveByToken($identifier, $token): ?Authenticatable
    {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
    }

    public function retrieveByCredentials(array $credentials): ?Authenticatable
    {
        if (!isset($credentials['nombre_usuario'])) {
            return null;
        }
        $users = $this->cache->getAll(CacheStorageService::USERS_KEY);
        foreach ($users as $userData) {
            if ($userData['nombre_usuario'] === $credentials['nombre_usuario']) {
                return $this->genericUser($userData);
            }
        }
        return null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials): bool
    {
        return Hash::check($credentials['password'], $user->getAuthPassword());
    }

    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false)
    {
    }

    protected function genericUser(array $data): GenericUser
    {
        return new GenericUser([
            'id' => $data['id'],
            'nombre_usuario' => $data['nombre_usuario'],
            'email' => $data['email'],
            'password' => $data['password'],
            'rol' => $data['rol'],
            'es_anonimo' => $data['es_anonimo'],
        ]);
    }
}
