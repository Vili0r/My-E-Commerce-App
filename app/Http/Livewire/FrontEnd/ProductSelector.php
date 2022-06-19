<?php

namespace App\Http\Livewire\FrontEnd;

use App\Models\Product;
use App\Models\Attribute;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductSelector extends Component
{
    public Product $product;
    public $initialVariation;
    public $skuVariant;
    public $all_product_attributes = [];

    protected $listeners = [
        'skuVariantSelected'
    ];

    public function mount(Product $product)
    {
        $this->initialVariation = $this->product->attributes->where('product_id', $product->id)->whereNull('parent_id');
    }

    public function skuVariantSelected($variantId)
    {
        if(!$variantId){
            $this->skuVariant = null;
            return;
        }

        $this->skuVariant = Attribute::find($variantId);
        $this->all_product_attributes[0] = $this->skuVariant->sku;
    }

    public function addToCart($product_id)
    {
        $attribute = Attribute::findOrFail($product_id);

        Cart::add(
            $product_id,
            $attribute->title,
            1,
            $attribute->price,
            $this->all_product_attributes,
        )->associate('App\Models\Attribute');

        $this->emit('cart_updated');

        $this->dispatchBrowserEvent('notification',[
            'body' => 'Added to cart',
            'timeout' => 4000
        ]);
    }

    public function render()
    {
        $cart = Cart::content();

        return view('livewire.front-end.product-selector', compact('cart'));
    }
}
