<?php

namespace App\View\Composers;

use Illuminate\View\View;

class CartComposer
{
    public function compose(View $view)
    {
        $cart = session('cart', []);
        $cartCount = collect($cart)->sum('quantity');
        $view->with('cartCount', $cartCount);
    }
}