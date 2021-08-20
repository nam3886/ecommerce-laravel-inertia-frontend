<?php

namespace App\Http\Controllers\Api;

use App\Contracts\CartContract;
use App\Http\Controllers\BaseController;
use App\Models\UserAddress;
use App\Services\GHN\GHNService;
use App\Traits\SessionShippingFee;
use Illuminate\Http\Request;

class ShippingController extends BaseController
{
    use SessionShippingFee;

    private $cartRepository;

    public function __construct(CartContract $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calculateShippingFee()
    {
        $address = auth()->user()->address;

        if (empty($address)) {
            return $this->responseRedirectBack('User\'s address not created yet.', 'error');
        }

        $groupByShop = $this->cartRepository->listCartsGroupByShop()->get('items');

        try {
            $shippingFee = $groupByShop->reduce(function ($total, $group) use ($address) {
                return $total + match ($address->delivery_method_id) {
                    1 => $this->GHNShippingFee($group, $address),
                };
            }, 0);

            $this->setTotalShippingFee($shippingFee);
            // dd(1);
        } catch (\Throwable $th) {
            return $this->responseJson(message: $th->getMessage(), responseCode: $th->getCode());
        }

        return $this->responseRedirectBack(trans('response.shipping.success.get_fee'), 'success');
    }

    /**
     * @param int $methodId
     * @param int $shopId
     * @return bool
     */
    private function needCalculateShippingFee(int $shopId)
    {
        return !$this->hasShippingFeeByShopId($shopId) || $this->checkAddressHasBeenChanged();
    }

    /**
     * calculate fee and save it to session
     * @param array $group
     * @param \App\Models\UserAddress $address
     * @return int
     */
    private function GHNShippingFee(array $group, UserAddress $address)
    {
        $shop               =   $group['shop'];

        if ($this->needCalculateShippingFee($shop->id)) {

            $weight         =   $group['items']->reduce(fn ($total, $item) => $total + $item->get('weight'));
            $shippingFee    =   (new GHNService($shop->ghn_shop_id))->calculateShippingFee([
                // 1: Express , 2: Standard or 3: Saving
                "service_type_id"   =>  2,
                "from_district_id"  =>  intval($shop->ghn_address->district_id),
                "to_district_id"    =>  intval($address->ghn_address->district_id),
                "to_ward_code"      =>  $address->ghn_address->ward_code,
                "weight"            =>  $weight,
            ])->get('service_fee');

            $this->setShippingFeeByShopId($shop->id, $shippingFee);
            $this->addressChangeConfirmed();
        }

        return $this->getShippingFeeByShopId($shop->id);
    }
}
