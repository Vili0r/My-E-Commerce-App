<div>
    <section class="bg-slate-50">
        <div class="container px-6 py-8 mx-max">
            <div class="lg:flex lg:-mx-2">
                <div class="col-span-1">
                    <div class="space-y-6">
                        <div class="space-y-1">
                            <ul>
                                @foreach ($category->children as $child)
                                    <li>
                                        <a href="{{ route('shop.category.show', $child->slug) }}" class="text-indigo-500">
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
            
                        <div class="space-y-6">
                            @if($category->products->count())    
                                <div class="space-y-1">
                                    <div class="font-semibold">Max price (£{{ $priceRange['max'] }})</div>
                                    <div class="flex items-center space-x-2">
                                        <input type="range" min="0" max="{{ $maxPrice }}" wire:model="priceRange.max">
                                    </div>
                                </div>
                            @endif
            
                            <div class="space-y-1">
                                <div class="font-semibold">Filter title</div>
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" id="" value=""> <label for="">Filter (count)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ml-4 mt-6 lg:mt-0 lg:px-2 lg:w-4/5 ">
                    <div class="flex items-center justify-between text-sm tracking-widest uppercase ">
                        <div class="mb-6">
                            Found {{ $products->count() }} {{ Str::plural('products', $products->count()) }} matching your filters
                        </div>  
                    </div>

                    <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach ($products as $product)     
                            <div class="flex flex-col items-center justify-center w-full max-w-lg mx-auto">
                                <img class="w-full rounded-md h-72 xl:h-80" src="{{ $product->getFirstMediaUrl('products', 'preview') }}" alt="Not available">
                                <h4 class="mt-2 text-lg font-medium text-gray-700">{{ $product->name }}</h4>
                                <p class="text-blue-500">{{ $product->formattedPrice() }}</p>

                                <a href="{{ route('shop.show', $product) }}" class="flex items-center justify-center w-full px-2 py-2 mt-4 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                                    <x-heroicon-o-arrow-right class="w-5 h-5 mx-1"/>
                                    <span class="mx-1">View Product</span>
                                </a>
                            </div> 
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
