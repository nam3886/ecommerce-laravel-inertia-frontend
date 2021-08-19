<?php

namespace App\Http\Controllers;

use App\Contracts\CartContract;
use App\Models\DeliveryMethod;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    /**
     * @var \App\Contracts\CartContract
     */
    protected $cartRepository;

    public function __construct(CartContract $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveryMethods = DeliveryMethod::select('id', 'code', 'name', 'price', 'description')
            ->whereActive(1)
            ->get();

        $paymentMethods = PaymentMethod::select('id', 'code', 'name', 'price', 'description')
            ->whereActive(1)
            ->get();

        $cartGroupByShop = $this->cartRepository->listCartsGroupByShop();

        return Inertia::render('Checkout', compact('deliveryMethods', 'paymentMethods', 'cartGroupByShop'));
    }
}
