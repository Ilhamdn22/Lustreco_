<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $response = Http::get("https://fakestoreapi.com/products");
        
        $products = [];
        if ($response->successful()) {
            $apiProducts = $response->json();
            foreach($apiProducts as $apiProduct) {
                $product = new \stdClass();
                $product->id = $apiProduct['id'];
                $product->name = $apiProduct['title'];
                // Multiply USD by 15000 to get simulated IDR
                $product->price = $apiProduct['price'] * 15000; 
                $product->image = $apiProduct['image'];
                
                if ($request->has('search') && $request->search != '') {
                    if (stripos($product->name, $request->search) === false) {
                        continue;
                    }
                }
                
                $products[] = $product;
            }
        }
        
        $products = collect($products);

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $response = Http::get("https://fakestoreapi.com/products/" . $id);
        
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