<?php

use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\SystemController;
use App\Http\Controllers\Api\v1\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Api\v1\Admin\ProductsController as AdminProductsController;
use App\Http\Controllers\Api\v1\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\Other\MediaController;
use App\Http\Controllers\Api\v1\Pages\TabsController;
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

                Route::put('{product_uuid}/best-item', [AdminProductsController::class, 'addBestItem'])->name('best.item.add'); // 베스트 아이템 추가.
                Route::delete('{product_uuid}/best-item', [AdminProductsController::class, 'deleteBestItem'])->name('best.item.delete'); // 베스트 아이템 삭제.
                Route::put('{product_uuid}/hot-item', [AdminProductsController::class, 'addHotItem'])->name('hot.item.add'); // 핫 아이템 추가.
                Route::delete('{product_uuid}/hot-item', [AdminProductsController::class, 'deleteHotItem'])->name('hot.item.delete'); // 핫 아이템 삭제.
            });

            // 시스템 공지 사항.
            Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
                Route::post('service-notice', [AdminServiceController::class, 'service_notice'])->name('service.notice.create');
                Route::delete('service-notice', [AdminServiceController::class, 'delete_service_notice'])->name('service.notice.delete');

                Route::post('edit-home-main', [AdminServiceController::class, 'edit_home_main_create'])->name('edit.home.main.create');
                Route::put('{id}/edit-home-main', [AdminServiceController::class, 'edit_home_main_update'])->name('edit.home.main.update');
                Route::delete('{id}/edit-home-main', [AdminServiceController::class, 'edit_home_main_delete'])->name('edit.home.main.delete');
                Route::post('{id}/edit-home-main/status', [AdminServiceController::class, 'edit_home_main_statsu_update'])->name('edit.home.main.status.update');
            });
        });

        Route::group(['prefix' => 'other', 'as' => 'other.'], function () {
            Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
                Route::post('{mediaName}/{mediaCategory}/create', [MediaController::class, 'media_create'])->name('create');
            });
        });

        Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {
            Route::group(['prefix' => 'tabs', 'as' => 'tabs.'], function () {
                Route::get('main-top', [TabsController::class, 'mainTop'])->name('main.top');
                Route::get('main-products-category', [TabsController::class, 'mainProductsCategory'])->name('main.products.category');
                Route::get('main-products-best-items', [TabsController::class, 'mainProductsBestItems'])->name('main.products.best.items');
                Route::get('main-products-hot-items', [TabsController::class, 'mainProductsHotItems'])->name('main.products.hot.items');
                Route::put('{click_code}/click', [TabsController::class, 'tab_click'])->name('tab.click');
            });
        });

        Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
            Route::post('login', [AuthController::class, 'login'])->name('login');
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');
            Route::post('token-refresh', [AuthController::class, 'token_refresh'])->name('token.refresh');
            Route::post('register', [AuthController::class, 'register'])->name('register');
            Route::post('phone-auth', [AuthController::class, 'phone_auth'])->name('phone.auth');
            Route::post('{auth_index}/phone-auth-confirm', [AuthController::class, 'phone_auth_confirm'])->name('phone.auth.confirm')->where('auth_index', '[0-9]+');
        });
    });
});
