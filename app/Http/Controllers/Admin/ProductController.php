<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Scopes\LiveScope;
use App\Models\Tag;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('categories')->withoutGlobalScope(LiveScope::class)->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('publish products');

        $categories = Category::all();
        $tags = Tag::all();
        
        return view('admin.products.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {       
        $this->authorize('publish products');

        $product = auth()->user()->products()->create($request->validated());
        
        for ($i = 1; $i <= 3; $i++){
            if($request->hasFile('photo' . $i)) {
                $product->addMediaFromRequest('photo' . $i)
                ->toMediaCollection('products');
            }
        }

        $product->update([
            'image' => $product->getFirstMediaUrl('products', 'thumb')
        ]);

        $product->categories()->attach($request->categories);
        $product->tags()->attach($request->tags);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfuly!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('publish products');

        $product->load('categories', 'tags');

        $media = $product->getMedia('products');

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.products.edit', compact('categories', 'tags', 'media', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('publish products');

        $product->update($request->validated());

        for ($i = 1; $i <= 3; $i++){
            if($request->hasFile('photo' . $i)) {
                $product->addMediaFromRequest('photo' . $i)->toMediaCollection('products');
            }
        }

        $product->update([
            'image' => $product->getFirstMediaUrl('products', 'thumb')
        ]);

        $product->categories()->sync($request->categories);
        $product->tags()->sync($request->tags);

        return redirect()->route('admin.products.index', compact('product'))->with('success', 'Product updated successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('publish products');

        $product->delete();
        
        return redirect()->route('admin.products.index', compact('product'))->with('danger', 'Product deleted successfuly!');
    }

    public function deletePhoto($productId, $photoId)
    {
        $this->authorize('publish products');
        
        $product = Product::where('user_id', auth()->id())->findOrFail($productId);

        $photo = $product->getMedia('products')->where('id', $photoId)->first();

        if ($photo) {
            $photo->delete();
        }

        return redirect()->route('admin.products.edit', $productId);
    }
}
