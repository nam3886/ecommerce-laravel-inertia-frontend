<?php

namespace App\Http\Controllers;

use App\Contracts\CartContract;
use App\Contracts\OrderContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CheckoutRequest;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends BaseController
{
    /**
     * @var \App\Contracts\CartContract
     * @var \App\Contracts\OrderContract
     */
    protected $cartRepository;
    protected $orderRepository;

    public function __construct(CartContract $cartRepository, OrderContract $orderRepository)
    {
        $this->cartRepository   =   $cartRepository;
        $this->orderRepository  =   $orderRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selects            =   ['id', 'code', 'name', 'price', 'description'];
        $deliveryMethods    =   DeliveryMethod::select($selects)->whereActive(1)->get();
        $paymentMethods     =   PaymentMethod::select($selects)->whereActive(1)->get();
        $cartGroupByShop    =   $this->cartRepository->listCartsGroupByShop();

        return Inertia::render('Checkout', compact('deliveryMethods', 'paymentMethods', 'cartGroupByShop'))
            ->with('stripePublishableKey', config('third_party.stripe_client_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CheckoutRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        $params = $this->cartRepository->listCartsGroupByShop()->merge($request->validated());

        $result = $this->orderRepository->createOrder($params->all());

        if (!$result) {
            return $this->responseRedirectBack(trans('response.order.error.store'), 'error');
        }
        return $this->responseRedirectBack(trans('response.order.success.store'), 'success');
    }
}
