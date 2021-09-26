<?php

use App\Http\Controllers\Api\Other\v1\MediaController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\SystemController;
use App\Http\Controllers\Api\Front\v1\AuthController;
use App\Http\Controllers\Api\Admin\v1\AuthController as AdminAuthController;
use App\Http\Controllers\Api\Admin\v1\ProductController as AdminProductController;
use App\Http\Controllers\Api\Admin\v1\SiteManageController as AdminSiteManageController;
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
     * Other
     */
    Route::group(['namespace' => 'other', 'prefix' => 'other', 'as' => 'other.'], function () {
        Route::group(['namespace' => 'v1', 'prefix' => 'v1', 'as' => 'v1.'], function () {
            Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
                Route::post('{mediaName}/{mediaCategory}/create', [MediaController::class, 'createMedia'])->name('create'); //파일 업로드.
            });
        });
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
                Route::post('create-product-category', [AdminProductController::class, 'createProductCategory'])->name('create.product.category');  // 상품 카테고리 추가.
                Route::get('show-product-category', [AdminProductController::class, 'showProductCategory'])->name('show.product.category'); // 상품 카테고리 리스트.
                Route::get('{productCategoryUUID}/detail-product-category', [AdminProductController::class, 'detailProductCategory'])->name('detail.product.category'); // 상품 카테고리 상세.
                Route::put('{productCategoryUUID}/update-product-category', [AdminProductController::class, 'updateProductCategory'])->name('update.product.category'); // 상품 카테고리 수정.
                Route::delete('{productCategoryUUID}/delete-product-category', [AdminProductController::class, 'deleteProductCategory'])->name('delete.product.category'); // 상품 카테고리 삭제(한건).
                Route::delete('delete-product-categories', [AdminProductController::class, 'deleteProductCategories'])->name('delete.product.categories'); // 상품 카테고리 삭제(한건).

                Route::post('create-product', [AdminProductController::class, 'createProduct'])->name('create.product'); // 상품 추가.
                Route::get('show-product', [AdminProductController::class, 'showProduct'])->name('show.product'); // 상품 리스트.
                Route::put('{productUUID}/update-product', [AdminProductController::class, 'updateProduct'])->name('update.product');   // 상품 정보 수정.
                Route::get('{productUUID}/detail-product', [AdminProductController::class, 'detailProduct'])->name('detail.product'); // 상품 상세.
                Route::delete('{productUUID}/delete-product', [AdminProductController::class, 'deleteProduct'])->name('delete.product'); // 상품 삭제(한건).
                Route::delete('delete-products', [AdminProductController::class, 'deleteProducts'])->name('delete.products'); // 상품 삭제(복수).
            });

            Route::group(['prefix' => 'main-slide', 'as' => 'main-slide'], function () {
                Route::post('create-main-slide',[AdminProductController::class, 'createMainSlide'])->name('create.main.slide');
                Route::get('show-main-slide',[AdminProductController::class, 'showMainSlide'])->name('show.main.slide');
                Route::get('{mainSlideUUID}/detail-main-slide',[AdminProductController::class, 'detailMainSlide'])->name('detail.main.slide');
                Route::put('{mainSlideUUID}/update-main-slide',[AdminProductController::class, 'updateMainSlide'])->name('update.main.slide');
                Route::delete('delete-main-slides',[AdminProductController::class, 'deleteMainSlide'])->name('delete.main.slides');
            });

            Route::group(['prefix' => 'site-manage', 'as' => 'site-manage'], function () {
                Route::post('create-notice',[AdminSiteManageController::class, 'createNotice'])->name('create.notice'); // 싸이트 공지사항 등록.
                Route::put('{noticeUUID}/update-notice',[AdminSiteManageController::class, 'updateNotice'])->name('update.notice'); // 싸이트 공지사항 수정.
                Route::delete('delete-notice',[AdminSiteManageController::class, 'deleteNotice'])->name('delete.notice'); // 싸이트 공지 사항 삭제.
                Route::get('{noticeUUID}/detail-notice',[AdminSiteManageController::class, 'detailNotice'])->name('detail.notice'); // 싸이트 공지사항 디테일
                Route::get('show-notice', [AdminSiteManageController::class, 'showNotice'])->name('show.notice'); // 싸이트 공지 사항 리스트.
            });

        });
    });
});
