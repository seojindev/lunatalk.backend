<?php

use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\SystemController;
use App\Http\Controllers\Api\Front\v1\AuthController;
use App\Http\Controllers\Api\admin\v1\AuthController as AdminAuthController;
use App\Http\Controllers\Api\admin\v1\ProductController as AdminProductController;
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
        Route::post('test', [TestController::class, 'test'])->name('test');
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
     * font api
     */
    Route::group(['namespace' => 'front', 'prefix' => 'front', 'as' => 'front.'], function () {
        Route::group(['namespace' => 'v1', 'prefix' => 'v1', 'as' => 'v1.'], function () {
            Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
                Route::get('{phoneNumber}/phone-auth', [AuthController::class, 'phoneAuth'])->name('phone.auth'); // 인증번호 요청.
                Route::post('{authIndex}/phone-auth-confirm', [AuthController::class, 'phoneAuthConfirm'])->name('phone.auth.confirm')->where('authIndex', '[0-9]+'); // 인증번호 확인.
                Route::post('register', [AuthController::class, 'register'])->name('register'); // 회원가입.
                Route::post('login', [AuthController::class, 'login'])->name('login'); // 로그인.
                Route::delete('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:api'); // 로그아웃.
                Route::get('token-info', [AuthController::class, 'tokenInfo'])->name('token.info')->middleware('auth:api'); // 토큰 정보.
            });
        });
    });

    /**
     * admin-font api
     */
    Route::group(['namespace' => 'admin', 'prefix' => 'admin-front', 'as' => 'admin-front.'], function () {
        Route::group(['namespace' => 'v1', 'prefix' => 'v1', 'as' => 'v1.'], function () {
            Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
                Route::post('login', [AdminAuthController::class, 'login'])->name('login'); // 로그인.
                Route::delete('logout', [AdminAuthController::class, 'logout'])->name('logout')->middleware('auth:api'); // 로그아웃.
            });
            Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
                Route::post('create-product-category', [AdminProductController::class, 'create_product_category'])->name('create.product.category');
                Route::get('show-product-category', [AdminProductController::class, 'show_product_category'])->name('show.product.category');
                Route::put('{productUUID}/update-product-category', [AdminProductController::class, 'update_product_category'])->name('update.product.category');
                Route::delete('{productUUID}/delete-product-category', [AdminProductController::class, 'delete_product_category'])->name('delete.product.category');
            });
        });
    });
});
