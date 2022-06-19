<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class Featured extends Component
{
    public Product $product;
    public string $name;
    public bool $featured;

    public function mount()
    {
        $this->featured = $this->product->getAttribute('featured');
    }

    public function render()
    {
        return view('livewire.products.featured');
    }

    public function updating($name, $value)
    {   
        $this->product->setAttribute($name, $value)->save();
    }
}
