<?php

namespace App\Traits;

use App\Services\GoogleStorage;
use App\Services\ImageService;
use Illuminate\Http\UploadedFile;

/**
 * Trait UploadAble
 * @package App\Traits
 */
trait UploadAble
{
    private int $width = 200;
    private int $height = 200;
    private string $folder = '/';

    /**
     * @param UploadedFile $file
     * @param string $disk
     * @param null $filename
     * @return array
     */
    public function resizeAndUploadOne(UploadedFile $file, $filename = null)
    {
        return ImageService::resizeImage($file, $this->height, $this->width)->store($this->folder, $filename);
    }

    /**
     * @param UploadedFile $file
     * @param string $filename
     * @return array
     */
    public function uploadOne(UploadedFile $file, string $filename = null)
    {
        return GoogleStorage::store($this->folder, $filename, $file);
    }

    /**
     * @param mixed $file
     * @param bool $condition
     * @param string $filename
     * @return mixed
     * if cannot upload => return file in param
     */
    public function uploadOneIf(bool $condition, mixed $file, string $filename = null)
    {
        return $condition ? GoogleStorage::store($this->folder, $filename, $file) : $file;
    }

    /**
     * @param array $files
     * @param string $disk
     * @param array $filenames
     * @return array
     */
    public function uploadMultiple(array $files, array $filenames = [])
    {
        return collect($files)->map(function ($file, $key) use ($filenames) {
            $name = $filenames[$key] ?? null;
            return $this->uploadOne($file, $name);
        });
    }

    /**
     * @param $files
     * @return void
     */
    public function deleteFile(...$files)
    {
        GoogleStorage::delete(...$files);
    }

    /**
     * @param bool $condition
     * @param $files
     * @return void
     */
    public function deleteFileIf(bool $condition, ...$files)
    {
        if ($condition) {
            $this->deleteFile(...$files);
        }
    }
}
