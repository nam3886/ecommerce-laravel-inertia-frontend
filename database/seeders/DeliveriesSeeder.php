<?php

namespace Database\Seeders;

use App\Models\DeliveryMethod;
use Illuminate\Database\Seeder;

class DeliveriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeliveryMethod::create([
            'code' => 'delivery_ghn',
            'name' => 'giao hàng nhanh',
            'description' => 'giao hàng nhanh',
            'updated_by' => 1,
        ]);
    }
}
