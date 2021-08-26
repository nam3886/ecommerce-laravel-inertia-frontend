<?php

namespace App\Repositories;

use App\Contracts\OrderContract;
use App\Models\Order;
use App\Services\Checkout\CashCheckoutService;
use App\Services\Checkout\PayPalCheckoutService;
use App\Services\Checkout\StripeCheckoutService;
use App\Services\Checkout\VNPayCheckoutService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createOrder(array $params)
    {
        $service = match ($params['payment_method_id']) {
            1 => StripeCheckoutService::class,
            2 => PayPalCheckoutService::class,
            3 => VNPayCheckoutService::class,
            4 => CashCheckoutService::class,
        };

        return (new $service($params))->execute();
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
