<?php

namespace App\Http\Livewire\FrontEnd;

use App\Models\Product;
use Livewire\Component;

class ProductBrowser extends Component
{
    public $category;

    public $priceRange = [
        'max' => null
    ];

    public function render()
    {
        $search = Product::search('', function ($meilisearch, string $query, array $options) {
            $options['filter'] = null;

            if($this->priceRange['max']){
                $options['filter'] .= (isset($options['filter']) ? ' AND ' :'') . 'price <= ' . $this->priceRange['max'];
            }

            return $meilisearch->search($query, $options);
        })->raw();

        $products = $this->category->products->find(collect($search['hits'])->pluck('id'));

        $maxPrice = $this->category->products->max('price');
        
        $this->priceRange['max'] = $this->priceRange['max'] ?: $maxPrice;

        return view('livewire.front-end.product-browser', compact('products', 'maxPrice'));
    }
}