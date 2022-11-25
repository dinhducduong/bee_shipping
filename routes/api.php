<?php

use App\Http\Controllers\ShipDetailController;
use App\Http\Controllers\ShippingController;
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



Route::post('/create-shipping',[ShippingController::class,'CreateShipping']);
Route::post('/update-shipping',[ShippingController::class,'UpdateShipping']);
Route::get('/get-shipping',[ShippingController::class,"GetShipping"]);
Route::post('/test',[ShipDetailController::class,'test']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// dang giao, thong quan, da nhan dc hang