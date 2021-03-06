<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use App\Services\GoogleStorageService;

class ImageService
{
    /**
     * @param \Illuminate\Http\UploadedFile $image
     * @param int $height
     * @param int $width
     * @param string $encode
     * @return \App\Services\GoogleStorageService
     */
    public static function resizeImage($image, $height, $width, $encode = 'webp')
    {
        $fileName = $image->getClientOriginalName() . '.' . $encode;

        $image = Image::make($image)->fit($width, $height)->encode($encode);

        $path = "/intervention-tmp/{$fileName}";

        Storage::disk('local')->put($path, $image);

        $image = new UploadedFile(storage_path('app') . $path, $fileName);

        return new GoogleStorageService($image);
    }
}
