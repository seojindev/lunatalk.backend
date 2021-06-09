<?php

namespace App\Http\Middleware;

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
//            throw new ClientErrorException(__('정상적인 요청이 아닙니다.'));
            echo  "ClientErrorException";
        }

        // 클라이언트 체크 예외 라우터.
        $exceptionRouteName = ['api.system.deploy'];

        // NOTE 헤더 클라이언트 체크.
        $clientType = $request->header('request-client-type');

        if (!in_array(Route::currentRouteName(), $exceptionRouteName)) {
            if (empty($clientType) || !($clientType == env('FRONT_CLIENT_CODE') || $clientType == env('IOS_CLIENT_CODE') || $clientType == env('ANDROID_CLIENT_CODE'))) {
//                throw new ClientErrorException(__('default.exception.clienttype'));
                echo 'ClientErrorException';
            }
        }

        return $next($request);
    }
}