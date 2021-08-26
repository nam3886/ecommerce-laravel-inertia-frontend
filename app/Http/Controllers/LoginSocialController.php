<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class LoginSocialController extends BaseController
{
    /**
     * @var array
     */
    private array $driver = ['facebook', 'google', 'github'];

    /**
     * Redirect to social driver.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect($provider)
    {
        abort_if(!in_array($provider, $this->driver), 404);

        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Handle the callback form social driver.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback($provider)
    {
        abort_if(!in_array($provider, $this->driver), 404);

        try {
            $userSocial = Socialite::driver($provider)->stateless()->user();
        } catch (\Throwable $th) {
            return $this->responseRedirect('login', $th->getMessage(), 'error');
        }

        $user = User::firstOrCreate(
            ['email'                    =>  $userSocial->getEmail()],
            [
                'name'                  =>  $userSocial->getName() ?? $userSocial->getNickname(),
                'email'                 =>  $userSocial->getEmail(),
                'provider_id'           =>  $userSocial->getId(),
                'provider'              =>  $provider,
                'password'              =>  bcrypt(get_uniqid_code()),
                'profile_photo_path'    =>  $userSocial->getAvatar(),
            ]
        );

        // $user->markEmailAsVerified();

        Auth::login($user);

        return $this->responseRedirect('home', trans('response.user.success.login'), 'success');
    }
}
