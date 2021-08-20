<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_id',
        'order_id',
        'shop_id',
        'delivery_method_id',
        'delivery_order_code',
        'required_note',
        'cod_amount',
        'delivery_fee',
        'items_count',
        'discount_price',
        'tax_price',
        'subtotal',
        'total',
        'grandtotal',
        'note',
        'status',
        'active',
        'updated_by',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function deliveryMethod(): BelongsTo
    {
        return $this->belongsTo(DeliveryMethod::class);
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_details')
            ->using(OrderDetail::class)
            ->withPivot('price', 'quantity', 'sku');
    }
}
