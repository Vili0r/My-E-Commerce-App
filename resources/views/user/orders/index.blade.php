<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse ($orders as $order)    
                <div class="overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 bg-white col-span-4 space-y-3">
                        <div class="border-b pb-3 flex items-center justify-between">
                            <div>#{{ $order->id }}</div>
                            <div>£{{ $order->subtotal }}</div>
                            <div>{{ $order->placed_at }}</div>
                            <div>
                                <span class="inline-flex items-center px-3 py-1 text-sm rounded-full font-semibold bg-gray-100 text-gray-800">
                                    {{ $order->presenter()->status() }}
                                </span>
                            </div>
                        </div>

                        @foreach ($order->attributes as $attribute)    
                            <div class="border-b py-3 space-y-2 flex items-center last:border-0 last:pb-0">
                                <div class="flex items-center"> 
                                    <img src="{{ $attribute->product->getFirstMediaUrl('products') }}" width="60" class="rounded-full ">
                                    <div class="flex flex-col ml-3"> 
                                        <span class="md:text-md font-medium">
                                            {{ $attribute->product->name }}
                                        </span> 
                                        <span class="text-xs font-light text-gray-400">
                                            {{ $attribute->sku }}
                                        </span> 
                                    </div>
                                </div>
                                
                                <div class="space-y-1 ml-3">
                                    <div>
                                        <div class="font-semibold">
                                            {{ $attribute->formattedPrice() }}
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center text-sm">
                                        <div class="mr-1 font-semibold">
                                            Quantity: {{ $attribute->pivot->quantity }} <span class="text-gray-400 mx-1">/</span>
                                        </div>
                                        @foreach ($attribute->ancestorsAndSelf as $ancestors)  
                                            {{ $ancestors->title }} 
                                            @if(!$loop->last)
                                                <span class="text-gray-400 mx-1">/</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                There are no orders placed
            @endforelse
        </div>
    </div>
</x-app-layout>