<?php

namespace Database\Seeders;

use App\Models\Payment;
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
        Payment::create([
            'updated_by' => 1,
            'name' => 'stripe',
            'code' => 'stripe',
            'description' => 'Pay via Stripe; you can pay with your credit card if you don’t have a Stripe account.',
        ]);

        Payment::create([
            'updated_by' => 1,
            'name' => 'paypal',
            'code' => 'paypal',
            'description' => 'Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.',
        ]);

        Payment::create([
            'updated_by' => 1,
            'name' => 'vnpay',
            'code' => 'vnpay',
            'description' => 'Pay via vnpay; you can pay with your credit card if you don’t have a vnpay account.',
        ]);
    }
}
