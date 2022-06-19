<div class="h-screen bg-gray-300">
    <div class="py-12">
        <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg md:max-w-5xl">
            <div class="md:flex ">
                <div class="w-full p-4 px-5 py-5">
                    <h1 class="text-xl font-medium ">Shopping Cart</h1>  
                    @if(Cart::count() > 0)
                        @foreach (Cart::content() as $item)
                            <div class="flex justify-between items-center mt-6 pt-6">
                                <div class="flex items-center"> 
                                    <img src="{{ asset($item->model->product->image) }}" width="60" class="rounded-full" alt="{{ $item->name }}">
                                    <div class="flex flex-col ml-3"> 
                                        <span class="md:text-md font-medium">
                                            {{ $item->name }} {{ $item->model->product->name }}    
                                        </span> 
                                        @foreach ($item->options as $value)
                                            <span class="text-xs font-light text-gray-400">#{{ $value }}</span> 
                                        @endforeach    
                                    </div>
                                </div>
                                <div class="flex justify-center items-center">
                                    <div class="pr-8 flex "> 
                                        <a href="" class="font-semibold" wire:click.prevent="decreaseQuantity('{{ $item->rowId }}')">-</a> 
                                            <input value="{{ $item->qty }}" type="text" class="focus:outline-none bg-gray-100 border h-6 w-8 rounded text-sm px-2 mx-2"> 
                                        <a href="" class="font-semibold" wire:click.prevent="increaseQuantity('{{ $item->rowId }}')">+</a> 
                                    </div>
                                    <div class="pr-8 "> <span class="text-xs font-medium">{{ $item->model->formattedPrice() }}</span> </div>
                                    <div><button wire:click.prevent="removeProduct('{{ $item->rowId }}')" type="button"><x-ri-close-circle-fill class="mt-2 w-6 h-6" /></button></div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No item has been added in the cart.
                            <a href={{ route('shop.index') }}>
                            <span class="text-md font-medium text-blue-500">Continue Shopping</span>
                        </a></p>
                    @endif
                    
                    @if(Cart::count() > 0)
                        <div class="flex justify-between items-center mt-6 pt-6 border-t">
                            <div class="flex items-center">
                                <a href="{{ route('checkout') }}" class="h-10 px-6 pt-2 font-semibold rounded-md border border-slate-200 text-slate-900 hover:bg-blue-600 hover:text-white">Check Out</a>
                            </div>
                            <div class="flex justify-center items-end"> 
                                <span class="text-sm font-medium text-gray-400 mr-1">Subtotal:</span> 
                                <span class="text-lg font-bold text-gray-800">£{{ round(Cart::subtotal()/100, 2) }}</span> 
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
