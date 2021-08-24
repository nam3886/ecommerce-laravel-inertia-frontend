<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_id',
        'order_id',
        'shop_id',
        'delivery_order_code',
        'required_note',
        // thanh toan/dat hang thanh cong => dat van chuyen => có tiền thu hộ
        // đã thanh toán => đã thu tiền ship
        // chưa thanh toán => cần thu ship và tiền hàng
        'cod_amount',
        'shipping_fee',
        'items_count',
        'discount',
        'tax',
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

    public function billingAddress(): HasOne
    {
        return $this->hasOne(BillingAddress::class, 'order_id', 'order_id');
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'order_id', 'order_id');
    }
}
