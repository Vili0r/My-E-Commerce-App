<div>
    <div class="flex items-center">
        <input type="search" wire:model.debounce.500ms="searchQuery" placeholder="Search for products" class="flex-grow text-sm h-10 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    </div>
    
    @if($searchQuery) 
        <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-2 column-gap-6">
                <ul>
                    @forelse ($products as $product) 
                    <li>
                        <a href="{{ route('shop.show', $product) }}" class="border-b py-3 space-y-2 flex items-center">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset($product->image) }}" width="60" class="rounded-full" alt="{{ $product->name }}">
                                <div class="font-semibold text-lg">{{ $product->formattedPrice() }}</div>
                                <div>{{ $product->name }}</div>
                            </div>
                        </a>
                        
                    </li>    
                    @empty
                        No product matches your search
                    @endforelse
                </ul>   
            </div>
            
            <a href="#" class="inline-block text-indigo-500 mt-6" wire:click="clearSearch" >Clear search</a>
        </div>
    @endif
</div>