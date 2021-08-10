<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Inertia\Inertia;

class HomeController extends BaseController
{
    public function index()
    {
        $product = Product::with('categories', 'discount', 'gallery', 'brand')->withCount('variants');
        $featuredProduct = $product->whereIsFeatured(1)->take(5)->get();
        $bestSellProduct = $product->whereFlag('deal')->take(5)->get();

        return Inertia::render('Home')
            ->with('featuredProduct', ProductResource::collection($featuredProduct))
            ->with('bestSellProduct', ProductResource::collection($bestSellProduct));
    }

    public function login()
    {
        return Inertia::render('Login');
    }

    public function wishlist()
    {
        return Inertia::render('Wishlist');
    }

    public function checkout()
    {
        return Inertia::render('Checkout');
    }

    public function order()
    {
        return Inertia::render('Order');
    }
}
