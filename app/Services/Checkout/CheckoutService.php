<?php

namespace App\Services\Checkout;

use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use App\Models\SubOrder;
use App\Models\Voucher;
use Illuminate\Support\Collection;

abstract class CheckoutService
{
    // by default it is stripe token
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
        $order->transaction_number  =   $this->params->get('stripe_token');
        $order->updated_by          =   auth()->id();
        $order->save();

        // Store SubOrder
        $this->params->get('items')->each(function ($item) use ($order) {
            $item                           =   collect($item);
            $subOrder                       =   new SubOrder($item->all());
            $carts                          =   $item->get('items');
            // $subOrder->cod_amount          =   $carts->count();
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
                ];
                return $carry;
            }, []);

            $subOrder->items()->sync($items);

            // todo is_paid, order_create_success, cod_amount, note, status
        });

        $this->order = $order;
    }

    public function createShipping(): Collection
    {
        $GHNOrderService = new GHNOrderService();

        return $GHNOrderService
            ->from(1463, 21804)
            ->to($this->order->api_address->ghn->district, $this->order->api_address->ghn->ward)
            ->setDeliveryInfo($this->order->name, $this->order->phone, $this->order->address)
            ->setServiceId($this->order->delivery_service_id)
            ->setPackage(10, 10, 10, 200)
            ->setOrder($this->order)
            ->createOrder();
    }

    public abstract function execute();

    public abstract function success();

    public abstract function failed($exception);
}
