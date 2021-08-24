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
        // load categories ???
        $product = Product::with('discount', 'gallery', 'brand')->active()->inStock()->withCount('variants');

        $featuredProduct = $product->whereIsFeatured(1)
            ->take(config('settings.get_featured_products', 5))
            ->get();

        $bestSellProduct = $product->whereFlag('deal')
            ->take(config('settings.get_best_sell_products', 4))
            ->get();

        return Inertia::render('Home')
            ->with('featuredProduct', ProductResource::collection($featuredProduct))
            ->with('bestSellProduct', ProductResource::collection($bestSellProduct));
    }

    public function wishlist()
    {
        return Inertia::render('Wishlist');
    }

    public function order()
    {
        return Inertia::render('Order');
    }
}
