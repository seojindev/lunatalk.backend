<?php

use App\Http\Controllers\Front\TestController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\v1\AdminController;
use App\Http\Controllers\Front\v1\AuthController;
use App\Http\Controllers\Front\v1\ProductsController;
use App\Http\Controllers\Front\v1\ServiceController;
use App\Http\Controllers\Front\v1\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::group(['prefix' => 'front', 'as' => 'front.'], function () {
    /**
     * Front Test 용 컨트롤러.
     */
    Route::group(['prefix' => 'test', 'as' => 'test.'], function () {
        Route::get('default', [TestController::class, 'default'])->name('default');
    });

    Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::group(['namespace' => 'v1', 'prefix' => 'v1', 'as' => 'v1.'], function () {

            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('blank', [AdminController::class, 'blank'])->name('blank');

            Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
                Route::get('login', [AuthController::class, 'login'])->name('login');
            });

            // 상품 정보 페이지.
            Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
                Route::get('list', [ProductsController::class, 'list'])->name('products.list');
                Route::get('{product_uuid}/detail', [ProductsController::class, 'detail'])->name('products.detail');
                Route::get('{product_uuid}/update', [ProductsController::class, 'update'])->name('products.update');
                Route::get('create', [ProductsController::class, 'create'])->name('products.create');
            });

            // 관리 메뉴 페이지.
            Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
                Route::get('service-notice', [ServiceController::class, 'service_notice'])->name('service.notice');
            });

            // 유저(회원) 관리 페이지.
            Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
                Route::get('list', [UsersController::class, 'list'])->name('list');
            });
        });
    });
});
