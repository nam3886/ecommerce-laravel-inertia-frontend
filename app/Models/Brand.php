<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'link',
        'image',
        'description',
        'content',
        'order',
        'updated_by',
        'active',
    ];

    protected $casts = [
        'image' => 'object',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
