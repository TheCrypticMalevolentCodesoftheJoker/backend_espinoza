<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Models;

use App\Modules\Catalog\Brand\Infrastructure\Persistence\Models\TblBrand;
use App\Modules\Catalog\Category\Infrastructure\Persistence\Models\TblCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TblProduct
 * 
 * @property int $id
 * @property string $code
 * @property int $category_id
 * @property int $brand_id
 * @property string $name
 * @property string|null $description
 * @property string $length
 * @property string $width
 * @property string $thickness
 * @property int $stock
 * @property bool $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property TblBrand $tbl_brand
 * @property TblCategory $tbl_category
 * @property Collection|TblDiscount[] $tbl_discounts
 * @property Collection|TblImage[] $tbl_images
 * @property Collection|TblPrice[] $tbl_prices
 *
 * @package App\Models
 */
class TblProduct extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tbl_product';

    protected $casts = [
        'category_id' => 'int',
        'brand_id' => 'int',
        'stock' => 'int',
        'status' => 'bool'
    ];

    protected $fillable = [
        'code',
        'category_id',
        'brand_id',
        'name',
        'description',
        'length',
        'width',
        'thickness',
        'stock',
        'status'
    ];

    //--------------------------------------------------------------------------
    // RELACIONES -> Marca asociada al producto
    //--------------------------------------------------------------------------
    public function tbl_brand()
    {
        return $this->belongsTo(TblBrand::class, 'brand_id');
    }

    //--------------------------------------------------------------------------
    // RELACIONES -> Categoría asociada al producto
    //--------------------------------------------------------------------------
    public function tbl_category()
    {
        return $this->belongsTo(TblCategory::class, 'category_id');
    }

    //--------------------------------------------------------------------------
    // RELACIONES -> Historial de descuentos del producto
    //--------------------------------------------------------------------------
    public function tbl_discounts()
    {
        return $this->hasMany(TblDiscount::class, 'product_id');
    }

    //--------------------------------------------------------------------------
    // RELACIONES -> Galería de imágenes del producto
    //--------------------------------------------------------------------------
    public function tbl_images()
    {
        return $this->hasMany(TblImage::class, 'product_id');
    }

    //--------------------------------------------------------------------------
    // RELACIONES -> Historial de precios del producto
    //--------------------------------------------------------------------------
    public function tbl_prices()
    {
        return $this->hasMany(TblPrice::class, 'product_id');
    }
}
