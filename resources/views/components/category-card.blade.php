@props(['category', 'href' => null])

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-300 h-full flex flex-col justify-between">
    <div class="p-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
            @if($href)
                <a href="{{ $href }}" class="hover:underline">
                    {{ $category->name }}
                </a>
            @else
                {{ $category->name }}
            @endif
        </h3>
        <p class="text-gray-600 dark:text-gray-400 text-sm">
            {{ Str::limit($category->description, 100) }}
        </p>
        <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
            {{ $category->games_count }} {{ Str::plural('game', $category->games_count) }}
        </div>
    </div>
    @if (isset($actions))
        <div class="px-6 pb-6 flex justify-end space-x-2">
            {{ $actions }}
        </div>
    @endif
</div>
