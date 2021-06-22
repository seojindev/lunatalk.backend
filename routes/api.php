<?php

use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\SystemController;
use App\Http\Controllers\Api\v1\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Api\v1\Admin\ProductsController as AdminProductsController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\Other\MediaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['as' => 'api.'], function () {
    /**
     * Api Test 용 컨트롤러.
     */
    Route::group(['prefix' => 'test', 'as' => 'test.'], function () {
        Route::post('default', [TestController::class, 'default'])->name('default');
        Route::post('user-insert', [TestController::class, 'user_insert'])->name('user-insert');
    });

    /**
     * 시스템 용.
     */
    Route::group(['namespace' => 'system', 'prefix' => 'system', 'as' => 'system.'], function () {
        Route::get('check-status', [SystemController::class, 'checkStatus'])->name('check.status'); // 서버 상태 체크
        Route::get('check-notice', [SystemController::class, 'checkServerNotice'])->name('check.server.notice'); // 서버 공지 사항 체크
        Route::get('base-data', [SystemController::class, 'baseData'])->name('base.data'); // 공통 데이터.

    });

    /**
     * api
     */
    Route::group(['namespace' => 'v1', 'prefix' => 'v1', 'as' => 'v1.'], function () {

        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

            // 인증.
            Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
                Route::post('login', [AdminAuthController::class, 'login'])->name('login');
            });

            // 상품 관련
            Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
                Route::post('create', [AdminProductsController::class, 'create'])->name('create');
                Route::put('{product_uuid}/update', [AdminProductsController::class, 'update'])->name('update');
            });
        });

        Route::group(['prefix' => 'other', 'as' => 'other.'], function () {
            Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
                Route::post('{mediaName}/{mediaCategory}/create', [MediaController::class, 'media_create'])->name('create');
            });
        });

        Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
            Route::post('login', [AuthController::class, 'login'])->name('login');
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');
            Route::post('phone-auth', [AuthController::class, 'phone_auth'])->name('phone.auth');
            Route::post('{auth_index}/phone-auth-confirm', [AuthController::class, 'phone_auth_confirm'])->name('phone.auth.confirm')->where('auth_index', '[0-9]+');
        });
    });
});
