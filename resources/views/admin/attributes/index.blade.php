<x-admin-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">  
            @can('publish products') 
                <div class="flex justify-end m-2 p-2">
                    <a href="{{ route('admin.attributes.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                        Create Product Attribute
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
                                            Product
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            Title
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            Type
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700">
                                            Parent Attribute id
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            Price
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            SKU
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            Stock
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-left">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attributes as $attribute)    
                                    <tr class="bg-slate-50 border-b">
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            <a href="{{ route('admin.attributes.show', $attribute) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                {{ $attribute->product?->name }}</a>
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            {{ $attribute->title }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            {{ $attribute->type }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            {{ $attribute->parent_id }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            {{ $attribute->formattedPrice() }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            {{ $attribute->sku }}
                                        </td>
                                        <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                            @if($attribute->stocks->count())
                                                {{ $attribute->stocks->sum('amount') }}
                                            @else
                                                No stock availbale, please edit
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.attributes.edit', $attribute) }}" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-700 rounded-lg text-white">
                                                    Edit</a>
                                                <form method="POST" action="{{ route('admin.attributes.destroy', $attribute) }}">
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
                        {{ $attributes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>