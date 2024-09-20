<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RespuestaFoto
 * 
 * @property int $id
 * @property int|null $foro_id
 * @property int|null $usuario_id
 * @property string|null $contenido
 * @property Carbon $h_creacion
 * @property bool $es_anonimo
 * 
 * @property Foro|null $foro
 * @property Perfile|null $perfile
 *
 * @package App\Models
 */
class RespuestaFoto extends Model
{
	protected $table = 'respuesta_foto';
	public $timestamps = false;

	protected $casts = [
		'foro_id' => 'int',
		'usuario_id' => 'int',
		'h_creacion' => 'datetime',
		'es_anonimo' => 'bool'
	];

	protected $fillable = [
		'foro_id',
		'usuario_id',
		'contenido',
		'h_creacion',
		'es_anonimo'
	];

	public function foro()
	{
		return $this->belongsTo(Foro::class);
	}

	public function perfile()
	{
		return $this->belongsTo(Perfile::class, 'usuario_id');
	}
}
