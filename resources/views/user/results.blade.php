<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter uppercase bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent animate-pulse">
                    GOTY <span class="text-purple-600">Results</span>
                </h2>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mt-1">
                    See who won this year's awards based on community votes.
                </p>
            </div>
            
            <div class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 p-1 rounded-2xl flex items-center shadow-lg shadow-purple-500/20">
                <div class="px-4 py-2 bg-white dark:bg-gray-700 rounded-xl shadow-sm border border-gray-200 dark:border-gray-600 transition-all hover:shadow-md">
                    <span class="text-xs font-bold text-gray-400 uppercase block leading-none">Total Votes</span>
                    <span class="text-xl font-black text-purple-600 dark:text-purple-400">
                        {{ $categories->sum(fn($cat) => $cat->games->sum('votes_count')) }}
                    </span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            @foreach($categories as $category)
                <section class="relative" aria-labelledby="results-category-{{ $category->id }}">
                    <div class="flex items-end justify-between mb-4 px-2">
                        <div>
                            <span class="text-[10px] font-bold text-purple-600 uppercase tracking-[0.2em]">Category</span>
                            <h3 id="results-category-{{ $category->id }}" class="text-2xl font-black text-gray-800 dark:text-gray-100 leading-none uppercase bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                                {{ $category->name }}
                            </h3>
                        </div>
                        <span class="text-[10px] font-black bg-gradient-to-r from-purple-500 to-blue-500 text-white px-3 py-1 rounded-full shadow-lg">
                            {{ $category->games->sum('votes_count') }} Votes
                        </span>
                    </div>

                    <div class="space-y-4">
                        @foreach($category->games as $index => $game)
                            <div class="relative flex items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-lg transition-all duration-300 hover:scale-[1.02] {{ $index === 0 ? 'ring-4 ring-purple-500/20 shadow-xl shadow-purple-500/30' : '' }}">
                                <!-- Ranking Badge -->
                                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-r from-purple-500 to-blue-500 text-white rounded-full flex items-center justify-center font-black text-lg shadow-lg">
                                    {{ $index + 1 }}
                                </div>

                                <!-- Game Image -->
                                <div class="flex-shrink-0 w-16 h-16 overflow-hidden rounded-xl">
                                    <img src="{{ asset('storage/' . $game->cover_image) }}" 
                                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-110" 
                                         alt="{{ $game->title }}">
                                </div>

                                <!-- Game Details -->
                                <div class="flex-grow">
                                    <h4 class="font-black text-gray-900 dark:text-white text-lg leading-tight mb-1">
                                        {{ $game->title }}
                                    </h4>
                                    <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-2">
                                        {{ $game->developer }}
                                    </p>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-bold text-purple-600 dark:text-purple-400">
                                            {{ $game->votes_count }} votes
                                        </span>
                                        @if($index === 0)
                                            <span class="text-xs font-black bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-2 py-1 rounded-full animate-pulse">
                                                Winner 
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="flex-shrink-0 w-20">
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-purple-500 to-blue-500 h-2 rounded-full transition-all duration-500" 
                                             style="width: {{ $category->games->sum('votes_count') > 0 ? ($game->votes_count / $category->games->sum('votes_count')) * 100 : 0 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        <!-- Global Stats -->
        <div class="mt-12 p-6 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 rounded-2xl shadow-lg">
            <h3 class="text-xl font-black text-gray-900 dark:text-white mb-4 uppercase tracking-tighter">Global Statistics</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="text-center">
                    <span class="text-2xl font-black text-purple-600 dark:text-purple-400">{{ $categories->count() }}</span>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Categories</p>
                </div>
                <div class="text-center">
                    <span class="text-2xl font-black text-purple-600 dark:text-purple-400">{{ $categories->sum(fn($cat) => $cat->games->count()) }}</span>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Games</p>
                </div>
                <div class="text-center">
                    <span class="text-2xl font-black text-purple-600 dark:text-purple-400">{{ $categories->sum(fn($cat) => $cat->games->sum('votes_count')) }}</span>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Votes</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-0 left-0 right-0 z-50 p-4 transform transition-transform duration-500">
        <div class="max-w-4xl mx-auto bg-gradient-to-r from-gray-900/95 to-black/95 dark:from-black/95 dark:to-gray-900/95 backdrop-blur-md text-white rounded-2xl shadow-2xl border border-white/10 p-4 md:p-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="hidden md:block p-3 bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl shadow-lg">
                        <svg class="w-6 h-6 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <div class="text-center md:text-left">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em]">Results Overview</p>
                        <p class="text-lg font-black italic">
                            Community Choice Awards
                        </p>
                    </div>
                </div>
                
                <div class="flex gap-2 w-full md:w-auto">
                    <a href="{{ route('user.index') }}" class="flex-1 md:flex-none text-center px-6 py-3 bg-gradient-to-r from-white/10 to-white/20 hover:from-white/20 hover:to-white/30 rounded-xl font-bold transition-all uppercase text-xs tracking-widest border border-white/10 hover:border-white/20 focus:outline-none focus:ring-2 focus:ring-white/50">
                        Back to Voting
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>