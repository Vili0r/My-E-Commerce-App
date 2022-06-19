<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::tree()->get()->toTree();
        $products = Product::with('attributes')->get();

        return view('frontend.shops.index', compact('categories', 'products'));
    }
    
    public function show(Product $product)
    {
        $product->load(['categories', 'attributes.descendantsAndSelf.stocks']);

        $media = $product->getMedia('products');

        return view('frontend.shops.show', compact('product', 'media'));
    }
    
    public function categoryShow(Category $category)
    {
        return view('frontend.shops.category-show', compact('category'));
    }
}
