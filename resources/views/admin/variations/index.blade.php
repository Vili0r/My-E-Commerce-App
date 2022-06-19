<x-admin-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> 
            <div class="flex justify-end m-2 p-2">
                @can('create')
                    <a href="{{ route('admin.variations.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                        Create Variation
                    </a>
                @endcan  
            </div>       
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
                                            Title
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase">
                                            Created at
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-left">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($variations as $key => $variation)    
                                        <tr class="bg-slate-50 border-b">
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap">
                                                {{ $key + 1 }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                                {{ $variation->title }}
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-700 whitespace-nowrap">
                                                {{ $variation->created_at }}
                                            </td>
                                            <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                                <div class="flex space-x-2">
                                                    @can('edit')
                                                        <a href="{{ route('admin.variations.edit', $variation) }}" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-700 rounded-lg text-white"
                                                        >Edit</a>
                                                    @endcan

                                                    @can('edit')
                                                        <form method="POST" action="{{ route('admin.variations.destroy', $variation) }}">
                                                            @csrf
                                                            @method('DELETE')
        
                                                            <button class="bg-red-500 hover:bg-red-700 px-4 py-2 text-white rounded-lg" onclick="return confirm('Are you sure?')" type="submit">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-2">
                        {{ $variations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-admin-layout>