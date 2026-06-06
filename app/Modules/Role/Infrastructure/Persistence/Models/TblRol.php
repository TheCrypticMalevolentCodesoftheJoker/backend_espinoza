<?php
//--------------------------------------------------------------------------
// TblRol: Modelo Eloquent para la tabla tbl_rol. Mapea atributos de persistencia del rol.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Infrastructure\Persistence\Models;

use App\Modules\User\Infrastructure\Persistence\Models\TblUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TblRol extends Model
{
    use HasFactory;
    protected $table = 'tbl_rol';

    protected $casts = [
        'status' => 'bool'
    ];

    protected $fillable = [
        'name',
        'status'
    ];

    //--------------------------------------------------------------------------
    // RELACIONES -> Usuarios asociados a este rol
    //--------------------------------------------------------------------------
    public function tbl_users()
    {
        return $this->hasMany(TblUser::class, 'role_id');
    }
}
