<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreVariationRequest;
use App\Http\Requests\UpdateVariationRequest;
use App\Http\Controllers\Controller;
use App\Models\Variation;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $variations = Variation::paginate(10);

        return view('admin.variations.index', compact('variations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create');

        return view('admin.variations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVariationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVariationRequest $request)
    {
        $this->authorize('create');

        Variation::create($request->validated());

        return redirect()->route('admin.variations.index')->with('success', 'Variation created successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function show(Variation $variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function edit(Variation $variation)
    {
        $this->authorize('edit');

        return view('admin.variations.edit', compact('variation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVariationRequest  $request
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVariationRequest $request, Variation $variation)
    {
        $this->authorize('edit');

        $variation->update($request->validated());

        return redirect()->route('admin.variations.index')->with('success', 'Variation updated successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variation $variation)
    {
        $this->authorize('delete');
        
        $variation->delete();
        
        return redirect()->route('admin.variations.index')->with('danger', 'Variation deleted successfuly.');
    }
}
