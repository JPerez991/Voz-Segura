<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheStorageService
{
    const USERS_KEY = 'voz_users';
    const PROFILES_KEY = 'voz_profiles';
    const FORUMS_KEY = 'voz_forums';
    const FORUM_REPLIES_KEY = 'voz_forum_replies';
    const SESSIONS_KEY = 'voz_sessions';
    const MESSAGES_KEY = 'voz_messages';

    public function seedIfEmpty(): void
    {
        if (!Cache::has(self::USERS_KEY)) {
            $users = [
                ['id' => 1, 'nombre_usuario' => 'Maria_G', 'email' => 'maria@ejemplo.com', 'password' => bcrypt('password'), 'rol' => 'usuaria', 'es_anonimo' => false],
                ['id' => 2, 'nombre_usuario' => 'Lic_Carmen', 'email' => 'carmen@psicologa.com', 'password' => bcrypt('password'), 'rol' => 'psicologa', 'es_anonimo' => false],
                ['id' => 3, 'nombre_usuario' => 'Ana_98', 'email' => 'ana@ejemplo.com', 'password' => bcrypt('password'), 'rol' => 'usuaria', 'es_anonimo' => true],
            ];
            Cache::forever(self::USERS_KEY, $users);

            $profiles = [
                ['id' => 1, 'user_id' => 1, 'nombre_completo' => 'Maria Garcia Lopez', 'descripcion' => 'Mujer en busca de apoyo emocional', 'nombre_anonimo' => 'Mariposa'],
                ['id' => 2, 'user_id' => 2, 'nombre_completo' => 'Dra. Carmen Martinez', 'descripcion' => 'Psicologa clinica', 'nombre_anonimo' => null],
                ['id' => 3, 'user_id' => 3, 'nombre_completo' => 'Ana Rodriguez Perez', 'descripcion' => 'Madre de dos hijos', 'nombre_anonimo' => 'Estrella'],
            ];
            Cache::forever(self::PROFILES_KEY, $profiles);

            Cache::forever(self::FORUMS_KEY, []);
            Cache::forever(self::FORUM_REPLIES_KEY, []);
            Cache::forever(self::SESSIONS_KEY, []);
            Cache::forever(self::MESSAGES_KEY, []);
        }
    }

    public function getAll(string $key): array
    {
        return Cache::get($key, []);
    }

    public function getById(string $key, int $id): ?array
    {
        $items = $this->getAll($key);
        foreach ($items as $item) {
            if (($item['id'] ?? null) === $id) {
                return $item;
            }
        }
        return null;
    }

    public function findWhere(string $key, callable $callback): array
    {
        return array_values(array_filter($this->getAll($key), $callback));
    }

    public function findFirstWhere(string $key, callable $callback): ?array
    {
        $items = $this->findWhere($key, $callback);
        return $items[0] ?? null;
    }

    public function create(string $key, array $data): array
    {
        $items = $this->getAll($key);
        $maxId = 0;
        foreach ($items as $item) {
            if (($item['id'] ?? 0) > $maxId) {
                $maxId = $item['id'];
            }
        }
        $data['id'] = $maxId + 1;
        $items[] = $data;
        Cache::forever($key, $items);
        return $data;
    }

    public function update(string $key, int $id, array $data): ?array
    {
        $items = $this->getAll($key);
        foreach ($items as $i => $item) {
            if (($item['id'] ?? null) === $id) {
                $items[$i] = array_merge($item, $data);
                $items[$i]['id'] = $id;
                Cache::forever($key, $items);
                return $items[$i];
            }
        }
        return null;
    }

    public function delete(string $key, int $id): bool
    {
        $items = $this->getAll($key);
        foreach ($items as $i => $item) {
            if (($item['id'] ?? null) === $id) {
                array_splice($items, $i, 1);
                Cache::forever($key, $items);
                return true;
            }
        }
        return false;
    }

    public function deleteWhere(string $key, callable $callback): int
    {
        $items = $this->getAll($key);
        $remaining = [];
        $removed = 0;
        foreach ($items as $item) {
            if ($callback($item)) {
                $removed++;
            } else {
                $remaining[] = $item;
            }
        }
        if ($removed > 0) {
            Cache::forever($key, $remaining);
        }
        return $removed;
    }
}
