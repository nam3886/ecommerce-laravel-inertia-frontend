<?php

namespace App\Services\Checkout;

use App\Models\BillingAddress;
use App\Models\Order;
use App\Models\SubOrder;
use App\Models\Transaction;
use App\Models\Voucher;
use Illuminate\Support\Collection;

abstract class CheckoutService
{
    /**
     * @var \Illuminate\Support\Collection
     * @var \App\Models\Order
     */
    protected Collection $params;
    protected Order $order;

    /**
     * @param array $params
     * @return void
     */
    public function __construct(array $params)
    {
        $this->params = collect($params);
    }

    /**
     * @return void
     */
    public function createOrder(): void
    {
        // store Order
        $order                      =   new Order($this->params->all());
        $order->order_code          =   get_uniqid_code('VN');
        $order->user_id             =   auth()->id();
        $order->items_count         =   $this->params->get('count');
        $order->updated_by          =   auth()->id();
        $order->save();

        // Store Transaction
        $transaction                =   new Transaction();
        $transaction->updated_by    =   auth()->id();
        $transaction->transaction_number = $this->params->get('stripe_token');
        $order->transaction()->save($transaction);

        // store BillingAddress
        $billingAddress             =   new BillingAddress(auth()->user()->address->toArray());
        $billingAddress->name       =   auth()->user()->name;
        $billingAddress->phone      =   auth()->user()->phone;
        $billingAddress->updated_by =   auth()->id();
        $order->billingAddress()->save($billingAddress);

        // Store SubOrder
        $this->params->get('items')->each(function ($item) use ($order) {
            $item                           =   collect($item);
            $subOrder                       =   new SubOrder($item->all());
            $carts                          =   $item->get('items');
            $subOrder->items_count          =   $carts->count();
            $subOrder->shop_id              =   $item->get('shop')->id;
            $subOrder->delivery_method_id   =   $this->params->get('delivery_method_id');
            $subOrder->updated_by           =   auth()->id();
            $subOrder                       =   $order->subOrders()->save($subOrder);

            // Store OrderDetail
            $items = $carts->reduce(function ($carry, $cart) use ($order) {
                $carry[$cart->get('id')] = [
                    'order_id'      =>  $order->id,
                    'discount_id'   =>  $cart->get('options')['discount_id'],
                    'sku'           =>  $cart->get('options')['sku'],
                    'quantity'      =>  $cart->get('qty'),
                    'price'         =>  $cart->get('price'),
                    'updated_by'    =>  auth()->id(),
                ];
                return $carry;
            }, []);

            $subOrder->items()->sync($items);

            // todo note, status, cod_amount
        });

        $this->order = $order;
    }

    public abstract function execute();

    public abstract function success();

    public abstract function failed($exception);
}
