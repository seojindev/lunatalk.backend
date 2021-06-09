<?php

use App\Http\Controllers\Front\TestController;
use App\Http\Controllers\Front\HomeController;
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
});
