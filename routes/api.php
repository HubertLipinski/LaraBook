<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Book\BookSearchController;
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

Route::post('user', [UserController::class, 'store']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('auth/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'user'], function () {
        Route::put('{user_id}', [UserController::class, 'update'])->where('user_id', '[0-9]+');
        Route::delete('{user_id}', [UserController::class, 'destroy'])->where('user_id', '[0-9]+');

        Route::group(['prefix' => 'book'], function () {
            Route::get('/', [UserBookController::class, 'getList']);
            Route::post('/', [BookController::class, 'store']);
            Route::put('{book_id}', [BookController::class, 'update'])->where('book_id', '[0-9]+');
            Route::delete('{book_id}', [BookController::class, 'destroy'])->where('book_id', '[0-9]+');
        });

        Route::post('{user_id}/book/{book_id}', [UserBookController::class, 'storeUserBook']);
    });
    Route::get('book/search', [BookSearchController::class, 'search']);
});
