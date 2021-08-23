<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'updated_by' => 1,
            'name' => 'Ví điện tử Stripe',
            'code' => 'stripe',
            'description' => 'Ví điện tử Stripe.',
        ]);

        PaymentMethod::create([
            'updated_by' => 1,
            'name' => 'Ví điện tử Paypal',
            'code' => 'paypal',
            'description' => 'Ví điện tử Paypal.',
        ]);

        PaymentMethod::create([
            'updated_by' => 1,
            'name' => 'Thẻ ngân hàng',
            'code' => 'vnpay',
            'description' => 'Thẻ ngân hàng.',
        ]);

        PaymentMethod::create([
            'updated_by' => 1,
            'name' => 'Thanh toán khi nhận hàng',
            'code' => 'cod',
            'description' => 'Thanh toán khi nhận hàng.',
        ]);
    }
}
