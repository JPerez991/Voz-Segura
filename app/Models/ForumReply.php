<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    use HasFactory;

    protected $table = 'forum_replies'; // Especificamos el nombre de la tabla si no sigue la convención
    
    protected $fillable = ['forum_id', 'user_id', 'responder', 'es_anonimo'];

    // Relación con el foro
    public function forum()
    {
        return $this->belongsTo(Forums::class, 'forum_id');
    }

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
