<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BillingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'delivery_method_id',
        'name',
        'phone',
        'ghn_address',
        'address',
        'updated_by',
    ];

    protected $casts = [
        'ghn_address' => 'object',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function subOrder(): BelongsTo
    {
        return $this->belongsTo(SubOrder::class, 'order_id', 'order_id');
    }
}
