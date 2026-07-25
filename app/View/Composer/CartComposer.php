<?php

namespace App\View\Composers;
use App\View\Composers\CartComposer;
use Illuminate\Support\Facades\View;

class CartComposer
{
    public function compose(View $view)
    {
        $cart = session('cart', []);
        $cartCount = collect($cart)->sum('quantity');
        $view->with('cartCount', $cartCount);
    }
}