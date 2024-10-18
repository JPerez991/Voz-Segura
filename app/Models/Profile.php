<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Establece la tabla asociada, si no sigue la convención de Laravel
    protected $table = 'profiles';

    // Especifica los campos que se pueden llenar de manera masiva
    protected $fillable = [
        'user_id',         // Llave foránea
        'nombre_completo',
        'descripcion',
        'nombre_anonimo',
    
    ];

    // Define la relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    
}
