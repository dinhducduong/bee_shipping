<?php

use App\Http\Controllers\web_controller\HomeController;
use App\Http\Controllers\web_controller\ShipingsController;
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

Route::get('/',[HomeController::class,'index'])->name('dashboard');
Route::get('/shippings',[ShipingsController::class,'index'])->name('shippings');
Route::put('/shippings',[ShipingsController::class,'update'])->name('shippings_update');
Route::get('/shippings/edit',[ShipingsController::class,'index'])->name('shippings_edit');
Route::get('/shipping-detail',[ShipingsController::class,'ShippingDetail'])->name('ShippingDetail');





Route::get('/csrf-token', function() {
    session()->regenerate();
    return response()->json([
       "token"=>csrf_token()],
     200);
});


