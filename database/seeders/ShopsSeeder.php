<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::create([
            'user_id' => 2,
            'ghn_shop_id' => 80614,
            'slug' => create_slug('Master Shoes'),
            'phone' => '0973366072',
            'name' => 'Master Shoes',
            'address' => '75b đường số 2, Phường Hiệp Bình Phước, Quận Thủ Đức - Hồ Chí Minh',
            'ghn_address' => [
                'DistrictID' => 1463,
                'WardCode' => 21804
            ],
        ]);
    }
}