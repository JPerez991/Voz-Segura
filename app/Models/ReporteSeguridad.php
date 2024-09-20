<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ReporteSeguridad
 * 
 * @property int $id
 * @property int|null $reporte_mensaje_id
 * @property int|null $reportado_por
 * @property string|null $razon
 * @property Carbon $h_creacion
 * 
 * @property Mensaje|null $mensaje
 * @property Perfile|null $perfile
 *
 * @package App\Models
 */
class ReporteSeguridad extends Model
{
	protected $table = 'reporte_seguridad';
	public $timestamps = false;

	protected $casts = [
		'reporte_mensaje_id' => 'int',
		'reportado_por' => 'int',
		'h_creacion' => 'datetime'
	];

	protected $fillable = [
		'reporte_mensaje_id',
		'reportado_por',
		'razon',
		'h_creacion'
	];

	public function mensaje()
	{
		return $this->belongsTo(Mensaje::class, 'reporte_mensaje_id');
	}

	public function perfile()
	{
		return $this->belongsTo(Perfile::class, 'reportado_por');
	}
}
