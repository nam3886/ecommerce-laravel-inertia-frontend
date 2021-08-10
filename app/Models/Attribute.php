<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'frontend_type',
        'is_filterable',
        'is_required',
        'active',
        'updated_by',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }
}
