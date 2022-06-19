<x-admin-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                    Category Index
                </a>
            </div>

            @can('edit')
                
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    
                    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                        @csrf
                        @method('PUT')

                        <!-- Parent category -->
                        <div>
                            <label class="block font-medium text-medium text-gray-700 mt-4">
                                {{ __('Note: Select Parent only for subcategory:') }}
                            </label>

                            <select name="parent_id" id="" class="block mt-1 mb-4 rounded-md w-full">
                                @foreach ($categories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}" @selected(old('parentCategory') == $parentCategory)>
                                        {{ $parentCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div>
                            <label class="block font-medium text-medium text-gray-700 mt-4">
                                {{ __('Name:') }}
                            </label>

                            <x-input id="name" class="block mt-1 w-full rounded" type="text" name="name" :value="$category->name" required autofocus />
                            
                            @error('name')
                                <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block font-medium text-medium text-gray-700 mt-4">
                                {{ __('Description:') }}
                            </label>

                            <textarea id="description" type="text" name="description" rows="4" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write a description...">
                                {{ $category->description }}</textarea>

                            @error('description')
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