<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Pivot
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'order_id',
        'sku',
        'discount_id',
        'quantity',
        'price',
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class, 'sku', 'sku');
    }
}
