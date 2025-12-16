<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('games.update', $game) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $game->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Developer -->
                        <div class="mt-4">
                            <x-input-label for="developer" :value="__('Developer')" />
                            <x-text-input id="developer" class="block mt-1 w-full" type="text" name="developer" :value="old('developer', $game->developer)" required />
                            <x-input-error :messages="$errors->get('developer')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('description', $game->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Cover Image -->
                        <div class="mt-4">
                            <x-input-label for="cover_image" :value="__('Cover Image')" />
                            @if($game->cover_image)
                                <div class="mb-2">
                                    <img src="{{ str_starts_with($game->cover_image, 'http') ? $game->cover_image : asset('storage/' . $game->cover_image) }}" alt="Cover Image" class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif
                            <input id="cover_image" type="file" name="cover_image" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            <x-input-error :messages="$errors->get('cover_image')" class="mt-2" />
                        </div>

                        <!-- Categories -->
                        <div class="mt-4">
                            <x-input-label for="categories" :value="__('Categories')" />
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                                @foreach($categories as $category)
                                    <div class="flex items-center">
                                        <input id="category_{{ $category->id }}" type="checkbox" value="{{ $category->id }}" name="categories[]" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{ $game->categories->contains($category->id) ? 'checked' : '' }}>
                                        <label for="category_{{ $category->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
