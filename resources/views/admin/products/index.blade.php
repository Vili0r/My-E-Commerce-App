<x-admin-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">  
            @can('publish products') 
                <div class="flex justify-end m-2 p-2">
                    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                        Create Product
                    </a>
                </div>      
            @endcan
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-full">
                                <thead class="bg-slate-200">
                                    <tr>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            Name
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            Photo
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            Category
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            Base price
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            Featured
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            Live at
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            In stock
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-left">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)    
                                    <tr class="bg-slate-50 border-b">
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            {{ $product->name }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            <img src="{{ $product->getFirstMediaUrl('products', 'thumb') }}"/>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            @foreach ($product->categories as $category)
                                                {{ $category->name }},
                                            @endforeach
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            {{ $product->formattedPrice() }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            <livewire:products.featured :product="$product" :name="'featured'" :key="'featured'.$product->id" />
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            {{ $product->live_at }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">    
                                            <livewire:products.in-stock :product="$product" :name="'in_stock'" :key="'in_stock'.$product->id" />
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.products.edit', $product) }}" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-700 rounded-lg text-white">
                                                    Edit</a>
                                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
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
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>