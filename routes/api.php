<?php

use App\Http\Controllers\Api\TestController;
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
        });
    });
});
