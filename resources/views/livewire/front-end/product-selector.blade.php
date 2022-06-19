<div class="p-6 bg-slate-50 grid grid-cols-2 gap-4 h-screen">
    <div class="col-span-1 grid">
        <img class="w-full rounded-md h-72 xl:h-80" src="{{ $product->getFirstMediaUrl('products', 'thumb') }}" alt="Not available">
    </div>
    
    <div class="col-span-1 p-6 space-y-6 font-sans bg-white">
        <form class="flex-auto p-6">
            <div class="flex flex-wrap">
                <h1 class="flex-auto text-lg font-semibold text-slate-900">
                    {{ Str::title($product->name) }}
                </h1>                        
                <div class="text-lg font-semibold text-slate-500">
                    {{ $product->formattedPrice() }}
                </div>
            </div>
            <div class="flex items-baseline mt-4 mb-6 pb-6 border-b border-slate-200">
                <div class="space-x-2 flex text-sm">
                    @foreach ($product->categories as $category)
                        <label>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                {{ $category->name }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <p class="text-sm text-slate-700">
                Free shipping on all continental UK orders.
            </p>

            <livewire:front-end.attribute-dropdown :variations="$initialVariation" /> 

            @if($skuVariant)  
                <div class="space-y-6 mt-6">
                    <div class="font-semibold text-lg">
                        {{ $skuVariant->formattedPrice() }}
                    </div>
                    <div class="flex space-x-4 mt-6 text-sm font-medium">
                        <div class="flex-auto flex space-x-4">
                            @if($cart->where('id', $skuVariant->id)->count())
                                <a href="{{ route('checkout') }}" class="h-10 px-6 pt-2 font-semibold rounded-md bg-black text-white hover:text-slate-900 hover:bg-white hover:border-slate-200">
                                    Buy now
                                </a> 
                            @else
                                <button wire:click.prevent="addToCart({{ $skuVariant->id }})" type="button" class="h-10 px-6 font-semibold rounded-md border border-slate-200 text-slate-900 hover:bg-black hover:text-white">
                                    Add to bag
                                </button>
                            @endif 
                        </div>
                        <button class="flex-none flex items-center justify-center w-9 h-9 rounded-md text-slate-300 border border-slate-200" type="button" aria-label="Like">
                            <svg width="20" height="20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </form>
        
    </div>
</div>