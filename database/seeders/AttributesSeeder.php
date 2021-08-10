<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $null = Attribute::create([
        //     'code' => 'null',
        //     'name' => 'null',
        //     'updated_by' => 1,
        // ]);
        // $null->values()->createMany([
        //     ['updated_by' => 1, 'code' => 'null', 'name' => 'null', 'active' => 0],
        // ]);

        $size = Attribute::create([
            'code' => 'size',
            'name' => 'Size',
            'frontend_type' => 'radio',
            'is_filterable' => 1,
            'updated_by' => 1,
        ]);
        $size->values()->createMany([
            ...array_map(fn ($item) => ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => $item], range(38, 45)),
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'S'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'M'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'L'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'XL'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'XXL'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'XXXL'],
        ]);

        $color = Attribute::create([
            'code' => 'color',
            'name' => 'Color',
            'frontend_type' => 'radio',
            'is_filterable' => 1,
            'updated_by' => 1,
        ]);
        $color->values()->createMany([
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'gray'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'green'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'white'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'black'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'blue'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'navy'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'creamy white'],
        ]);

        $material = Attribute::create([
            'code' => 'material',
            'name' => 'Material',
            'frontend_type' => 'radio',
            'updated_by' => 1,
        ]);
        $material->values()->createMany([
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'wood'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'cotton'],
            ['updated_by' => 1, 'code' => get_uniqid_code(), 'name' => 'paper'],
        ]);
    }
}
