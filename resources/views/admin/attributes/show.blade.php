<x-admin-layout>
    @hasrole('admin|seller|super admin')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
                <div class="flex justify-end m-2 p-2">
                    <a href="{{ route('admin.attributes.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                        Product attribute Index
                    </a>
                </div>       
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        
                        <div class="w-1/2 mx-auto overflow-hidden bg-slate-50 rounded-lg shadow-lg">
                            <div class="px-4 py-2">
                                <h1 class="text-3xl font-bold text-gray-800">{{ Str::title($attribute->title) }} {{ Str::title($attribute->product->name) }}</h1>
                                <div class="flex justify-between">
                                    <p class="mt-1 text-sm text-gray-600">{{ $attribute->product->description }}</p>
                                    <div>
                                        @foreach ($attribute->product->tags as $tag)
                                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <img class="w-82 h-82 mt-2" src="{{ $attribute->product->getFirstMediaUrl('products', 'preview') }}">

                            <div class="flex items-center justify-between px-4 py-2 bg-gray-900">
                                <h1 class="text-lg font-bold text-white">{{ $attribute->formattedPrice() }}h1>
                                                            
                                <div>
                                    
                                </div>
                                <div class="px-2 py-1 text-xs font-semibold text-gray-900 uppercase transition-colors duration-200 transform bg-white rounded hover:bg-gray-200 focus:bg-gray-400 focus:outline-none">
                                    @forelse($attribute->stocks as $stock)
                                        @if($stock->amount > 0)  
                                            In Stock
                                        @else
                                            Out of Stock
                                        @endif
                                    @empty
                                        Out of stock
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endhasrole
</x-admin-layout>