<?php

namespace App\Http\Livewire\FrontEnd;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public function increaseQuantity ($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);

        $this->emit('cart_updated');

        $this->dispatchBrowserEvent('notification',[
            'body' => 'Quantity changed',
            'timeout' => 4000
        ]);
    }
    
    public function decreaseQuantity ($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId, $qty);

        $this->emit('cart_updated');

        $this->dispatchBrowserEvent('notification',[
            'body' => 'Quantity changed',
            'timeout' => 4000
        ]);
    }
    
    public function removeProduct ($rowId)
    {
        Cart::remove($rowId);

        $this->emit('cart_updated');

        $this->dispatchBrowserEvent('notification',[
            'body' => 'Removed from cart',
            'timeout' => 4000
        ]);
    }

    public function render()
    {
        return view('livewire.front-end.cart-component')->layout('layouts.guest');
    }
}
