<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cita
 * 
 * @property int $id
 * @property int $id_usuario
 * @property int $id_psicologa
 * @property string $estatus
 * @property string $notas
 * 
 * @property Perfile $perfile
 *
 * @package App\Models
 */
class Cita extends Model
{
	protected $table = 'citas';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'id_psicologa' => 'int'
	];

	protected $fillable = [
		'id_usuario',
		'id_psicologa',
		'estatus',
		'notas'
	];

	public function perfile()
	{
		return $this->belongsTo(Perfile::class, 'id_usuario');
	}
}
