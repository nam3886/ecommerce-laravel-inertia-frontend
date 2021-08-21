<?php

namespace App\Repositories;

use App\Contracts\OrderContract;
use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

/**
 * Class OrderRepository
 *
 * @package \App\Repositories
 */
class OrderRepository extends BaseRepository implements OrderContract
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function listOrders()
    {
    }

    /**
     * @param int $id
     * @return \App\Models\Order
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrderById(int $id)
    {
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createOrder(array $params)
    {
        // stripe has id 1
    }

    /**
     * @param array $params
     * @param int $id
     * @return mixed
     */
    public function updateOrder(array $params, int $id)
    {
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteOrder(int $id)
    {
    }
}
