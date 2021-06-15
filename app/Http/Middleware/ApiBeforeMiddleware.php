<?php

namespace App\Http\Middleware;

use App\Exceptions\ClientErrorException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ApiBeforeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * ajax 아닐때.
         */
        if ($request->wantsJson() == false) {
            throw new ClientErrorException(__('정상적인 요청이 아닙니다.'));
        }

        // 클라이언트 체크 예외 라우터.
        $exceptionRouteName = ['api.system.deploy'];

        // NOTE 헤더 클라이언트 체크.
        $clientType = $request->header('request-client-type');

        if (!in_array(Route::currentRouteName(), $exceptionRouteName)) {
            if (empty($clientType) || !($clientType ==  config('extract.clientType.front.code') || $clientType == config('extract.clientType.ios.code') || $clientType == config('extract.clientType.android.code') || $clientType == config('extract.clientType.service_front.code'))) {
                throw new ClientErrorException(__('message.exception.ClientTypeError'));
            }
        }

        return $next($request);
    }
}
