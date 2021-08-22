<?php

use App\Helpers\Currency;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

if (!function_exists('get_site_image_link')) {
    /**
     * @param string $configName
     * @return \Illuminate\Support\Collection
     */
    function get_site_image_link(?string $configName): ?string
    {
        return collect(json_decode(config("settings.{$configName}"))?->link)->first();
    }
}

if (!function_exists('get_uniqid_code')) {
    /**
     * @param string $prefix
     * @return string
     */
    function get_uniqid_code(string $prefix = ''): string
    {
        return $prefix . strtoupper(bin2hex(random_bytes(4)));
    }
}

if (!function_exists('create_slug')) {
    /**
     * @param string $name
     * @return string
     */
    function create_slug(string $name): string
    {
        return Str::slug($name) . '-' . get_uniqid_code();
    }
}

if (!function_exists('is_uploadable')) {
    /**
     * @param mix $file
     * @return bool
     */
    function is_uploadable($file): bool
    {
        return $file instanceof UploadedFile;
    }
}

if (!function_exists('easy_format_price')) {
    /**
     * @param mix $price
     * @return string
     */
    function easy_format_price($price): string
    {
        return Currency::autoFormatCurrency($price);
    }
}
