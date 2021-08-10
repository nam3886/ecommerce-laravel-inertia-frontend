<?php

namespace App\Http\Middleware;

use App\Contracts\CartContract;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? [
                        'id' => $request->user()->id,
                        'name' => $request->user()->name,
                    ] : null,
                ];
            },

            'flash' => function () use ($request) {
                return [
                    'error' => $request->session()->get('error', []),
                    'info' => $request->session()->get('info', []),
                    'success' => $request->session()->get('success', []),
                    'warning' => $request->session()->get('warning', []),
                ];
            },

            'cart' => function (CartContract $cartRepository) {
                return $cartRepository->listCarts();
            },
        ]);
    }
}