<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $fillable = [
        'seo_title',
        'seo_image',
        'seo_description',
        'seo_keyword',
    ];

    protected $casts = [
        'seo_image' => 'object',
    ];

    public function seoable()
    {
        return $this->morphTo();
    }
}
