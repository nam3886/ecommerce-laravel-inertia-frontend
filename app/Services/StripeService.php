<?php

namespace App\Services;

use App\Helpers\Currency;
use App\Models\Order;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Str;

class StripeService
{
    private $stripe, $currencyCode;

    public function __construct()
    {
        $this->currencyCode =   Currency::getDefaultCurrency();
        $this->stripe       =   Stripe::make(config('third_party.stripe_secret_id'));
    }

    public function createOrder(Order $order)
    {
        $items = $order->items->map(function ($item) {
            $meta = "{$item->name}";
            $item->hasVariants() && $meta .= " ({$item->pivot->variant->name})";
            $meta .= " x {$item->pivot->quantity} : " . easy_format_price($item->pivot->price);
            return $meta;
        });

        $this->stripe->charges()->create([
            'currency'      =>  $this->currencyCode,
            'amount'        =>  $order->grandtotal,
            'source'        =>  $order->transaction->transaction_number,
            'description'   =>  Str::title(config('app.name') . ' order'),
            'receipt_email' =>  auth()->user()->email,
            'metadata'      =>  [
                ...$items,
            ],
        ]);
    }
}
