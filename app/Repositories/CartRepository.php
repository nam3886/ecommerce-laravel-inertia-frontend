<?php

namespace App\Repositories;

use App\Contracts\CartContract;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

/**
 * Class CartRepository
 *
 * @package \App\Repositories
 */
class CartRepository extends BaseRepository implements CartContract
{
    private $cart;

    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
        $this->cart = Cart::instance('cart');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function listCarts()
    {
        $items = $this->cart->content()->map(function ($item) {
            $subtotal = $item->price * $item->qty;

            $options = collect($item->options)
                ->put('subtotal', $subtotal)
                ->put('subtotal_format', easy_format_price($subtotal));

            return collect($item)->put('options', $options);
        });

        return collect([
            'items'                 =>  $items,
            'count'                 =>  $this->cart->count(),

            'tax'                   =>  $this->cart->taxFloat(),
            'total_price'           =>  $this->cart->priceTotalFloat(),
            'discount'              =>  $this->cart->discountFloat(),
            'subtotal'              =>  $this->cart->subtotalFloat(),
            'grandtotal'           =>  $this->cart->totalFloat(),

            'tax_format'            =>  easy_format_price($this->cart->taxFloat()),
            'total_price_format'    =>  easy_format_price($this->cart->priceTotalFloat()),
            'discount_format'       =>  easy_format_price($this->cart->discountFloat()),
            'subtotal_format'       =>  easy_format_price($this->cart->subtotalFloat()),
            'grandtotal_format'    =>  easy_format_price($this->cart->totalFloat()),
        ]);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function findCartByRowId(string $id)
    {
        return $this->cart->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        })->first();
    }

    /**
     * @param string $id
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function findCartByRowIdOrFail(string $id)
    {
        $cart = $this->findCartByRowId($id);

        throw_if(empty($cart), ValidationException::withMessages([
            'rowId' => 'The selected rowId is invalid.',
        ]));

        return $cart;
    }

    /**
     * @param string $sku
     * @return mixed
     */
    public function findCartBySku(string $sku)
    {
        return $this->cart->search(function ($cartItem, $rowId) use ($sku) {
            return $cartItem->options->sku === $sku;
        })->first();
    }

    /**
     * @param int $id
     * @return \App\Models\Product
     */
    public function findProductById(int $id)
    {
        return $this->findOneOrFail($id);
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createCart(array $params)
    {
        $params = collect($params);

        $params = $this->prepareParams($params);

        $this->quantityCheck(
            $params->get('qty'),
            $params->get('options')['max'],
            $params->get('options')['sku']
        );

        $cart = $this->cart->add($params->all())->associate($this->model);

        return collect($cart);
    }

    /**
     * @param int|array $params
     * @param string $id
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateCart(int|array $params, string $id)
    {
        $cart = $this->findCartByRowIdOrFail($id);

        $params = collect($params);

        $max = $cart->model->hasVariants()
            ? $cart->model->variants()->whereSku($cart->options->sku)->first()->quantity
            : $cart->model->quantity;

        throw_if($params->get('qty') > $max, ValidationException::withMessages([
            'qty' => "The qty must not be greater than {$max}.",
        ]));

        $cart = $this->cart->update($id, collect($params)->except('rowId', 'id', 'sku')->all());

        return collect($cart);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function deleteCart(string $id)
    {
        $this->findCartByRowIdOrFail($id);

        return collect($this->cart->remove($id));
    }

    /**
     * @return void
     */
    public function destroyCart()
    {
        $this->cart->destroy();
    }

    /**
     * @param int $param
     * @return mixed
     */
    public function setGlobalDiscount(int $param)
    {
        return collect($this->cart->setGlobalDiscount($param));
    }

    /**
     * @param int $param
     * @param string $id
     * @return mixed
     */
    public function setCartDiscount(int $param, string $id)
    {
        $this->findCartByRowIdOrFail($id);

        return collect($this->cart->setDiscount($id, 21));
    }

    /**
     * prepare before create
     * @param \Illuminate\Support\Collection $params
     * @return \Illuminate\Support\Collection
     * @throws \Illuminate\Validation\ValidationException
     */
    private function prepareParams(Collection $params)
    {
        $product = $this->findProductById($params->get('id'));

        $max = $product->quantity;

        $options = collect([
            'id'                    => $product->id,
            'name'                  => $product->name,
            'weight'                => $product->weight,
            'price'                 => $product->price_after_discount,
            'qty'                   => $params->get('qty'),
            'options'               => [
                'sku'               => $product->sku,
                'slug'              => $product->slug,
                'max'               => $max,
                'avatar'            => $product->gallery->avatar,
                'price_format'      => easy_format_price($product->price_after_discount),
            ],
        ]);

        if ($product->hasVariants()) {

            throw_if(!$params->has('sku'), ValidationException::withMessages([
                'sku' => 'The sku field is required.',
            ]));

            $variant = $product->variants()->whereSku($params->get('sku'))->first();

            $max = $variant->quantity;

            $newOptions = array_merge($options->get('options'), [
                'sku'           => $variant->sku,
                'max'           => $max,
                'variant_name'  => $variant->name,
                'price_format'  => easy_format_price($variant->price_after_discount),
            ]);

            $options->put('options', $newOptions)
                ->put('weight', $variant->weight)
                ->put('price', $variant->price_after_discount);
        }

        return $options;
    }

    /**
     * check quantity before create
     * @param int $quantity
     * @param int $max
     * @param string $sku
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    private function quantityCheck(int $quantity, int $max, string $sku)
    {
        $existed = $this->findCartBySku($sku);

        $max = empty($existed) ? $max : $max - $existed->qty;

        throw_if($quantity > $max, ValidationException::withMessages([
            'qty' => "The qty must not be greater than {$max}.",
        ]));
    }

    /**
     * when cart changed call api get shipping fee
     * @return void
     */
    public function cartChanged()
    {
        # code...
    }
}
