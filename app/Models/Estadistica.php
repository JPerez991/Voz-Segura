<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estadistica
 * 
 * @property int $id
 * @property int $conteo_usuarios
 * @property int $publicaciones_foro
 * @property Carbon $h_creacion
 * @property int $citas_completadas
 *
 * @package App\Models
 */
class Estadistica extends Model
{
	protected $table = 'estadistica';
	public $timestamps = false;

	protected $casts = [
		'conteo_usuarios' => 'int',
		'publicaciones_foro' => 'int',
		'h_creacion' => 'datetime',
		'citas_completadas' => 'int'
	];

	protected $fillable = [
		'conteo_usuarios',
		'publicaciones_foro',
		'h_creacion',
		'citas_completadas'
	];
}
