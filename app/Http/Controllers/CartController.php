<?php

namespace App\Http\Controllers;

use App\Contracts\CartContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CartRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends BaseController
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
        return Inertia::render('Cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRequest $request)
    {
        $params = $request->validated();

        $result = $this->cartRepository->createCart($params);

        if (!$result) {
            return $this->responseRedirectBack(trans('response.cart.error.store'), 'error');
        }
        return $this->responseRedirectBack(trans('response.cart.success.store'), 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CartRequest  $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function update(CartRequest $request, $id)
    {
        $params = $request->validated();

        $result = $this->cartRepository->updateCart($params, $id);

        if (!$result) {
            return $this->responseRedirectBack(trans('response.cart.error.update'), 'error');
        }
        return $this->responseRedirectBack(trans('response.cart.success.update'), 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->cartRepository->deleteCart($id);

        if (!$result) {
            return $this->responseRedirectBack(trans('response.cart.error.destroy'), 'error');
        }
        return $this->responseRedirectBack(trans('response.cart.success.destroy'), 'success');
    }
}
