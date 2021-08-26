<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UserAddressRequest;
use App\Http\Requests\UserBillingAddressRequest;
use App\Traits\SessionShippingFee;

class UserController extends BaseController
{
    use SessionShippingFee;

    /**
     * @param \App\Http\Requests\UserBillingAddressRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateBillingAddress(UserBillingAddressRequest $request)
    {
        auth()->user()->address()->updateOrCreate([], $request->validated());

        $this->addressChangeHandling();

        return $this->responseRedirectBack(trans('response.user.success.update_billing_address'), 'success');
    }
}
