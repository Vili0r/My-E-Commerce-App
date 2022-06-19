<x-admin-layout>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.attributes.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                    Product attribute index
                </a>
            </div>
            @can('create')
            
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-gray-50 border-b border-gray-200">
                    
                        <form method="POST" action="{{ route('admin.attributes.store') }}">
                            @csrf

                            <!-- Product -->
                            <div>
                                <label class="block font-medium text-medium text-gray-700 mt-4">
                                    {{ __('Select your Product:') }}
                                </label>
                                
                                <select name="product_id" id="product_id" class="block mt-1 mb-4 rounded-md w-full">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            
                           <!-- Parent Variation -->
                           <div>
                                <label class="block font-medium text-medium text-gray-700 mt-4">
                                    {{ __('Note: Select Parent only for product attributes:') }}
                                </label>

                                <select name="parent_id" id="parent_id" class="block mt-1 mb-4 rounded-md w-full">
                                    <option value="">Select Parent Variation</option>
                                    @foreach ($attributes as $parentAttribute)
                                        <option value="{{ $parentAttribute->id }}">{{ $parentAttribute->title }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Title -->
                            <div>
                                <label class="block font-medium text-medium text-gray-700 mt-4">
                                    {{ __('Title:') }}
                                </label>

                                <x-input id="title" class="block mt-1 w-full rounded" type="text" name="title" :value="old('title')" required autofocus />
                                @error('title')
                                    <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Variation -->
                            <div>
                                <label class="block font-medium text-medium text-gray-700 mt-4">
                                    {{ __('Select your Type:') }}
                                </label>
                                
                                <div class="flex justify-between">
                                    <select name="type" id="type" class="block mt-1 mb-4 rounded-md w-full">
                                        <option value="">Select Variation</option>
                                        @foreach ($variations as $variation)
                                            <option value="{{ $variation->title }}">{{ $variation->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Price -->
                            <div>
                                <label class="block font-medium text-medium text-gray-700 mt-4">
                                    {{ __('Enter Price in cents:') }}
                                </label>

                                <input id="price" class="block mt-1 w-1/2 rounded" type="text" name="price" :value="old('price')" autofocus />
                                
                                @error('price')
                                    <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- SKU -->
                            <div>
                                <label class="block font-medium text-medium text-gray-700 mt-4">
                                    {{ __('SKU:') }}
                                </label>

                                <input id="sku" class="block mt-1 w-1/2 rounded" type="text" name="sku" :value="old('sku')" autofocus />
                                
                                @error('sku')
                                    <div class="alert alert-danger mt-3 text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div> 
                            
                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    {{ __('Store') }}
                                </x-button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            @endcan
        </div>
    </div>
    
</x-admin-layout>
