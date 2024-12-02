<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['envia_id', 'recibe_id', 'mensaje', 'es_anonimo'];

    public function userEnvia()
    {
        return $this->belongsTo(User::class, 'envia_id');
    }

    public function userRecibe()
    {
        return $this->belongsTo(User::class, 'recibe_id');
    }
}
