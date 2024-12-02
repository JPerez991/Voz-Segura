<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    use HasFactory;


    protected $fillable = [
        'psicologa_id',
        'usuario_id',
        'tipo_sesion',
        'descripcion',
        'fecha_hora',
        'completada',
    ];

    // Relación con el modelo User para la psicóloga
    public function psicologa()
    {
        return $this->belongsTo(User::class, 'psicologa_id');
    }

    // Relación con el modelo User para el usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
