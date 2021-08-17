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
                'district_id' => 1463,
                'ward_code' => 21804,
                'address' => '75b đường số 2',
            ],
        ]);

        Shop::create([
            'user_id' => 3,
            'ghn_shop_id' => 82101,
            'slug' => create_slug('Adidas Shoes'),
            'phone' => '0909594470',
            'name' => 'Adidas Shoes',
            'address' => '75 b đường 23, Phường Xuân Phương, Quận Nam Từ Liêm - Hà Nội',
            'ghn_address' => [
                'district_id' => 3440,
                'ward_code' => 13010,
                'address' => '75 b đường 23',
            ],
        ]);
    }
}
