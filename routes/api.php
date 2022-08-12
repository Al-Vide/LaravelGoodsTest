<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post( '/goods', [ \App\Http\Controllers\GoodController::class, 'store' ] );
Route::put( '/goods/{id}', [ \App\Http\Controllers\GoodController::class, 'update' ] );
Route::get( '/goods/search-name', [ \App\Http\Controllers\GoodController::class, 'getByName' ] );
Route::get( '/goods/search-category-id', [ \App\Http\Controllers\GoodController::class, 'getByCategoryId' ] );
Route::get( '/goods/search-category-name', [ \App\Http\Controllers\GoodController::class, 'getByCategoryName' ] );
Route::get( '/goods/search-prices', [ \App\Http\Controllers\GoodController::class, 'getByPrices' ] );
Route::get( '/goods/search-publish', [ \App\Http\Controllers\GoodController::class, 'getByPublishState' ] );
Route::get( '/goods/search-not-deleted', [ \App\Http\Controllers\GoodController::class, 'getNotDeleted' ] );

Route::post( '/categories', [ \App\Http\Controllers\CategoryController::class, 'store' ] );
Route::delete( '/categories/{id}', [ \App\Http\Controllers\CategoryController::class, 'destroy' ] );
