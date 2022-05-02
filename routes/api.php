<?php

use App\Http\Controllers\API\APICheckoutController;
use App\Http\Controllers\API\APIFoodController;
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

Route::get('food/all', [APIFoodController::class, 'showAll']);
Route::post('food/search', [APIFoodController::class, 'searchFood']);
Route::post('category/search', [APIFoodController::class, 'searchCategory']);
Route::post('checkout', [APICheckoutController::class, 'store']);
