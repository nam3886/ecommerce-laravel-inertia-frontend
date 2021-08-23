<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'user_id',
        'payment_method_id',
        'items_count',
        'discount',
        'tax',
        'subtotal',
        'total',
        'grandtotal',
        'create_order_success',
        'active',
        'updated_by',
    ];

    public function setOrderCodeAttribute($value)
    {
        $this->attributes['order_code'] = strtoupper($value);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subOrders(): HasMany
    {
        return $this->hasMany(SubOrder::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_details')
            ->using(OrderDetail::class)
            ->withPivot('price', 'quantity', 'sku');
    }

    public function billingAddress(): HasOne
    {
        return $this->hasOne(BillingAddress::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
