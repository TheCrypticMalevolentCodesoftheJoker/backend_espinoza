<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblDimension
 * 
 * @property int $id
 * @property int $product_id
 * @property string $length
 * @property string $width
 * @property string $thickness
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblProduct $tbl_product
 *
 * @package App\Models
 */
class TblDimension extends Model
{
    use HasFactory;
	protected $table = 'tbl_dimension';

	protected $casts = [
		'product_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'length',
		'width',
		'thickness'
	];

	public function tbl_product()
	{
		return $this->belongsTo(TblProduct::class, 'product_id');
	}
}
