<div>
    <a href="{{ route('shop.category.show', $category->slug) }}" class="block text-gray-500 hover:underline {{ $category->depth == 0 ? 'font-bold' : 'font-medium' }}">{{ $category->name }}</a> 
    @foreach ($category->children as $child)
        <div class="ml-4">
            <x-category-item :category="$child" />
        </div>
    @endforeach
</div>