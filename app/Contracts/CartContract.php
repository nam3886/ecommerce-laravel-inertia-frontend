<?php

namespace App\Contracts;

/**
 * Interface CartContract
 * @package App\Contracts
 */
interface CartContract
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function listCarts();

    /**
     * @param string $id
     * @return mixed
     */
    public function findCartByRowId(string $id);

    /**
     * @param string $id
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function findCartByRowIdOrFail(string $id);

    /**
     * @param string $sku
     * @return mixed
     */
    public function findCartBySku(string $sku);

    /**
     * @param int $id
     * @return \App\Models\Product
     */
    public function findProductById(int $id);

    /**
     * @param array $params
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createCart(array $params);

    /**
     * @param int|array $params
     * @param string $id
     * @return mixed
     */
    public function updateCart(int|array $params, string $id);

    /**
     * @param string $id
     * @return mixed
     */
    public function deleteCart(string $id);

    /**
     * @return void
     */
    public function destroyCart();

    /**
     * @param int $param
     * @return mixed
     */
    public function setGlobalDiscount(int $param);

    /**
     * @param int $param
     * @param string $id
     * @return mixed
     */
    public function setCartDiscount(int $param, string $id);
}
