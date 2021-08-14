<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserShippingAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'ghn_address',
        'address',
    ];

    protected $casts = [
        'ghn_address' => 'object',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
