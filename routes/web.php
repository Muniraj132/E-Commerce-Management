<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ProductController::class, 'products'])->name('shop');

Route::get('/product/{slug}', [ProductController::class, 'productShow'])->name('product');

Route::middleware(['auth'])->group(function () {
    Route::post('/add-to-cart', [ProductController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [ProductController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update', [ProductController::class, 'cartUpdate'])->name('cart.update');
    Route::get('/success', [ProductController::class, 'success'])->name('success');
});


Route::group(['middleware' => ['auth']], function () {

    Route::get('cart/view', [ProductController::class, 'viewCart'])->name('cart.view');
    Route::delete('cart/remove/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('cart/add', [ProductController::class, 'addToCart'])->name('cart.add');
    Route::get('checkout', [ProductController::class, 'checkout'])->name('checkout');
    Route::post('checkout', [ProductController::class, 'processCheckout'])->name('checkout.store');
    Route::get('orders', [ProductController::class, 'orders'])->name('orders');
});
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth','access']], function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('dashboard');

     Route::resource('/categories', \App\Http\Controllers\Admin\CategoryController::class);
     Route::resource('/products', \App\Http\Controllers\Admin\ProductController::class);
     Route::resource('/users', \App\Http\Controllers\Admin\UserController::class);
     Route::resource('/orders', \App\Http\Controllers\Admin\OrderController::class);
});

require __DIR__.'/auth.php';
