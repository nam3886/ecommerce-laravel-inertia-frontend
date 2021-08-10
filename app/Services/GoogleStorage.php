<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GoogleStorage
{
    private static $file;

    /**
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function __construct($file)
    {
        self::$file = $file;
    }

    /**
     * @param string $directory
     * @param string $fileName
     * @return array
     */
    public static function store($directory = '/', $fileName = null, UploadedFile $file = null): array
    {
        if (empty($file)) {
            $file = self::$file;
        }

        $fileName = $fileName ?? $file->getClientOriginalName();
        $directory = self::getOrNewDirectory($directory);
        $path = $file->storeAs($directory, $file->hashName());
        $path = collect(Storage::getMetadata($path))->get('path');
        $url = Storage::url($path);
        $type = $file->getMimeType();

        $fileInfo = [
            'name' => $fileName,
            'url' => $url,
            'path' => $path,
            'type' => $type,
            'accepted' => $type,
            'ext' => $file->getExtension(),
            'size' => $file->getSize(),
        ];

        // image => has dimensions
        if (str_contains($type, 'image')) {

            $size = getimagesize($file);
            $fileInfo['dimensions'] = [
                "width" => $size[0],
                "height" => $size[1]
            ];
        }

        return $fileInfo;
    }

    /**
     * @param separate $file
     * @return void
     */
    public static function delete(...$files): void
    {
        // nhiều files
        foreach ($files as $file) {
            if (is_object($file)) {
                Storage::exists($file->path) && Storage::delete($file->path);
            }
        }
    }


    /**
     * @param string $directory
     * @return string
     */
    public static function getOrNewDirectory($directory)
    {
        $recursive = false;
        $root = "/";
        $contents = collect(Storage::listContents($root, $recursive));
        $content = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $directory)
            ->first();

        if (empty($content)) {
            Storage::makeDirectory($directory);
            return self::getOrNewDirectory($directory);
        } else {
            return $content['path'];
        }
    }
}
