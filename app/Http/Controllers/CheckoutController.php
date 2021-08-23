<?php

namespace App\Http\Controllers;

use App\Contracts\CartContract;
use App\Contracts\OrderContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CheckoutRequest;
use App\Http\Resources\DeliveryMethodResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PaymentMethodResource;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
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
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = cache()->get("order.{$id}", null);

        abort_if(empty($order), 404);

        return Inertia::render('Order')
            ->with('checkout_success', session('checkout_success'))
            ->with('order', new OrderResource($order));
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

        return Inertia::render('Checkout')
            ->with('stripePublishableKey', config('third_party.stripe_client_id'))
            ->with('paymentMethods', PaymentMethodResource::collection($paymentMethods))
            ->with('deliveryMethods', DeliveryMethodResource::collection($deliveryMethods))
            ->with('cartGroupByShop', $cartGroupByShop);
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

        try {
            $result = $this->orderRepository->createOrder($params->all());
        } catch (\Throwable $th) {
            return $this->responseRedirectBack($th->getMessage(), 'error');
        }

        return redirect()->route('checkout.show', $result->id)->with('checkout_success', true);
    }
}
