<?php
//--------------------------------------------------------------------------
// TblUser: Modelo Eloquent para la tabla tbl_user. Integra Sanctum para autenticación API.
//--------------------------------------------------------------------------

namespace App\Modules\User\Infrastructure\Persistence\Models;

use App\Modules\Role\Infrastructure\Persistence\Models\TblRol;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;


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
