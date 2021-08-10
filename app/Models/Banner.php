<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =   [
        'image',
        'position',
        'link',
        'title',
        'content',
        'order',
        'updated_by',
        'active',
    ];

    protected $casts = [
        'image' => 'object'
    ];
}
