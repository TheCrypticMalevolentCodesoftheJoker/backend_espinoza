<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblWarehouse
 * 
 * @property int $id
 * @property string $name
 * @property string $ubicacion
 * @property string $location
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblMovement[] $tbl_movements
 * @property Collection|TblStock[] $tbl_stocks
 *
 * @package App\Models
 */
class TblWarehouse extends Model
{
    use HasFactory;
	protected $table = 'tbl_warehouse';

	protected $casts = [
		'status' => 'bool'
	];

	protected $fillable = [
		'name',
		'ubicacion',
		'location',
		'status'
	];

	public function tbl_movements()
	{
		return $this->hasMany(TblMovement::class, 'warehouse_id');
	}

	public function tbl_stocks()
	{
		return $this->hasMany(TblStock::class, 'warehouse_id');
	}
}
