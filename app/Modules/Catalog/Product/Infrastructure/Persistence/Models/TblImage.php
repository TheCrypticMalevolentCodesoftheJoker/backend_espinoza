<?php

//--------------------------------------------------------------------------
// TblImage: Modelo Eloquent para la persistencia de imágenes de productos en base de datos
//--------------------------------------------------------------------------

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
    // Configuración: Relaciones del modelo con otras entidades de la base de datos
    //--------------------------------------------------------------------------
    public function tbl_product()
    {
        return $this->belongsTo(TblProduct::class, 'product_id');
    }
}
