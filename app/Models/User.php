<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_usuario',
        'email',
        'password', // Cambiado de 'contraseña' a 'password'
        'rol',
        'es_anonimo',
    ];

    /**
     * Los atributos que deben estar ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // Cambiado a 'password' para que coincida con el campo en fillable
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos específicos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'es_anonimo' => 'boolean', // Convierte 'es_anonimo' a un valor booleano
    ];

    /**
     * Obtiene el perfil asociado al usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id'); // Asegúrate de que 'user_id' es la FK en la tabla profiles
    }

    /**
     * Obtiene el rol asociado al usuario.
     *
     * @return string|mixed
     */
    public function roll()
    {
        // Si tienes una relación con otro modelo para el rol, como Role, puedes definirla aquí.
        // return $this->belongsTo(Role::class, 'rol');
        
        return $this->rol; // Si 'rol' es solo un atributo del modelo User
    }
}
