<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;

Route::get('/', function () {
    return view('orderview');
});

Route::get('/order', function () {
    return view('orderview');
});

Route::get('/dine', function () {
    return view('dineOrderingOpt');
});

Route::get('/menu',[FoodController::class,'menu']);
Route::get('/order',[FoodController::class,'order']);
Route::post('/cart/add/{menu_item_id}', [FoodController::class, 'addToCart']);
Route::post('/cart/update/{id}', [FoodController::class, 'updateCart']);
Route::post('/cart/remove/{id}', [FoodController::class, 'removeFromCart']);
Route::get('/payment', [FoodController::class, 'payment']);
