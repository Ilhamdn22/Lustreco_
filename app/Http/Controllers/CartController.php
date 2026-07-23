<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        // Fetch products for "Recently Ordered" section
        $products = collect();
        try {
            $response = \Illuminate\Support\Facades\Http::timeout(5)->get('https://fakestoreapi.com/products');
            if ($response->successful()) {
                foreach (array_slice($response->json(), 0, 5) as $apiProduct) {
                    $product = new \stdClass();
                    $product->name  = $apiProduct['title'];
                    $product->price = $apiProduct['price'] * 15000;
                    $product->image = $apiProduct['image'];
                    $products->push($product);
                }
            }
        } catch (\Exception $e) {
            // If API fails, just show empty recently ordered
        }

        return view('cart', compact('cart', 'subtotal', 'products'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'id'       => 'required',
            'name'     => 'required|string',
            'price'    => 'required|numeric',
            'image'    => 'nullable|string',
            'size'     => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        // Unique key: product id + size
        $key = $request->id . '_' . $request->size;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->quantity;
        } else {
            $cart[$key] = [
                'id'       => $request->id,
                'name'     => $request->name,
                'price'    => $request->price,
                'image'    => $request->image,
                'size'     => $request->size,
                'quantity' => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item added to cart!');
    }

    /**
     * Update quantity of an item.
     */
    public function update(Request $request, $key)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            $qty = max(1, (int) $request->quantity);
            $cart[$key]['quantity'] = $qty;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove($key)
    {
        $cart = session()->get('cart', []);
        unset($cart[$key]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item removed.');
    }
}
