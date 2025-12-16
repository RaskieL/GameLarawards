@props(['category'])

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-300">
    <div class="p-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
            {{ $category->name }}
        </h3>
        <p class="text-gray-600 dark:text-gray-400">
            {{ $category->description }}
        </p>
        @if (isset($actions))
            <div class="mt-4 flex justify-end space-x-2">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>
