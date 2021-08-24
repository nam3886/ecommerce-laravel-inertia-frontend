<?php

namespace App\Http\Controllers;

use App\Traits\FlashMessages;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use FlashMessages;

    protected $data = null;

    /**
     * @param int $errorCode
     * @param null $message
     * @return \Illuminate\Http\Response
     */
    protected function showErrorPage($errorCode = 404, $message = null)
    {
        $data['message'] = $message;
        return response()->view('errors.' . $errorCode, $data, $errorCode);
    }

    /**
     * @param $route
     * @param $message
     * @param string $type
     * @param bool $error
     * @param bool $withOldInputWhenError
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function responseRedirect($route, $message, $type = 'info', $error = false, $routeParams = [])
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        if ($error) {
            return redirect()->back();
        }

        return redirect()->route($route, $routeParams);
    }

    /**
     * @param $message
     * @param string $type
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function responseRedirectBack($message, $type = 'info')
    {
        $this->setFlashMessage($message, $type);
        $this->showFlashMessages();

        return redirect()->back();
    }

    /**
     * @param bool $error
     * @param int $responseCode
     * @param array $message
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseJson($error = true, $responseCode = 200, $message = [], $data = null)
    {
        return response()->json([
            'error'         =>  $error,
            'response_code' =>  $responseCode,
            'message'       =>  $message,
            'data'          =>  $data
        ], $responseCode);
    }
}
