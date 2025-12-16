<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Back') }}
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Manage Games') }}
                </h2>
            </div>
            
            <div class="flex space-x-3">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Manage Categories') }}
                </a>

                <button x-data="" x-on:click="$dispatch('open-modal', 'create-game-modal')" 
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <span class="mr-1 text-base">+</span> {{ __('Add Game') }}
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

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-t-4 border-indigo-500">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-20">
                                    {{ __('Cover') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Game Info') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Nominations') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($games as $game)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="h-12 w-12 rounded bg-gray-200 flex-shrink-0 overflow-hidden border border-gray-300 dark:border-gray-600">
                                            @if($game->cover_image)
                                                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $game->cover_image) }}" alt="{{ $game->title }}">
                                            @else
                                                <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $game->title }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $game->developer }}</div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1">
                                            @forelse($game->categories as $category)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200 border border-indigo-200 dark:border-indigo-800">
                                                    {{ $category->name }}
                                                </span>
                                            @empty
                                                <span class="text-xs text-gray-400 italic">No nominations</span>
                                            @endforelse
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('games.edit', $game) }}" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-full transition-colors dark:hover:bg-gray-700 dark:hover:text-indigo-400" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </a>
                                            <form method="POST" action="{{ route('games.destroy', $game) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-full transition-colors dark:hover:bg-gray-700 dark:hover:text-red-400" onclick="return confirm('Are you sure you want to delete this game?')" title="Delete">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                        <p class="text-lg">No games found.</p>
                                        <p class="text-sm">Start by adding a new game to the list.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $games->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-game-modal" focusable>
        <form method="post" action="{{ route('games.store') }}" class="p-6" enctype="multipart/form-data">
            @csrf
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 border-b pb-2">
                {{ __('Add New Game') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Game Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required placeholder="e.g. Elden Ring" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="developer" :value="__('Developer')" />
                        <x-text-input id="developer" class="block mt-1 w-full" type="text" name="developer" required placeholder="e.g. FromSoftware" />
                        <x-input-error :messages="$errors->get('developer')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="cover_image" :value="__('Cover Image')" />
                        <input type="file" id="cover_image" name="cover_image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 mt-1"/>
                        <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-2">Nominations</label>
                        <div class="bg-gray-50 dark:bg-gray-900 p-3 rounded border border-gray-200 dark:border-gray-700 max-h-48 overflow-y-auto">
                            @if(isset($categories) && count($categories) > 0)
                                @foreach($categories as $category)
                                    <div class="flex items-center mb-2 last:mb-0">
                                        <input type="checkbox" id="cat_{{ $category->id }}" name="categories[]" value="{{ $category->id }}" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                        <label for="cat_{{ $category->id }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300 cursor-pointer select-none">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-xs text-gray-500">No categories found.</p>
                            @endif
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-primary-button>
                    {{ __('Save Game') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>