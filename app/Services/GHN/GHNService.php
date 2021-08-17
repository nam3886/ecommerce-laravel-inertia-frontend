<?php

namespace App\Services\GHN;

use Illuminate\Support\Facades\Http;

class GHNService
{
    private $token;
    private $shopId;
    private string $url = 'https://dev-online-gateway.ghn.vn/shiip/public-api';

    public function __construct(int $shopId = null)
    {
        $this->token = config('third_party.ghn_secret_id');
        $this->shopId = $shopId;
    }

    /**
     * @return Http
     */
    private function client()
    {
        return Http::withHeaders([
            'token' => $this->token,
            'shop_id' => $this->shopId,
        ]);
    }

    /**
     * @param mixed $response
     * @return \Illuminate\Support\Collection
     */
    private function handleResponse($response)
    {
        $res = $response->object();

        throw_if($response->failed(), new GHNException($res->message, $res->code));

        return collect($res->data);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getProvinces()
    {
        $response = $this->client()->get("{$this->url}/master-data/province");

        return $this->handleResponse($response);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getDistricts()
    {
        $response = $this->client()->get("{$this->url}/master-data/district");

        return $this->handleResponse($response);
    }

    /**
     * @param int $districtId
     * @return \Illuminate\Support\Collection
     */
    public function getWards(int $districtId)
    {
        $response = $this->client()->get("{$this->url}/master-data/ward?district_id={$districtId}");

        return $this->handleResponse($response);
    }

    /**
     * @param array $params
     * @return \Illuminate\Support\Collection
     */
    public function calculateShippingFee(array $params)
    {
        $response = $this->client()->post("{$this->url}/v2/shipping-order/fee", $params);

        return $this->handleResponse($response);
    }
}
