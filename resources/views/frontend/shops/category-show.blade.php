<x-guest-layout>
    
    <div class="bg-slate-50 h-full p-6">
        <div class="space-x-1">
            @foreach ($category->ancestors->reverse() as $ancestor)    
                <a href="{{ route('shop.category.show', $ancestor->slug) }}" class="text-indigo-500">
                    {{ $ancestor->name }}
                </a>
                <span class="font-bold text-gray-300 last:hidden">/</span>
            @endforeach
        </div>
    
        <h2 class="mt-1 font-semibold text-xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>

        <livewire:front-end.product-browser :category="$category" />

    </div>    
</x-guest-layout>