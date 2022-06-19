<x-admin-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.variations.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                    Variation Index
                </a>
            </div>
            @can('edit')  
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-gray-50 border-b border-gray-200">

                        <form method="POST" action="{{ route('admin.variations.update', $variation) }}">
                            @csrf
                            @method('PUT')

                            <!-- Title -->
                            <div>
                                <label class="block font-medium text-medium text-gray-700 mt-4">
                                    {{ __('Title:') }}
                                </label>

                                <x-input id="title" class="block mt-1 w-full rounded" type="text" name="title" :value="$variation->title" required autofocus />

                                @error('title')
                                <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    {{ __('Update') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            @endcan
        </div>
    </div>
    
</x-admin-layout>