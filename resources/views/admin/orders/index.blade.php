<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-md sm:rounded-lg">
                    <table class="min-w-full">
                        <thead class="bg-slate-200">
                            <tr>
                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                    #
                                </th>
                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                    Buyer's Email
                                </th>
                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                    Subtotal
                                </th>
                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                    Placed at
                                </th>
                                <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                    Status
                                </th>
                                <th scope="col" class="py-3 px-6 text-left">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)    
                            <tr class="bg-slate-50 border-b">
                                <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $order->id }}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $order->email }}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $order->subtotal }}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $order->placed_at }}
                                </td>
                                <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                    {{ $order->presenter()->status() }}
                                </td>
                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <button onclick='Livewire.emit("openModal", "edit-order", {{ json_encode([$order]) }})' 
                                            class="px-4 py-2 bg-yellow-500 hover:bg-yellow-700 rounded-lg text-white">
                                            Edit
                                        </button>
                                        <form method="POST" action="{{ route('admin.orders.destroy', $order) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button class="bg-red-500 hover:bg-red-700 px-4 py-2 text-white rounded-lg" onclick="return confirm('Are you sure?')" type="submit">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-2">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>

</x-admin-layout>