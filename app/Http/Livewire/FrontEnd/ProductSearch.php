<?php

namespace App\Http\Livewire\FrontEnd;

use App\Models\Product;
use Livewire\Component;

class ProductSearch extends Component
{
    public $searchQuery = '';

    public function clearSearch()
    {
        $this->searchQuery = '';
    }

    public function render()
    {
        $products = Product::search($this->searchQuery)->get();

        return view('livewire.front-end.product-search', compact('products'));
    }
}
