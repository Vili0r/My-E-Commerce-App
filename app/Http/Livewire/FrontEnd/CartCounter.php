<?php

namespace App\Http\Livewire\FrontEnd;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartCounter extends Component
{
    public $listeners = ['cart_updated' => 'render'];
    
    public function render()
    {
        $cart_count = Cart::content()->count();

        return view('livewire.front-end.cart-counter', compact('cart_count'));
    }
}
