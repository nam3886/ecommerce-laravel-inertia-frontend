<?php

use App\Helpers\Currency;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

if (!function_exists('get_site_image_link')) {
    function get_site_image_link(?string $configName): ?string
    {
        return collect(json_decode(config("settings.{$configName}"))?->link)->first();
    }
}

if (!function_exists('get_uniqid_code')) {
    function get_uniqid_code(): string
    {
        return strtoupper(bin2hex(random_bytes(4)));
    }
}

if (!function_exists('create_slug')) {
    function create_slug(string $name): string
    {
        return Str::slug($name) . '-' . get_uniqid_code();
    }
}

if (!function_exists('is_uploadable')) {
    function is_uploadable($file): bool
    {
        return $file instanceof UploadedFile;
    }
}

if (!function_exists('easy_format_price')) {
    function easy_format_price($price): string
    {
        return Currency::autoFormatCurrency($price);
    }
}
