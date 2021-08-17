<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UserAddressRequest;
use App\Models\UserAddress;

class UserController extends BaseController
{
    /**
     * @param \App\Http\Requests\UserAddressRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateAddress(UserAddressRequest $request)
    {
        auth()->user()->address()->updateOrCreate([], $request->validated());

        return $this->responseRedirectBack(trans('response.user.success.update_address'), 'success');
    }
}
