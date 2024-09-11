<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiBaiVietController;
use App\Http\Controllers\Api\ApiProductController;
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
// Route::post('login',[ApiAuthController::class,'login']);
// Route::post('logout',[ApiAuthController::class,'logout'])->middleware('auth:sanctum');

// Route::apiResource('bai-viets',ApiBaiVietController::class);
// Route::get('products/trangchu', [ApiProductController::class, 'trangchuSanPham']);

// make -- api thì sài apiResource
// còn make --resource
// Route::resource('bai-viets',ApiBaiVietController::class);
// nó sẽ trả về cả create,edit
