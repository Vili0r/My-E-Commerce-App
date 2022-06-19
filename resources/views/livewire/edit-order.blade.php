<div class="py-6 px-4">
    <form wire:submit.prevent="update">

        <div class="space-y-6">
            {{-- Order Status --}}
            <div>
                <span class="mb-3">{{ __('Choose the status of the order:') }}</span> 
                <x-select class="w-full mt-2" wire:model="selectedStatus">
                    <option value="">{{ $order->presenter()->status() }}</option>
                    <option value="1">
                        Order Packaged
                    </option>
                    <option value="2">
                        Order Shipped
                    </option>
                </x-select>
            </div>

            <div class="flex justify-end mt-6">
                <x-button>
                    {{ __('Update') }}
                </x-button>
            </div>
        </div>
    </form>
</div>