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
            'description' => 'Pay via Stripe; you can pay with your credit card if you don’t have a Stripe account.',
        ]);

        PaymentMethod::create([
            'updated_by' => 1,
            'name' => 'Ví điện tử Paypal',
            'code' => 'paypal',
            'description' => 'Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.',
        ]);

        PaymentMethod::create([
            'updated_by' => 1,
            'name' => 'Thẻ ngân hàng',
            'code' => 'vnpay',
            'description' => 'Pay via vnpay; you can pay with your credit card if you don’t have a vnpay account.',
        ]);
    }
}
