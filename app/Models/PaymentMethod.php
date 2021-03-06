<?php

namespace App\Models;

use App\Models\Options\WithStandardPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes, WithStandardPrice;

    protected $fillable = [
        'name',
        'code',
        'price',
        'description',
        'updated_by',
        'active',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
