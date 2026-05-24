<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TblPrice
 * 
 * @property int $id
 * @property int $product_id
 * @property float $amount
 * @property Carbon $start_date
 * @property Carbon|null $end_date
 * @property bool $status
 * 
 * @property TblProduct $tbl_product
 *
 * @package App\Models
 */
class TblPrice extends Model
{
    use HasFactory;
    protected $table = 'tbl_price';
    public $timestamps = false;

    protected $casts = [
        'product_id' => 'int',
        'amount' => 'float',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'bool'
    ];

    protected $fillable = [
        'product_id',
        'amount',
        'start_date',
        'end_date',
        'status'
    ];

    //--------------------------------------------------------------------------
    // RELACIONES -> Producto asociado al precio
    //--------------------------------------------------------------------------
    public function tbl_product()
    {
        return $this->belongsTo(TblProduct::class, 'product_id');
    }
}
