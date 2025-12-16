@props(['category', 'href' => null])

<div class="group bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-xl transition-all duration-300 h-full flex flex-col justify-between border-l-4 border-indigo-500 dark:border-indigo-400 relative">
    
    <div class="p-6">
        <div class="flex justify-between items-start mb-3">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
                @if($href)
                    <a href="{{ $href }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                        {{ $category->name }}
                    </a>
                @else
                    {{ $category->name }}
                @endif
            </h3>

            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                {{ $category->games_count ?? 0 }} {{ ($category->games_count == 1) ? ('jeu') : ('jeux') }}
            </span>
        </div>

        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed line-clamp-3">
            {{ $category->description ?? 'No description available.' }}
        </p>
    </div>

    @if (isset($actions))
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3 opacity-90 group-hover:opacity-100 transition-opacity">
            {{ $actions }}
        </div>
    @endif
</div>