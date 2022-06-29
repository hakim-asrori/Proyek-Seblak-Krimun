<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RekapController;
use App\Models\Category;
use App\Models\User;
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

Route::get('/', function () {
    $data = [
        'category' => Category::all()
    ];
    return view('landing.index', $data);
});

// Route::get('/coba', function () {
//     $data = [
//         'product' => App\Models\Food::all(),
//         'category' => App\Models\Category::all(),
//     ];

//     return view('coba', $data);
// });

Route::get('siteman', [AuthController::class, 'index']);
Route::post('siteman', [AuthController::class, 'login']);

Route::get('logout', [AuthController::class, 'logout']);

Route::middleware(['otentikasi'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard']);
    Route::get('food/detail/{id}', [FoodController::class, 'detail']);
    Route::resource('food', FoodController::class);
    Route::resource('category', CategoryController::class);

    Route::get('order', [OrderController::class, 'index']);
    Route::post('order/{id}', [OrderController::class, 'orderSelesai']);

    Route::get('faktur/{id}', [OrderController::class, 'faktur']);
    Route::get('rekap', [RekapController::class, 'index']);
});
