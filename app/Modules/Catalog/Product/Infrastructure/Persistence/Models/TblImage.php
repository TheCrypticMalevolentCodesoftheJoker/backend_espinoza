<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblImage
 * 
 * @property int $id
 * @property int $product_id
 * @property string $url
 * @property string $type
 * 
 * @property TblProduct $tbl_product
 *
 * @package App\Models
 */
class TblImage extends Model
{
    use HasFactory;
    protected $table = 'tbl_image';
    public $timestamps = false;

    protected $casts = [
        'product_id' => 'int'
    ];

    protected $fillable = [
        'product_id',
        'url',
        'type'
    ];

    //--------------------------------------------------------------------------
    // RELACIONES -> Producto asociado a la imagen
    //--------------------------------------------------------------------------
    public function tbl_product()
    {
        return $this->belongsTo(TblProduct::class, 'product_id');
    }
}
