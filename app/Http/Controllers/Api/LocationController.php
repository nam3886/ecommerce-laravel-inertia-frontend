<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Services\GHN\GHNService;
use Illuminate\Http\Request;

class LocationController extends BaseController
{
    private $ghnService;

    public function __construct()
    {
        $this->ghnService = new GHNService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDistricts()
    {
        try {
            $districts = cache()->rememberForever("districts", function () {
                $provinces = $this->ghnService->getProvinces();

                $districts = $this->ghnService->getDistricts();
                // format for frontend
                return $districts->reduce(function ($carry, $item) use ($provinces) {
                    if ($item->SupportType !== 3) return $carry;

                    $text = $provinces->where('ProvinceID', $item->ProvinceID)->first()->ProvinceName ?? 'undefined';

                    array_push($carry, [
                        'id' => $item->DistrictID,
                        'text' => $item->DistrictName . ' - ' . $text,
                    ]);

                    return $carry;
                }, []);
            });
        } catch (\Throwable $th) {
            return $this->responseJson(message: $th->getMessage(), responseCode: $th->getCode());
        }

        return $this->responseJson(data: $districts, error: false);
    }

    /**
     * Display a listing of the resource.
     * @param int $districtId
     * @return \Illuminate\Http\Response
     */
    public function getWards(int $districtId)
    {
        try {
            $wards = cache()->rememberForever("{$districtId}_ward", function () use ($districtId) {
                $wards = $this->ghnService->getWards($districtId);
                // format for frontend
                return $wards->reduce(function ($carry, $item) {
                    if ($item->SupportType !== 3) return $carry;

                    array_push($carry, [
                        'id' => $item->WardCode,
                        'text' => $item->WardName,
                    ]);

                    return $carry;
                }, []);
            });
        } catch (\Throwable $th) {
            return $this->responseJson(message: $th->getMessage(), responseCode: $th->getCode());
        }

        return $this->responseJson(data: $wards, error: false);
    }
}
