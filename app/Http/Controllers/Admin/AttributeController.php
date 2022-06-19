<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Variation;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::with(['product', 'stocks'])->paginate(10);

        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('publish products');

        $products = Product::all();
        $variations = Variation::all();
        $attributes = Attribute::all();

        return view('admin.attributes.create', compact('products', 'variations', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttributeRequest $request)
    {
        $this->authorize('publish products');

        Attribute::create($request->validated());

        return redirect()->route('admin.attributes.index')->with('success', 'Product attribute created successfuly!');
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        $this->authorize('publish products');

        $attribute->load(['product.tags', 'stocks']);

        $media = $attribute->product->getMedia('products');

        return view('admin.attributes.show', compact('attribute', 'media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        $this->authorize('publish products');

        $products = Product::all();
        $variations = Variation::all();
        $attributes = Attribute::all();
        $attribute->load(['product', 'stocks']);

        return view('admin.attributes.edit', compact('products', 'variations', 'attribute', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttributeRequest  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        $this->authorize('publish products');

        $attribute->update($request->validated());

        $attribute->stocks()->updateOrCreate([
            'amount' => $request->amount
        ]);

        return redirect()->route('admin.attributes.index', compact('attribute'))->with('success', 'Product attribute updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $this->authorize('publish products');

        $attribute->delete();

        return redirect()->route('admin.attributes.index', compact('attribute'))->with('danger', 'Product attribute deleted successfuly.');
    }
}
