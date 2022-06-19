<x-admin-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                    Product Index
                </a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label class="block font-medium text-medium text-gray-700 mt-4">
                                {{ __('Name:') }}
                            </label>

                            <x-input id="name" class="block mt-1 w-full rounded" type="text" name="name" :value="old('name')" required autofocus />
                            
                            @error('name')
                                <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                       <!-- Description -->
                        <div>
                            <label class="block font-medium text-medium text-gray-700 mt-4">
                                {{ __('Description:') }}
                            </label>

                            <textarea id="description" type="text" name="description" rows="4" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write a description..."></textarea>
                            
                            @error('description')
                                <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="block font-medium text-medium text-gray-700 mt-4">
                                {{ __('Enter Price in cents:') }}
                            </label>

                            <input id="price" class="block mt-1 w-full rounded" type="text" name="price" :value="old('price')" autofocus />
                            
                            @error('price')
                                <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Category -->
                        <div>
                            <label class="block font-medium text-medium text-gray-700 mt-4">
                                {{ __('Select Categories for your Product:') }}
                            </label>
                            
                            <select name="categories[]" id="" multiple x-data="{}" x-init="function () { choices($el) }" 
                                class="block mt-1 mb-4 rounded-md w-full">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @error('categories')
                            <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Tag -->
                        <div>
                            
                            <label for="tags" class="block font-medium text-medium text-gray-700 mt-4">
                                {{ __('Select Tags for your Product:') }}
                            </label>
                            
                            <select name="tags[]" id="" multiple x-data="{}" x-init="function () { choices($el) }" 
                                class="block mt-1 mb-4 rounded-md w-full">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>

                            @error('tags')
                                <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Live at -->
                        <div>
                            <label class="block font-medium text-medium text-gray-700 mt-4">
                                {{ __('Live at:') }}
                            </label>
                            <input type="date" name="live_at" class="rounded"/>
                            
                            @error('live_at')
                                <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Photos -->
                        <div>
                            <label class="block font-medium text-medium text-gray-700 mt-4">
                                {{ __('Photo 1:') }}
                            </label>

                            <input type="file" name="photo1" />
                        </div>

                        <div>
                            <label class="block font-medium text-medium text-gray-700 mt-4">
                                {{ __('Photo 2:') }}
                            </label>

                            <input type="file" name="photo2" />
                        </div>

                        <div>
                            <label class="block font-medium text-medium text-gray-700 mt-4">
                                {{ __('Photo 3:') }}
                            </label>

                            <input type="file" name="photo3" />
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Store') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</x-admin-layout>