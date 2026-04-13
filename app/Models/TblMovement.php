<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblMovement
 * 
 * @property int $id
 * @property int $product_id
 * @property int $warehouse_id
 * @property string $type
 * @property int $quantity
 * @property Carbon $movement_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblProduct $tbl_product
 * @property TblWarehouse $tbl_warehouse
 *
 * @package App\Models
 */
class TblMovement extends Model
{
    use HasFactory;
	protected $table = 'tbl_movement';

	protected $casts = [
		'product_id' => 'int',
		'warehouse_id' => 'int',
		'quantity' => 'int',
		'movement_date' => 'datetime'
	];

	protected $fillable = [
		'product_id',
		'warehouse_id',
		'type',
		'quantity',
		'movement_date'
	];

	public function tbl_product()
	{
		return $this->belongsTo(TblProduct::class, 'product_id');
	}

	public function tbl_warehouse()
	{
		return $this->belongsTo(TblWarehouse::class, 'warehouse_id');
	}
}
