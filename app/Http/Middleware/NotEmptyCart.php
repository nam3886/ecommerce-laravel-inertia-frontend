<?php

namespace App\Http\Middleware;

use App\Contracts\CartContract;
use Closure;
use Illuminate\Http\Request;

class NotEmptyCart
{
    private $cartRepository;

    public function __construct(CartContract $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->cartRepository->listCarts()->get('count')) {
            return $next($request);
        }

        return redirect()->route('empty_cart');
    }
}
