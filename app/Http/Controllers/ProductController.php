<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index(Request $request)
{
    // Ambil parameter filter
    $search = $request->query('search');
    $category = $request->query('category'); // 'all', 't-shirt', 'hoodie', 'celana'
    $type = $request->query('type');
    $availability = $request->query('availability');

    // Ambil data dari API
    $response = Http::withoutVerifying()->get("https://fakestoreapi.com/products");
    $products = collect();

    if ($response->successful()) {
        $apiProducts = $response->json();
        foreach ($apiProducts as $apiProduct) {
            $product = new \stdClass();
            $product->id = $apiProduct['id'];
            $product->name = $apiProduct['title'];
            $product->price = $apiProduct['price'] * 15000;
            $product->image = $apiProduct['image'];
            $product->category = $apiProduct['category'];
            $product->description = $apiProduct['description'] ?? '';
            $products->push($product);
        }
    } else {
        $products = $this->getDummyProducts();
    }

    // --- FILTER BERDASARKAN KATEGORI STATIS (T-Shirt, Hoodie, Celana) ---
    if ($category && $category !== 'all') {
        $keywordMap = [
            't-shirt' => ['shirt', 'tee', 't-shirt'],
            'hoodie'  => ['hoodie', 'sweatshirt', 'hooded'],
            'pants'  => ['pants', 'jeans', 'trouser', 'jogger'],
        ];

        $keywords = $keywordMap[$category] ?? [];
        if (!empty($keywords)) {
            $products = $products->filter(function ($product) use ($keywords) {
                $name = strtolower($product->name);
                foreach ($keywords as $keyword) {
                    if (strpos($name, $keyword) !== false) {
                        return true;
                    }
                }
                return false;
            });
        }
    }

    // Filter lainnya (search, type, availability) tetap sama seperti sebelumnya
    if ($search) {
        $products = $products->filter(function ($product) use ($search) {
            return stripos($product->name, $search) !== false ||
                   stripos($product->description, $search) !== false;
        });
    }

    if ($type === 'discount') {
        $products = $products->filter(function ($product) {
            return $product->price < 100000;
        });
    }

    if ($availability === 'in_stock') {
        $products = $products->filter(function ($product) {
            return $product->id % 2 == 0;
        });
    }

    // Daftar kategori statis untuk ditampilkan di sidebar
    $categories = collect(['t-shirt', 'hoodie', 'pants']);

    return view('products.index', compact('products', 'categories', 'search', 'category', 'type', 'availability'));
    }

    public function show($id)
    {
        $response = Http::withoutVerifying()->get("https://fakestoreapi.com/products/" . $id);
        
        if ($response->successful()) {
            $apiProduct = $response->json();
            $product = new \stdClass();
            $product->id = $apiProduct['id'];
            $product->name = $apiProduct['title'];
            $product->price = $apiProduct['price'] * 15000;
            $product->image = $apiProduct['image'];
            $product->description = $apiProduct['description'];
            $product->category = $apiProduct['category'];
            
            return view('products.show', compact('product'));
        }
        
        abort(404);
    }
}