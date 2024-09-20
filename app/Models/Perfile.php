<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Perfile
 * 
 * @property int $documento_pers
 * @property string|null $nombre_completo
 * @property string|null $descripcion
 * @property string $nombre_anonimo
 * @property Carbon $h_creado
 * @property Carbon $h_actulizado
 * 
 * @property Persona $persona
 * @property Collection|Cita[] $citas
 * @property Collection|Foro[] $foros
 * @property Collection|Mensaje[] $mensajes
 * @property Collection|ReporteSeguridad[] $reporte_seguridads
 * @property Collection|RespuestaFoto[] $respuesta_fotos
 *
 * @package App\Models
 */
class Perfile extends Model
{
	protected $table = 'perfiles';
	protected $primaryKey = 'documento_pers';
	public $timestamps = false;

	protected $casts = [
		'h_creado' => 'datetime',
		'h_actulizado' => 'datetime'
	];

	protected $fillable = [
		'nombre_completo',
		'descripcion',
		'nombre_anonimo',
		'h_creado',
		'h_actulizado'
	];

	public function persona()
	{
		return $this->belongsTo(Persona::class, 'documento_pers');
	}

	public function citas()
	{
		return $this->hasMany(Cita::class, 'id_usuario');
	}

	public function foros()
	{
		return $this->hasMany(Foro::class, 'creado_por');
	}

	public function mensajes()
	{
		return $this->hasMany(Mensaje::class, 'id_reseccion');
	}

	public function reporte_seguridads()
	{
		return $this->hasMany(ReporteSeguridad::class, 'reportado_por');
	}

	public function respuesta_fotos()
	{
		return $this->hasMany(RespuestaFoto::class, 'usuario_id');
	}
}
