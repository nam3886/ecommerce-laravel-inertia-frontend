<?php

namespace App\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Models\Options\WithDiscountPrice;
use App\Models\Options\WithStandardPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,
        SoftDeletes,
        WithStandardPrice,
        WithDiscountPrice,
        EagerLoadPivotTrait;

    protected $fillable = [
        'brand_id',
        'shop_id',
        'name',
        'slug',
        'sku',
        'flag',
        'sub_description',
        'description',
        'price',
        'quantity',
        'weight',
        'length',
        'width',
        'height',
        'view',
        'is_featured',
        'order',
        'updated_by',
        'active',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function gallery(): HasOne
    {
        return $this->hasOne(Gallery::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    public function variants(): hasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class, 'sku', 'sku')
            ->whereActive(1)
            ->whereDate('end', '>', now());
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_details')
            ->using(OrderDetail::class)
            ->withPivot('price', 'quantity', 'sku');
    }

    public function subOrders(): BelongsToMany
    {
        return $this->belongsToMany(SubOrder::class, 'order_details')
            ->using(OrderDetail::class)
            ->withPivot('price', 'quantity', 'sku');
    }

    /*
    |--------------------------------------------------------------------------
    | Scope
    |--------------------------------------------------------------------------
    */
    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }

    /*
    |--------------------------------------------------------------------------
    | Some methods
    |--------------------------------------------------------------------------
    */
    public function hasVariants(): bool
    {
        return $this->variants()->count();
    }
}
