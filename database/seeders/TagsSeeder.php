<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'updated_by'        =>  1,
                'name'              =>  'shoes',
                'slug'              => create_slug('shoes'),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  "women's shoes",
                'slug'              => create_slug('women\'s shoes'),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  "men's shoes",
                'slug'              => create_slug('men\'s shoes'),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  't-shirt',
                'slug'              => create_slug('t-shirt'),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  'electronics',
                'slug'              => create_slug('electronics'),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  'furniture',
                'slug'              => create_slug('furniture'),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  'beauty',
                'slug'              => create_slug('beauty'),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  'white',
                'slug'              => create_slug('white'),
            ],
        ];

        Tag::insert($tags);
    }
}
