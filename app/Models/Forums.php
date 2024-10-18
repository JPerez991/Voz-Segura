<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forums extends Model
{
    use HasFactory;

    // Los campos que se pueden llenar
    protected $fillable = ['tema', 'descripcion', 'creado_por'];

    // Relación con el usuario que creó el foro
    public function user()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

     // Relación con las respuestas del foro
     public function replies()
     {
         return $this->hasMany(ForumReply::class, 'forum_id');
     }
}
