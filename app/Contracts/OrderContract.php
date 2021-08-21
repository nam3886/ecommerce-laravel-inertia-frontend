<?php

namespace App\Contracts;

/**
 * Interface OrderContract
 * @package App\Contracts
 */
interface OrderContract
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function listOrders();

    /**
     * @param int $id
     * @return \App\Models\Order
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrderById(int $id);

    /**
     * @param array $params
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createOrder(array $params);

    /**
     * @param array $params
     * @param int $id
     * @return mixed
     */
    public function updateOrder(array $params, int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteOrder(int $id);
}
