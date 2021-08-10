<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $text = 'Enim sunt et asperiores numquam voluptate amet deserunt. A dolore atque repellat qui veniam aspernatur voluptas inventore. Ad optio dolor debitis et et. Ipsum quis ut hic omnis reiciendis quas et. Aut non maiores voluptatem. Deleniti quia quae illo voluptas. Fugiat voluptas ea illum ullam. Deleniti enim nulla magni sed repellat. Officia et dolor explicabo. Molestiae et sed totam aperiam pariatur enim. Ipsum qui ea sunt vitae. Consequuntur animi ea tempore dignissimos.';

        $brands = [
            [
                'name'          =>  'Adidas',
                'slug'          =>  create_slug('Adidas'),
                'image'         =>  [
                    'name' => 'adidas.webp',
                    'url' => 'https://drive.google.com/uc?id=1tofXuKPLsmbB7dkNSmo3dk3N4MCTeZnH&export=media',
                    'path' => '1OFA7QsFRc6SSLku5G6sDP_TF55H_z-E4/1tofXuKPLsmbB7dkNSmo3dk3N4MCTeZnH',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'description'   =>  $text,
                'content'       =>  $text
            ],
            [
                'name'          =>  'Nike',
                'slug'          =>  create_slug('Nike'),
                'image'         =>  [
                    'name' => 'nike.webp',
                    'url' => 'https://drive.google.com/uc?id=1hMF7bNQJ7j51QTX4Cp_T-Unw481sID27&export=media',
                    'path' => '1OFA7QsFRc6SSLku5G6sDP_TF55H_z-E4/1hMF7bNQJ7j51QTX4Cp_T-Unw481sID27',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ],
                ],
                'description'   =>  $text,
                'content'       =>  $text
            ],
            [
                'name'          =>  'Alexander Mcqueen',
                'slug'          =>  create_slug('Alexander Mcqueen'),
                'image'         =>  [
                    'name' => 'alexander_mcqueen.webp',
                    'url' => 'https://drive.google.com/uc?id=1X83jNbbWGYvGIwXjTptRp92T0sqIpKoo&export=media',
                    'path' => '1OFA7QsFRc6SSLku5G6sDP_TF55H_z-E4/1X83jNbbWGYvGIwXjTptRp92T0sqIpKoo',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'description'   =>  $text,
                'content'       =>  $text
            ],
            [
                'name'          =>  'Balenciaga ',
                'slug'          =>  create_slug('Balenciaga'),
                'image'         =>  [
                    'name' => 'balenciaga.webp',
                    'url' => 'https://drive.google.com/uc?id=1s2HjYISuSG4QUPBhVBRapFVBsztgolc8&export=media',
                    'path' => '1OFA7QsFRc6SSLku5G6sDP_TF55H_z-E4/1s2HjYISuSG4QUPBhVBRapFVBsztgolc8',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'description'   =>  $text,
                'content'       =>  $text
            ],
            [
                'name'          =>  'New Balance',
                'slug'          =>  create_slug('New Balance'),
                'image'         =>  [
                    'name' => 'new_balance.webp',
                    'url' => 'https://drive.google.com/uc?id=1AlfSwv5P6zyejwjPXGWm36TJpbT5pCCI&export=media',
                    'path' => '1OFA7QsFRc6SSLku5G6sDP_TF55H_z-E4/1AlfSwv5P6zyejwjPXGWm36TJpbT5pCCI',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'description'   =>  $text,
                'content'       =>  $text
            ],
            [
                'name'          =>  'Converse',
                'slug'          =>  create_slug('Converse'),
                'image'         =>  [
                    'name' => 'converse.webp',
                    'url' => 'https://drive.google.com/uc?id=1xjQ0mtOaL-O-XyolnwCVrysCKx9gC8XI&export=media',
                    'path' => '1OFA7QsFRc6SSLku5G6sDP_TF55H_z-E4/1xjQ0mtOaL-O-XyolnwCVrysCKx9gC8XI',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'description'   =>  $text,
                'content'       =>  $text
            ],
            [
                'name'          =>  'Vans',
                'slug'          =>  create_slug('Vans'),
                'image'         =>  [
                    'name' => 'vans.webp',
                    'url' => 'https://drive.google.com/uc?id=1e0o9ZJG7jue-IiLIgRCz-P_wp76adOTQ&export=media',
                    'path' => '1OFA7QsFRc6SSLku5G6sDP_TF55H_z-E4/1e0o9ZJG7jue-IiLIgRCz-P_wp76adOTQ',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'description'   =>  $text,
                'content'       =>  $text
            ],
            [
                'name'          =>  'Puma',
                'slug'          =>  create_slug('Puma'),
                'image'         =>  [
                    'name' => 'puma.webp',
                    'url' => 'https://drive.google.com/uc?id=1Dmmcwm9V0eS7tjfWwP6VfJYjENNenj_w&export=media',
                    'path' => '1OFA7QsFRc6SSLku5G6sDP_TF55H_z-E4/1Dmmcwm9V0eS7tjfWwP6VfJYjENNenj_w',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'description'   =>  $text,
                'content'       =>  $text
            ],
            [
                'name'          =>  'MLB',
                'slug'          =>  create_slug('MLB'),
                'image'         =>  [
                    'name' => 'mlb.webp',
                    'url' => 'https://drive.google.com/uc?id=1JIrOow_tYVppxclaqX99Puob4Zfas9C2&export=media',
                    'path' => '1OFA7QsFRc6SSLku5G6sDP_TF55H_z-E4/1JIrOow_tYVppxclaqX99Puob4Zfas9C2',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'description'   =>  $text,
                'content'       =>  $text
            ],
            [
                'name'          =>  'Other',
                'slug'          =>  create_slug('Other'),
                'image'         =>  [
                    'name' => 'other.webp',
                    'url' => 'https://drive.google.com/uc?id=1Le9I97iAmuztvI3OI03r8a12m6rtyJie&export=media',
                    'path' => '1OFA7QsFRc6SSLku5G6sDP_TF55H_z-E4/1Le9I97iAmuztvI3OI03r8a12m6rtyJie',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'description'   =>  $text,
                'content'       =>  $text
            ]
        ];

        foreach ($brands as $brand) {
            $brand['updated_by'] = 1;
            Brand::create($brand);
        }
    }
}
