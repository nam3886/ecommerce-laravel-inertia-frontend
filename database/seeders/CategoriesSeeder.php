<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $text = 'Enim sunt et asperiores numquam voluptate amet deserunt. A dolore atque repellat qui veniam aspernatur voluptas inventore. Ad optio dolor debitis et et. Ipsum quis ut hic omnis reiciendis quas et. Aut non maiores voluptatem. Deleniti quia quae illo voluptas. Fugiat voluptas ea illum ullam. Deleniti enim nulla magni sed repellat. Officia et dolor explicabo. Molestiae et sed totam aperiam pariatur enim. Ipsum qui ea sunt vitae. Consequuntur animi ea tempore dignissimos.';

        $categories = [
            [
                'name'              =>  'shoes',
                'slug'              => create_slug('shoes'),
            ],
            [
                'name'              =>  "women's shoes",
                'slug'              => create_slug('women\'s shoes'),
                'parent_id'         =>  1,
            ],
            [
                'name'              =>  "men's shoes",
                'slug'              => create_slug('men\'s shoes'),
                'parent_id'         =>  1,
            ],
            [
                'name'              =>  't-shirt',
                'slug'              => create_slug('t-shirt'),
            ],
            [
                'name'              =>  'electronics',
                'slug'              => create_slug('electronics'),
            ]
        ];

        $seos = [
            [
                'seo_image'         =>  [
                    'name' => 'electronics.webp',
                    'url' => 'https://drive.google.com/uc?id=1NptZDwc-pPtRjl6VQnBr3gmHUZMmplo1&export=media',
                    'path' => '1znI-7ibCvvOe45pkMKqu28afhsOS-eM-/1NptZDwc-pPtRjl6VQnBr3gmHUZMmplo1',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'seo_title'         =>  'electronics',
                'seo_description'   =>  $text,
                'seo_keyword'       =>  'electronics',
            ],
            [
                'seo_image'         =>  [
                    'name' => 't_shirt.webp',
                    'url' => 'https://drive.google.com/uc?id=1Y2gjiwp9HVozh93nUIKByP-jWZOhtGm3&export=media',
                    'path' => '1znI-7ibCvvOe45pkMKqu28afhsOS-eM-/1Y2gjiwp9HVozh93nUIKByP-jWZOhtGm3',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'seo_title'         =>  't-shirt',
                'seo_description'   =>  $text,
                'seo_keyword'       =>  't-shirt',
            ],
            [
                'seo_image'         =>  [
                    'name' => 'men_\'s_shoes.webp',
                    'url' => 'https://drive.google.com/uc?id=11Wgy77dPA4lrXHB582en5aZGrmAm2XiC&export=media',
                    'path' => '1znI-7ibCvvOe45pkMKqu28afhsOS-eM-/11Wgy77dPA4lrXHB582en5aZGrmAm2XiC',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'seo_title'         =>  "men's shoes",
                'seo_description'   =>  $text,
                'seo_keyword'       =>  "men's shoes",
            ],
            [
                'seo_image'         =>  [
                    'name' => 'women_\'s_shoes.webp',
                    'url' => 'https://drive.google.com/uc?id=1xH56b6_AQq_kFNpfd-yhUrzT8PdNjbnP&export=media',
                    'path' => '1znI-7ibCvvOe45pkMKqu28afhsOS-eM-/1xH56b6_AQq_kFNpfd-yhUrzT8PdNjbnP',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'seo_title'         =>  "women's shoes",
                'seo_description'   =>  $text,
                'seo_keyword'       =>  "women's shoes",
            ], [
                'seo_image'         =>  [
                    'name' => 'shoes.webp',
                    'url' => 'https://drive.google.com/uc?id=1gfCE0R5Yj_JXxRxR1IVMvj2WnL8m_gtM&export=media',
                    'path' => '1znI-7ibCvvOe45pkMKqu28afhsOS-eM-/1gfCE0R5Yj_JXxRxR1IVMvj2WnL8m_gtM',
                    'size' => 4240,
                    'ext' => 'webp',
                    'type' => 'image/webp',
                    'accepted' => "image/webp",
                    "dimensions" => [
                        "width" => 480,
                        "height" => 400
                    ]
                ],
                'seo_title'         =>  'shoes',
                'seo_description'   =>  $text,
                'seo_keyword'       =>  'shoes',
            ],
        ];

        foreach ($categories as $key => $category) {
            $category['updated_by'] = 1;
            $newCategory = Category::create($category);
            $newCategory->seo()->create($seos[$key]);
        }
    }
}
