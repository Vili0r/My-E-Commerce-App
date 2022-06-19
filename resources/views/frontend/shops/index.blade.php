<x-guest-layout>

    <section class="bg-slate-50 h-full">
        <div class="container px-6 py-8 mx-max">
            <div class="lg:flex lg:-mx-2">
                <div class="space-y-3 lg:w-1/5 lg:px-2 lg:space-y-4">
                    @foreach ($categories as $category)
                        <x-category-item :category="$category" />
                    @endforeach
                </div>

                <div class="mt-6 lg:mt-0 lg:px-2 lg:w-4/5 ">
                    <div class="flex items-center justify-between text-sm tracking-widest uppercase ">
                        <p class="text-gray-500">{{ $products->count() }} {{ Str::plural('products', $products->count()) }}</p>
                        <div class="flex items-center">
                            <livewire:front-end.product-search />
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
</x-guest-layout>