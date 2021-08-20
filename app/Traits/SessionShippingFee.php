<?php

namespace App\Traits;

/**
 * Trait SessionShippingFee
 * @package App\Traits
 */
trait SessionShippingFee
{
    /*
    |--------------------------------------------------------------------------
    | TOTAL SHIPPING FEE METHODS
    |--------------------------------------------------------------------------
    */

    /**
     * @return int
     */
    public function getTotalShippingFee()
    {
        return session('shipping_fee', 0);
    }

    /**
     * @return int
     */
    public function setTotalShippingFee(int $value)
    {
        return session(['shipping_fee' => $value]);
    }

    /**
     * @return void
     */
    public function clearTotalShippingFee()
    {
        session()->forget('shipping_fee');
    }

    /*
    |--------------------------------------------------------------------------
    | SHIPPING FEE METHODS
    |--------------------------------------------------------------------------
    */

    /**
     * @param int $shopId
     * @return bool
     */
    public function hasShippingFeeByShopId(int $shopId)
    {
        return session()->has("shipping_fee_{$shopId}");
    }

    /**
     * @param int $shopId
     * @return int
     */
    public function getShippingFeeByShopId(int $shopId)
    {
        return session("shipping_fee_{$shopId}", 0);
    }

    /**
     * @param int $shopId
     * @return int
     */
    public function setShippingFeeByShopId(int $shopId, int $value)
    {
        return session(["shipping_fee_{$shopId}" => $value]);
    }

    /**
     * @param int $shopId
     * @return void
     */
    public function clearShippingFeeByShopId(int $shopId)
    {
        session()->forget("shipping_fee_{$shopId}");
    }

    /*
    |--------------------------------------------------------------------------
    | USER ADDRESS METHODS
    |--------------------------------------------------------------------------
    */
    /**
     * @return bool
     */
    public function checkAddressHasBeenChanged()
    {
        return session('address_changed', false);
    }

    /**
     * @return bool
     */
    public function addressChangeHandling()
    {
        $this->clearTotalShippingFee();

        return session(['address_changed' => true]);
    }

    /**
     * @return void
     */
    public function addressChangeConfirmed()
    {
        session()->forget('address_changed');
    }
}
