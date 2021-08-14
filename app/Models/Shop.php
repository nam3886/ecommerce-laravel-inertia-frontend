<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ghn_shop_id',
        'slug',
        'phone',
        'name',
        'address',
        'ghn_address',
        'avatar',
    ];

    protected $casts = [
        'ghn_address' => 'object',
        'avatar' => 'object',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
