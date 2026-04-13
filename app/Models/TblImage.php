<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblImage
 * 
 * @property int $id
 * @property int $product_id
 * @property string $url
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TblProduct $tbl_product
 *
 * @package App\Models
 */
class TblImage extends Model
{
    use HasFactory;
	protected $table = 'tbl_image';

	protected $casts = [
		'product_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'url',
		'type'
	];

	public function tbl_product()
	{
		return $this->belongsTo(TblProduct::class, 'product_id');
	}
}
