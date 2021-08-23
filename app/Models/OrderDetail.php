<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderDetail extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_id',
        'sub_order_id',
        'discount_id',
        'sku',
        'quantity',
        'price',
        'updated_by',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'sku', 'sku');
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class, 'sku', 'sku');
    }
}
