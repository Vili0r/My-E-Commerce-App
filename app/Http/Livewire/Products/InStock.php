<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class InStock extends Component
{
    public Product $product;
    public string $name;
    public bool $in_stock;

    public function mount()
    {
        $this->in_stock = $this->product->getAttribute('in_stock');
    }

    public function render()
    {
        return view('livewire.products.in-stock');
    }

    public function updating($name, $value)
    {
        $this->product->setAttribute($name, $value)->save();
    }
}
