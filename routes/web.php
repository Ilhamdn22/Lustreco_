<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================================
// PUBLIC PAGES
// ============================================================

// Home – menampilkan produk unggulan & daftar produk
Route::get('/', function () {
    try {
        $response = Http::withoutVerifying()->get('https://fakestoreapi.com/products?limit=4');
        $products = $response->successful()
            ? collect($response->json())->map(fn($item) => (object) [
                'id'       => $item['id'],
                'name'     => $item['title'],
                'price'    => (int) round($item['price'] * 15000),
                'image'    => $item['image'],
                'category' => $item['category'],
            ])
            : collect();
    } catch (\Exception $e) {
        $products = collect();
    }

    // Ambil produk pertama sebagai unggulan (featured)
    $product = $products->first() ?: (object) [
        'id'       => 0,
        'name'     => 'Featured Product',
        'price'    => 0,
        'image'    => 'https://via.placeholder.com/500x500?text=No+Image',
        'category' => 'uncategorized',
    ];

    return view('home', compact('products', 'product'));
})->name('home');

// About
Route::view('/about', 'about')->name('about');

// ============================================================
// PRODUCT ROUTES
// ============================================================
Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::get('/products/{id}', 'show')->name('products.show');
});

// ============================================================
// ACCOUNT (bisa diakses guest)
// ============================================================
Route::get('/account', [AccountController::class, 'index'])->name('account');

// ============================================================
// DASHBOARD (auth & verified)
// ============================================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ============================================================
// AUTHENTICATED ROUTES
// ============================================================
Route::middleware('auth')->group(function () {

    // ---- Profile ----
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
        Route::put('/password', 'updatePassword')->name('password.update');
    });

    // ---- Cart ----
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'index')->name('cart.index');
        Route::post('/cart/add', 'add')->name('cart.add');
        Route::patch('/cart/{key}', 'update')->name('cart.update');
        Route::delete('/cart/{key}', 'remove')->name('cart.remove');
    });

    // ---- Checkout ----
    Route::controller(OrderController::class)->group(function () {
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::post('/checkout', 'store')->name('checkout.store');
        Route::get('/orders/{order}', 'show')->name('orders.show');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });
});

// ============================================================
// AUTH ROUTES (Laravel Breeze / Jetstream)
// ============================================================
require __DIR__ . '/auth.php';