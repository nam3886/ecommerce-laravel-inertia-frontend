<?php

namespace App\Models;

use App\Models\Options\WithDiscountPrice;
use App\Models\Options\WithStandardPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use HasFactory, SoftDeletes, WithStandardPrice, WithDiscountPrice;

    protected $fillable = [
        'product_id',
        'sku',
        'combination',
        'name',
        'price',
        'quantity',
        'weight',
        'length',
        'width',
        'height',
        'active',
        'updated_by',
    ];

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'attribute_value_variant');
    }
}
