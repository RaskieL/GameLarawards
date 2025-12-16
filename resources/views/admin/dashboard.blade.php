<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            
            <div class="flex space-x-3">
                <a href="{{ route('games.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Manage Games') }}
                </a>

                <button x-data="" x-on:click="$dispatch('open-modal', 'create-category-modal')" 
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <span class="mr-1 text-base">+</span> {{ __('Add Category') }}
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center" role="alert">
                    <div><span class="font-bold">Success:</span> {{ session('success') }}</div>
                    <button type="button" class="text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">
                        &times;
                    </button>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                    <x-category-card :category="$category">
                        <x-slot name="actions">
                            <a href="{{ route('categories.edit', $category) }}" 
                               class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-full transition-colors dark:hover:bg-gray-700 dark:hover:text-indigo-400" 
                               title="{{ __('Edit') }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>

                            <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-full transition-colors dark:hover:bg-gray-700 dark:hover:text-red-400" 
                                        onclick="return confirm('Are you sure you want to delete this category?')" 
                                        title="{{ __('Delete') }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </x-slot>
                    </x-category-card>
                @endforeach
            </div>

            @if($categories->isEmpty())
                <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow-sm mt-4">
                    <p class="text-gray-500 dark:text-gray-400 text-lg">No categories found.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>