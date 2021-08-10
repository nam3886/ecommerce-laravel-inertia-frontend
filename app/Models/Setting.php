<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'key',
        'value',
        'updated_by'
    ];

    /**
     * @param $key
     */
    public static function get($key)
    {
        $setting    =   new self();
        $entry      =   $setting->where('key', $key)->first();

        return $entry ? $entry->value : null;
    }

    /**
     * @param $key
     * @param null $value
     * @return bool
     */
    public static function set($key, $value = null): bool
    {
        $setting        =   new self();
        $entry          =   $setting->where('key', $key)->firstOrFail();
        $entry->value   =   $value;
        $entry->saveOrFail();
        // set config
        config(['key' => $value]);

        return config($key) == $value;
    }
}
