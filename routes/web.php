<?php

use App\Http\Controllers\Front\TestController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\v1\AdminController;
use App\Http\Controllers\Front\v1\AuthController;
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

        });

    });


});
