<?php

namespace App\Modules\Catalog\Brand\Infrastructure\Persistence\Eloquent\Models;

use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Models\TblProduct;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblBrand
 * 
 * @property int $id
 * @property string $name
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TblProduct[] $tbl_products
 *
 * @package App\Models
 */
class TblBrand extends Model
{
	use HasFactory;
	
	protected $table = 'tbl_brand';

	protected $casts = [
		'status' => 'bool'
	];

	protected $fillable = [
		'name',
		'status'
	];

	public function tbl_products()
	{
		return $this->hasMany(TblProduct::class, 'brand_id');
	}
}
