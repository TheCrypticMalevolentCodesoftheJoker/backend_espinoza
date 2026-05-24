<?php

namespace App\Modules\Role\Infrastructure\Persistence\Models;

use App\Modules\User\Infrastructure\Persistence\Models\TblUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblRol
 * 
 * @property int $id
 * @property string $name
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblUser[] $tbl_users
 *
 * @package App\Models
 */
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
