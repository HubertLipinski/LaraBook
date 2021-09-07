<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserBookController;
use App\Http\Controllers\User\UserController;
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

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'user'], function () {
        Route::post('/store', [UserController::class, 'store']);
        Route::put('{user_id}/edit', [UserController::class, 'update'])
            ->where('user_id', ['0-9+']);
        Route::group(['prefix' => 'books'], function () {
            Route::get('/', [UserBookController::class, 'getList']);
//            Route::post('store', [UserBookController::class, 'index']);
        });
    });
});
