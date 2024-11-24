<?php

use App\Http\Controllers\Api\TokoController;
use App\Http\Controllers\Api\AuthController;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// routes/api.php
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/get-list-produk', [TokoController::class, 'getListProduk']);
    Route::get('/get-data-produk/{id}', [TokoController::class, 'getDataProduk']);

    Route::post('/get-batch-image-produk', [TokoController::class, 'getBatchImageProduk']);
    //checkout

    Route::post('/checkout', [TokoController::class, 'checkout']);
});
