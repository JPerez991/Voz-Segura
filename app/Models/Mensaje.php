<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Mensaje
 * 
 * @property int $id
 * @property int|null $id_envio
 * @property int|null $id_reseccion
 * @property string|null $contenido
 * @property Carbon $hora_creacion
 * @property bool|null $es_anonimo
 * @property bool|null $es_reportado
 * 
 * @property Perfile|null $perfile
 * @property Collection|ReporteSeguridad[] $reporte_seguridads
 *
 * @package App\Models
 */
class Mensaje extends Model
{
	protected $table = 'mensajes';
	public $timestamps = false;

	protected $casts = [
		'id_envio' => 'int',
		'id_reseccion' => 'int',
		'hora_creacion' => 'datetime',
		'es_anonimo' => 'bool',
		'es_reportado' => 'bool'
	];

	protected $fillable = [
		'id_envio',
		'id_reseccion',
		'contenido',
		'hora_creacion',
		'es_anonimo',
		'es_reportado'
	];

	public function perfile()
	{
		return $this->belongsTo(Perfile::class, 'id_reseccion');
	}

	public function reporte_seguridads()
	{
		return $this->hasMany(ReporteSeguridad::class, 'reporte_mensaje_id');
	}
}
