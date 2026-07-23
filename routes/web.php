<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);   
Route::get('/account', function () {
    return view('account');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/cart', function () {
    $response = Illuminate\Support\Facades\Http::get("https://fakestoreapi.com/products");
    $products = collect();
    if ($response->successful()) {
        foreach(array_slice($response->json(), 0, 5) as $apiProduct) {
            $product = new \stdClass();
            $product->name = $apiProduct['title'];
            $product->price = $apiProduct['price'] * 15000;
            // Cart blade currently uses a default placeholder via UI avatars but we can pass image just in case
            $product->image = $apiProduct['image'];
            $products->push($product);
        }
    }
    return view('cart', compact('products'));
});
Route::get('/checkout', function () {
    return view('checkout');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
