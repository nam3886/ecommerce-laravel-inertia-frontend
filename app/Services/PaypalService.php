<?php

namespace App\Services;

use App\Models\Order;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use Illuminate\Support\Str;

class PaypalService
{
    private $client, $currencyCode;

    public function __construct()
    {
        $this->currencyCode =   'USD';

        $environment        =   new SandboxEnvironment(
            config('third_party.paypal_client_id'),
            config('third_party.paypal_secret_id')
        );

        $this->client       =   new PayPalHttpClient($environment);
    }

    public function createOrder($orderId)
    {
        $request                    =   new OrdersCreateRequest;
        $request->headers["prefer"] =   "return=representation";
        $request->body              =   $this->checkoutData($orderId);
        // dd($request->body);
        return $this->client->execute($request);
    }

    public function captureOrder($paypalOrderId)
    {
        $request = new OrdersCaptureRequest($paypalOrderId);

        return $this->client->execute($request);
    }

    private function checkoutData(int $orderId): array
    {
        $order                  =   Order::findOrFail($orderId);
        $items                  =   $this->paypalOrderDetails($order);
        $shippingInformation    =   $this->paypalShippingInformation($order);
        $purchaseAmount         =   $this->paypalPurchaseAmount($order);

        $checkoutData                  =   [
            'intent'                   =>  'CAPTURE',
            'application_context'      =>  [
                'return_url'           =>  route('checkout.paypal.success', $order->order_code),
                'cancel_url'           =>  route('checkout.paypal.cancel', $order->order_code),
                'brand_name'           =>  config('app.name'),
                'locale'               =>  'en-US',
                'landing_page'         =>  'BILLING',
                'shipping_preference'  =>  'SET_PROVIDED_ADDRESS',
                'user_action'          =>  'PAY_NOW',
            ],
            'purchase_units'           =>  [
                [
                    'reference_id'     =>  strtoupper(get_uniqid_code(config('app.name') . '_')),
                    'description'      =>  Str::title(config('app.name') . ' order'),
                    'custom_id'        =>  config('settings.site_name'),
                    'soft_descriptor'  =>  config('settings.site_title'),
                    'items'            =>  $items,
                    'shipping'         =>  $shippingInformation,
                    'amount'           =>  $purchaseAmount,

                ]
            ],
        ];

        return $checkoutData;
    }

    private function paypalOrderDetails(Order $order): array
    {
        return $order->items->map(function ($item) {
            return [
                'name'              =>  $item->name,
                'quantity'          =>  $item->pivot->quantity,
                'unit_amount'       =>  [
                    'currency_code' =>  $this->currencyCode,
                    'value'         =>  $item->pivot->price
                ],
                'tax'               =>  [
                    'currency_code' =>  $this->currencyCode,
                    'value'         =>  0,
                ],
            ];
        })->toArray();
    }

    private function paypalShippingInformation(Order $order): array
    {
        return [
            'method'                =>  $order->billingAddress->deliveryMethod->name,
            'name'                  =>  ['full_name' => $order->billingAddress->name],
            'phone'                 =>  $order->billingAddress->phone,
            'address'               =>  [
                'address_line_1'    =>  $order->billingAddress->address,
                'admin_area_2'      =>  $order->billingAddress->ghn_address->district_id,
                'admin_area_1'      =>  $order->billingAddress->ghn_address->ward_code,
                'postal_code'       =>  '100000',
                'country_code'      =>  'VN',
            ],
        ];
    }

    private function paypalPurchaseAmount(Order $order): array
    {
        return [
            'currency_code'         =>  $this->currencyCode,
            'value'                 =>  $order->grandtotal,
            'breakdown'             =>  [
                'item_total'        =>  [
                    'currency_code' =>  $this->currencyCode,
                    'value'         =>  $order->subtotal,
                ],
                'shipping'          =>  [
                    'currency_code' =>  $this->currencyCode,
                    'value'         =>  $order->shipping_fee,
                ],
                'handling'          =>  [
                    'currency_code' =>  $this->currencyCode,
                    'value'         =>  0,
                ],
                'tax_total'         =>  [
                    'currency_code' =>  $this->currencyCode,
                    'value'         =>  $order->tax,
                ],
                'insurance'         =>  [
                    'currency_code' =>  $this->currencyCode,
                    'value'         =>  0,
                ],
                'shipping_discount' =>  [
                    'currency_code' =>  $this->currencyCode,
                    'value'         =>  0,
                ],
                'discount'          =>  [
                    'currency_code' =>  $this->currencyCode,
                    'value'         =>  $order->discount,
                ],
            ],
        ];
    }
}
