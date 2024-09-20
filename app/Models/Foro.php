<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Foro
 * 
 * @property int $id
 * @property int $creado_por
 * @property string $tema
 * @property Carbon $h_creacion
 * @property Carbon $h_actulizacion
 * 
 * @property Perfile $perfile
 * @property Collection|RespuestaFoto[] $respuesta_fotos
 *
 * @package App\Models
 */
class Foro extends Model
{
	protected $table = 'foros';
	public $timestamps = false;

	protected $casts = [
		'creado_por' => 'int',
		'h_creacion' => 'datetime',
		'h_actulizacion' => 'datetime'
	];

	protected $fillable = [
		'creado_por',
		'tema',
		'h_creacion',
		'h_actulizacion'
	];

	public function perfile()
	{
		return $this->belongsTo(Perfile::class, 'creado_por');
	}

	public function respuesta_fotos()
	{
		return $this->hasMany(RespuestaFoto::class);
	}
}
