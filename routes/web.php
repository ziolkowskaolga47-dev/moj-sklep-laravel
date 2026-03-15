<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController; // Dodane, żeby nie było błędów
use Illuminate\Support\Facades\Route;

// Strona główna
Route::get('/', [ProductController::class, 'index'])->name('home');

// KOSZYK
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
// ZAMÓWIENIE (CHECKOUT)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'store'])->name('checkout.process');

// Reszta tras Breeze
Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/polityka-prywatnosci', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/product/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

require __DIR__.'/auth.php';