<?php

namespace App\Repositories;

use App\Contracts\CartContract;
use App\Events\CartChanged;
use App\Http\Resources\ShopResource;
use App\Models\Product;
use App\Models\Shop;
use App\Traits\SessionShippingFee;
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
    use SessionShippingFee;

    private $cart;

    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model        =   $model;
        $this->cart         =   Cart::instance('cart');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function listCarts()
    {
        $shippingFee    =   $this->getTotalShippingFee();
        $grandtotal     =   $shippingFee + $this->cart->totalFloat();

        return collect([
            'items'                 =>  $this->cart->content(),
            'count'                 =>  $this->cart->count(),

            'tax'                   =>  $this->cart->taxFloat(),
            'subtotal'              =>  $this->cart->subtotalFloat(),
            'discount'              =>  $this->cart->discountFloat(),
            'total'                 =>  $this->cart->totalFloat(),
            'shipping_fee'          =>  $shippingFee,
            'grandtotal'            =>  $grandtotal,

            'tax_format'            =>  easy_format_price($this->cart->taxFloat()),
            'subtotal_format'       =>  easy_format_price($this->cart->subtotalFloat()),
            'discount_format'       =>  easy_format_price($this->cart->discountFloat()),
            'total_format'          =>  easy_format_price($this->cart->totalFloat()),
            'shipping_fee_format'   =>  easy_format_price($shippingFee),
            'grandtotal_format'     =>  easy_format_price($grandtotal),
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function listCartsGroupByShop()
    {
        $listCarts          =   $this->listCarts();
        $itemsGroupByShop   =   $listCarts->get('items')->groupBy('options.shop_id');
        $shops              =   Shop::findMany($itemsGroupByShop->keys());
        // calculate subtotal for each item and, shop information and calculate shipping fee
        $itemsGroupByShop   =   $itemsGroupByShop->reduce(function ($carry, $items) use ($shops) {

            $shop           =   $shops->where('id', $items->first()->options->shop_id)->first();
            $temp           =   $this->calculateSubtotalAndTotal($items);
            $items          =   $temp->get('items');
            $subtotal       =   $temp->get('subtotal');
            $discount       =   $temp->get('discount');
            $tax            =   $temp->get('tax');
            $total          =   $subtotal + $discount + $tax;
            $shippingFee    =   $this->getShippingFeeByShopId($shop->id);
            $grandtotal     =   $total + $shippingFee;

            return $carry->push([
                'shop'                  =>  new ShopResource($shop),
                'items'                 =>  $items,

                'subtotal'              =>  $subtotal,
                'discount'              =>  $discount,
                'tax'                   =>  $tax,
                'total'                 =>  $total,
                'shipping_fee'          =>  $shippingFee,
                'grandtotal'            =>  $grandtotal,

                'subtotal_format'       =>  easy_format_price($subtotal),
                'discount_format'       =>  easy_format_price($discount),
                'tax_format'            =>  easy_format_price($tax),
                'total_format'          =>  easy_format_price($total),
                'shipping_fee_format'   =>  easy_format_price($shippingFee),
                'grandtotal_format'     =>  easy_format_price($grandtotal)
            ]);
        }, collect());

        return $listCarts->put('items', $itemsGroupByShop);
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
        $params =   collect($params);
        $params =   $this->prepareParams($params);
        $cart   =   $this->cart->add($params->all())->associate($this->model);

        CartChanged::dispatch($cart->options->shop_id);

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
        $cart   =   $this->findCartByRowIdOrFail($id);
        $params =   collect($params);
        $max    =   $cart->model->hasVariants()
            ? $cart->model->variants()->whereSku($cart->options->sku)->first()->quantity
            : $cart->model->quantity;

        throw_if($params->get('qty') > $max, ValidationException::withMessages([
            'qty' => "The qty must not be greater than {$max}.",
        ]));

        $cart   =   $this->cart->update($id, collect($params)->except('rowId', 'id', 'sku')->all());

        CartChanged::dispatch($cart->options->shop_id);

        return collect($cart);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function deleteCart(string $id)
    {
        $cart = $this->findCartByRowIdOrFail($id);

        CartChanged::dispatch($cart->options->shop_id);

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
        $product    =   $this->findProductById($params->get('id'));
        $max        =   $product->quantity;
        $options    =   collect([
            'id'                    =>  $product->id,
            'name'                  =>  $product->name,
            'weight'                =>  $product->weight,
            'price'                 =>  $product->price_after_discount,
            'qty'                   =>  $params->get('qty'),
            'options'               =>  [
                'shop_id'           =>  $product->shop_id,
                'sku'               =>  $product->sku,
                'slug'              =>  $product->slug,
                'max'               =>  $max,
                'avatar'            =>  $product->gallery->avatar,
                'price_format'      =>  easy_format_price($product->price_after_discount),
                'discount_id'       =>  $product->discount?->id,
            ],
        ]);

        if ($product->hasVariants()) {

            throw_if(!$params->has('sku'), ValidationException::withMessages([
                'sku' => 'The sku field is required.',
            ]));

            $variant    =   $product->variants()->whereSku($params->get('sku'))->first();
            $max        =   $variant->quantity;
            $newOptions =   array_merge($options->get('options'), [
                'sku'           =>  $variant->sku,
                'max'           =>  $max,
                'variant_name'  =>  $variant->name,
                'price_format'  =>  easy_format_price($variant->price_after_discount),
                'discount_id'   =>  $variant->discount?->id,
            ]);

            $options->put('options', $newOptions)
                ->put('weight', $variant->weight)
                ->put('price', $variant->price_after_discount);
        }

        $this->quantityCheckBeforeStoreCart($options);

        return $options;
    }

    /**
     * check quantity before create
     * @param \Illuminate\Support\Collection $params
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    private function quantityCheckBeforeStoreCart(Collection $params)
    {
        $max        =   $params->get('options')['max'];
        $existed    =   $this->findCartBySku($params->get('options')['sku']);
        $max        =   empty($existed) ? $max : $max - $existed->qty;

        throw_if($params->get('qty') > $max, ValidationException::withMessages([
            'qty' => "The qty must not be greater than {$max}.",
        ]));
    }

    /**
     * @param \Illuminate\Support\Collection $items
     * @return \Illuminate\Support\Collection
     */
    private function calculateSubtotalAndTotal(Collection $items)
    {
        $tax = $discount = 0;

        $items = $items->map(function ($item) use (&$tax, &$discount) {

            $tax        +=  $item->taxTotal;
            $discount   +=  $item->discountTotal;
            $options    =   collect($item->options)->put('subtotal_format', easy_format_price($item->subtotal));

            return collect($item)->put('options', $options);
        });

        return collect([
            'items'     =>  $items,
            'subtotal'  =>  $items->sum('subtotal'),
            'discount'  =>  $discount,
            'tax'       =>  $tax,
        ]);
    }
}
