<?php

/**
 * Created by Reliese Model.
 */

namespace App\Modules\User\Infrastructure\Persistence\Eloquent\Models;

use App\Modules\Role\Infrastructure\Persistence\Eloquent\Models\TblRol;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * Class TblUser
 * 
 * @property int $id
 * @property int $role_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $status
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblRol $tbl_rol
 *
 * @package App\Models
 */
class TblUser extends Authenticatable
{
	use HasFactory, Notifiable;
	protected $table = 'tbl_user';

	protected $casts = [
		'role_id' => 'int',
		'status' => 'bool'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'role_id',
		'name',
		'email',
		'password',
		'status',
		'remember_token'
	];

	public function tbl_rol()
	{
		return $this->belongsTo(TblRol::class, 'role_id');
	}
}
