<?php

namespace App\Modules\Analytics\Infrastructure\Persistence\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Models\TblProduct;

/**
 * Class TblArEvent
 * 
 * @property int $id
 * @property string $session_id
 * @property int $product_id
 * @property string $event_type
 * @property int|null $duration_seconds
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblProduct $tbl_product
 *
 * @package App\Models
 */
class TblArEvent extends Model
{
	use HasFactory;
	protected $table = 'tbl_ar_event';

	protected $casts = [
		'product_id' => 'int',
		'duration_seconds' => 'int'
	];

	protected $fillable = [
		'session_id',
		'product_id',
		'event_type',
		'duration_seconds'
	];

	public function tbl_product()
	{
		return $this->belongsTo(TblProduct::class, 'product_id');
	}
}
