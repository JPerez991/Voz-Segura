<?php

namespace App\Models;

use App\controllers\PrograminSession;

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
        return $this->rol; // Si 'rol' es solo un atributo del modelo User
    }

    /** * Relación uno a muchos para obtener las sesiones donde el usuario actúa como psicóloga. * * @return \Illuminate\Database\Eloquent\Relations\HasMany */ 
    public function sesionesComoPsicologa()
    {
        return $this->hasMany(Sessions::class, 'psicologa_id');
    }
    /** * Relación uno a muchos para obtener las sesiones donde el usuario es el cliente o participante. * * @return \Illuminate\Database\Eloquent\Relations\HasMany */ 

    public function sesionesComoUsuario()
    {
        return $this->hasMany(Sessions::class, 'usuario_id');
    }
}
