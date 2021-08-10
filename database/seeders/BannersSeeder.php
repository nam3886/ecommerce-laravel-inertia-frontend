<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path       =   __DIR__ . '/json/banners.json';
        $banners  = json_decode(file_get_contents($path), true);

        foreach ($banners as  $banner) {
            unset($banner['id'], $banner['order']);
            $banner['image'] = collect($banner['image']['link'])
                ->reduce(function ($carry, $item, $key) use ($banner) {
                    array_push($carry, [
                        'name' => Str::slug($banner['title']) . '.webp',
                        'url' => $item,
                        'path' => $banner['image']['path'][$key],
                        'size' => 4240,
                        'ext' => 'webp',
                        'type' => 'image/webp',
                        'accepted' => "image/webp",
                        "dimensions" => [
                            "width" => intval($key),
                            "height" => intval($key)
                        ]
                    ]);
                    return $carry;
                }, [])[0];
            $banner['updated_by'] = 1;
            Banner::create($banner);
        }
    }
}
