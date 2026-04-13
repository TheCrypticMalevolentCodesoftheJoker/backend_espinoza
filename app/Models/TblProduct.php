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
 * Class TblProduct
 * 
 * @property int $id
 * @property string $code
 * @property int $category_id
 * @property int $brand_id
 * @property string $name
 * @property string|null $description
 * @property string $unit_measure
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblBrand $tbl_brand
 * @property TblCategory $tbl_category
 * @property Collection|TblDimension[] $tbl_dimensions
 * @property Collection|TblDiscount[] $tbl_discounts
 * @property Collection|TblImage[] $tbl_images
 * @property Collection|TblMovement[] $tbl_movements
 * @property Collection|TblPrice[] $tbl_prices
 * @property Collection|TblStock[] $tbl_stocks
 *
 * @package App\Models
 */
class TblProduct extends Model
{
    use HasFactory;
	protected $table = 'tbl_product';

	protected $casts = [
		'category_id' => 'int',
		'brand_id' => 'int',
		'status' => 'bool'
	];

	protected $fillable = [
		'code',
		'category_id',
		'brand_id',
		'name',
		'description',
		'unit_measure',
		'status'
	];

	public function tbl_brand()
	{
		return $this->belongsTo(TblBrand::class, 'brand_id');
	}

	public function tbl_category()
	{
		return $this->belongsTo(TblCategory::class, 'category_id');
	}

	public function tbl_dimensions()
	{
		return $this->hasMany(TblDimension::class, 'product_id');
	}

	public function tbl_discounts()
	{
		return $this->hasMany(TblDiscount::class, 'product_id');
	}

	public function tbl_images()
	{
		return $this->hasMany(TblImage::class, 'product_id');
	}

	public function tbl_movements()
	{
		return $this->hasMany(TblMovement::class, 'product_id');
	}

	public function tbl_prices()
	{
		return $this->hasMany(TblPrice::class, 'product_id');
	}

	public function tbl_stocks()
	{
		return $this->hasMany(TblStock::class, 'product_id');
	}
}
