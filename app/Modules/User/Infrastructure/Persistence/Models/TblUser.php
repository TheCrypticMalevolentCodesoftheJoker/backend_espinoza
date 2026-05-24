<?php

namespace App\Modules\User\Infrastructure\Persistence\Models;

use App\Modules\Role\Infrastructure\Persistence\Models\TblRol;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class TblUser
 * 
 * @property int $id
 * @property int $role_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblRol $tbl_rol
 *
 * @package App\Models
 */
class TblUser extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'tbl_user';

    protected $casts = [
        'role_id' => 'int',
        'status' => 'bool'
    ];

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'status'
    ];

    //--------------------------------------------------------------------------
    // RELACIONES -> Rol asignado al usuario
    //--------------------------------------------------------------------------
    public function tbl_rol()
    {
        return $this->belongsTo(TblRol::class, 'role_id');
    }
}
