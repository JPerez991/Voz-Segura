<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Persona
 * 
 * @property int $documento
 * @property string|null $nombre_usuario
 * @property string|null $contraseña
 * @property string|null $rol
 * @property bool $es_anonimo
 * @property string|null $foto_perfil
 * @property Carbon $h_creado
 * @property Carbon $h_actulizado
 * @property string|null $email
 * 
 * @property Perfile $perfile
 *
 * @package App\Models
 */
class Persona extends Model
{
	protected $table = 'persona';
	protected $primaryKey = 'documento';
	public $timestamps = false;

	protected $casts = [
		'es_anonimo' => 'bool',
		'h_creado' => 'datetime',
		'h_actulizado' => 'datetime'
	];

	protected $fillable = [
		'nombre_usuario',
		'contraseña',
		'rol',
		'es_anonimo',
		'foto_perfil',
		'h_creado',
		'h_actulizado',
		'email'
	];

	public function perfile()
	{
		return $this->hasOne(Perfile::class, 'documento_pers');
	}
}
