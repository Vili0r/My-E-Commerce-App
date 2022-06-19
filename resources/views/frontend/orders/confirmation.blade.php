<x-guest-layout>
    <div class="h-full bg-slate-100">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Your order (#{{ $order->id }}) has been placed.
    
                        <a href="{{ route('register') }}" class="text-indigo-500">Create an account</a> to manage your order.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>