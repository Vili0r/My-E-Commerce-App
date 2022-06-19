<div class="h-full bg-slate-100">
    <div class="py-12 px-4">
        <form wire:submit.prevent="checkout">
            <div class="overflow-hidden sm:rounded-lg grid grid-cols-6 grid-flow-col gap-4">
                <div class="p-6 bg-white border-b border-gray-200 col-span-3 self-start space-y-6">

                    @guest   
                        <div class="space-y-3">
                            <div class="font-semibold text-lg">Account details</div>

                            <div>
                                <label for="email">Email</label>
                                <x-input id="email" class="block mt-1 w-full" type="text" name="email" wire:model.defer="accountForm.email" />

                                @error('accountForm.email')     
                                    <div class="mt-2 font-semibold text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    @endguest

                    <div class="space-y-3">
                        <div class="font-semibold text-lg">Shipping</div>

                        @if($this->userShippingAddresses) 
                            <x-select class="w-full" wire:model="userShippingAddressId">
                                <option value="" disbale >Choose a pre-saved address</option>
                                @foreach ($this->userShippingAddresses as $address)
                                    <option value="{{  $address->id  }}">{{ $address->formattedAddress() }}</option>
                                @endforeach
                            </x-select>
                        @endif

                        <div class="space-y-3">
                            <div>
                                <label for="address">Address</label>
                                <x-input id="address" class="block mt-1 w-full" type="text" name="address" wire:model.defer="shippingForm.address"/>

                                @error('shippingForm.address')     
                                    <div class="mt-2 font-semibold text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-1">
                                    <label for="city">City</label>
                                    <x-input id="city" class="block mt-1 w-full" type="text" name="city" wire:model.defer="shippingForm.city"/>

                                    @error('shippingForm.city')     
                                        <div class="mt-2 font-semibold text-red-500">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-span-1">
                                    <label for="postcode">Postal code</label>
                                    <x-input id="postcode" class="block mt-1 w-full" type="text" name="postcode" wire:model.defer="shippingForm.postcode"/>

                                    @error('shippingForm.postcode')     
                                        <div class="mt-2 font-semibold text-red-500">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="font-semibold text-lg">Delivery</div>

                        <div class="space-y-1">
                            <x-select class="w-full">
                                <option>Shipping type ($0)</option>
                            </x-select>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="font-semibold text-lg">Payment</div>

                        @if(Session::has('stripe_error'))
                            <div class="mt-2 font-semibold text-red-500">
                                {{ Session::get('stripe_error') }}
                            </div>
                        @endif

                        <div class=" p-5 bg-gray-900 hover:bg-gray-700 rounded overflow-visible"> 
                            <span class="text-xl font-medium text-gray-100 block pb-3">Card Details</span> 
                            <span class="text-xs text-gray-400 ">Card Type</span>
                            <div class="overflow-visible flex justify-between items-center mt-2">
                                <div class="rounded w-52 h-28 bg-gray-500 py-2 px-4 relative right-10"> 
                                    <span class="italic text-lg font-medium text-gray-200 underline">VISA</span>
                                    <div class="flex justify-between items-center pt-4 "> 
                                        <span class="text-xs text-gray-200 font-medium">****</span> 
                                        <span class="text-xs text-gray-200 font-medium">****</span> 
                                        <span class="text-xs text-gray-200 font-medium">****</span> 
                                        <span class="text-xs text-gray-200 font-medium">****</span> 
                                    </div>
                                    <div class="flex justify-between items-center mt-3"> 
                                        <span class="text-xs text-gray-200">Giga Tamarashvili</span> 
                                        <span class="text-xs text-gray-200">12/18</span> 
                                    </div>
                                </div>
                                <div class="flex justify-center items-center flex-col"> 
                                    <img src="https://img.icons8.com/color/96/000000/mastercard-logo.png" width="40" class="relative right-5" /> 
                                    <span class="text-xs font-medium text-gray-200 bottom-2 relative right-5">mastercard.</span> 
                                </div>
                            </div>
                            <div class="flex justify-center flex-col pt-3"> 
                                <label class="text-xs text-gray-400 ">Name on Card</label> 
                                <input type="text" name="nameOnCard" wire:model.defer="paymentForm.nameOnCard" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="Giga Tamarashvili"> 
                                @error('paymentForm.nameOnCard')     
                                    <div class="mt-2 font-semibold text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="flex justify-center flex-col pt-3"> 
                                <label class="text-xs text-gray-400 ">Card Number</label> 
                                <input type="text" name="cardNumber" wire:model.defer="paymentForm.cardNumber" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="**** **** **** ****"> 
                                @error('paymentForm.cardNumber')     
                                    <div class="mt-2 font-semibold text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="grid grid-cols-3 gap-2 pt-2 mb-3">
                                <div class="col-span-2 "> 
                                    <label class="text-xs text-gray-400">Expiration Date</label>
                                    <div class="grid grid-cols-2 gap-2"> 
                                        <input type="text" name="expiryMonth" wire:model.defer="paymentForm.expiryMonth" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="mm"> 
                                        @error('paymentForm.expiryMonth')     
                                            <div class="mt-2 font-semibold text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="text" name="expiryYear" wire:model.defer="paymentForm.expiryYear" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="yyyy"> 
                                        @error('paymentForm.expiryYear')     
                                            <div class="mt-2 font-semibold text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class=""> 
                                    <label class="text-xs text-gray-400">CVC</label> 
                                    <input type="text" name="cvc" wire:model.defer="paymentForm.cvc" class="focus:outline-none w-full h-6 bg-gray-800 text-white placeholder-gray-300 text-sm border-b border-gray-600 py-4" placeholder="XXX"> 
                                    @error('paymentForm.cvc')     
                                        <div class="mt-2 font-semibold text-red-500">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-white border-b border-gray-200 col-span-3 self-start space-y-4">
                    @foreach ($cart as $item)
                        <div>
                            <div class="border-b py-3 flex items-start">
                                <div class="w-16 mr-4">
                                    <img src="{{ asset($item->model->product->image) }}" class="w-16">
                                </div>

                                <div class="space-y-2">
                                    <div>
                                        <div class="font-semibold">
                                            {{ $item->model->formattedPrice() }}
                                        </div>
                                        <div class="space-y-1">
                                            <div>{{ $item->model->product->name }}</div>

                                            <div class="flex items-center text-sm">
                                                <div class="mr-1 font-semibold">
                                                    Quantity: {{ $item->qty }} <span class="text-gray-400 mx-1">/</span>
                                                </div>
                                                @foreach ($item->options as $value)
                                                   Sku: {{ $value }} 
                                                   <span class="text-gray-400 mx-1">/</span>
                                                @endforeach
                                                Size: {{ $item->name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="space-y-4">
                        <div class="space-y-1">
                            <div class="space-y-1 flex items-center justify-between">
                                <div class="font-semibold">Subtotal</div>
                                <h1 class="font-semibold">£{{ round(Cart::subtotal()/100, 2) }}</h1>
                            </div>

                            <div class="space-y-1 flex items-center justify-between">
                                <div class="font-semibold">Tax</div>
                                <h1 class="font-semibold">£{{ round(Cart::tax()/100, 2) }}</h1>
                            </div>

                            <div class="space-y-1 flex items-center justify-between">
                                <div class="font-semibold">Free Shipping</div>
                                <h1 class="font-semibold">$0</h1>
                            </div>

                            <div class="space-y-1 flex items-center justify-between">
                                <div class="font-semibold">Total</div>
                                <h1 class="font-semibold">£{{ round(Cart::total()/100, 2) }}</h1>
                            </div>
                        </div>

                        <x-button type="submit">Confirm order and pay</x-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>