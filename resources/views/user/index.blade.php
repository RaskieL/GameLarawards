<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter uppercase bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent animate-pulse">
                    The <span class="text-purple-600">GOTY</span> Awards
                </h2>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mt-1">
                    Your vote decides who made history this year.
                </p>
            </div>
            
            <div class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 p-1 rounded-2xl flex items-center shadow-lg shadow-purple-500/20">
                <div class="px-4 py-2 bg-white dark:bg-gray-700 rounded-xl shadow-sm border border-gray-200 dark:border-gray-600 transition-all hover:shadow-md">
                    <span class="text-xs font-bold text-gray-400 uppercase block leading-none">Votes Cast</span>
                    <span class="text-xl font-black text-purple-600 dark:text-purple-400">
                        {{ count($userVotes) }} <span class="text-gray-300 dark:text-gray-500 text-sm">/ {{ $categories->count() }}</span>
                    </span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto px-4">
        
        <div class="mb-12">
            <div class="w-full bg-gradient-to-r from-gray-200 to-gray-300 dark:from-gray-800 dark:to-gray-700 rounded-full h-2 mb-2 shadow-inner">
                <div class="bg-gradient-to-r from-purple-500 to-blue-500 h-2 rounded-full transition-all duration-1000 shadow-[0_0_15px_rgba(147,51,234,0.5)] animate-pulse" 
                     style="width: {{ $categories->count() > 0 ? (count($userVotes) / $categories->count()) * 100 : 0 }}%"></div>
            </div>
        </div>

        <div class="space-y-16">
            @foreach($categories as $category)
                @php
                    $votedGameId = $userVotes[$category->id] ?? null;
                @endphp
                
                <section class="relative" aria-labelledby="category-{{ $category->id }}">
                    <div class="flex items-end justify-between mb-6 px-2">
                        <div>
                            <span class="text-[10px] font-bold text-purple-600 uppercase tracking-[0.2em]">Category</span>
                            <h3 id="category-{{ $category->id }}" class="text-3xl font-black text-gray-800 dark:text-gray-100 leading-none uppercase bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                                {{ $category->name }}
                            </h3>
                        </div>
                        @if($votedGameId)
                            <span class="text-xs font-black bg-green-500 text-light-gray dark:text-white px-4 py-1.5 rounded-full shadow-[0_0_15px_rgba(34,197,94,0.6)] border-2 border-black dark:border-white animate-pulse">COMPLETE</span>
                        @endif
                    </div>

                    <div class="flex overflow-x-auto pb-8 gap-6 snap-x snap-mandatory scrollbar-thin scrollbar-thumb-purple-500 scrollbar-track-gray-200 dark:scrollbar-track-gray-700 -mx-4 px-4 md:mx-0 md:px-0">
                        @foreach($category->games as $game)
                            <div class="w-[85vw] sm:w-[400px] snap-center shrink-0">
                                <form method="POST" action="{{ route('user.store') }}" class="h-full">
                                    @csrf
                                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                                    <input type="hidden" name="game_id" value="{{ $game->id }}">
                                    
                                    <button type="submit" @disabled($votedGameId && $votedGameId != $game->id)
                                        class="relative w-full h-full text-left group overflow-hidden rounded-2xl border-2 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-purple-500/50
                                        {{ $votedGameId == $game->id 
                                            ? 'border-purple-500 bg-gradient-to-br from-purple-50 to-blue-50 dark:from-purple-900/20 dark:to-blue-900/20 ring-4 ring-purple-500/20 shadow-xl shadow-purple-500/30' 
                                            : 'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:border-purple-400 dark:hover:border-purple-500 hover:shadow-lg hover:shadow-purple-500/20' }}
                                        {{ $votedGameId && $votedGameId != $game->id ? 'opacity-40 grayscale scale-[0.98]' : 'hover:scale-[1.02] hover:rotate-1' }}"
                                        aria-label="Vote for {{ $game->title }}">
                                        
                                        <div class="flex flex-col h-full">
                                            <div class="aspect-[16/9] overflow-hidden relative">
                                                <img src="{{ asset('storage/' . $game->cover_image) }}" 
                                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 group-hover:brightness-110" 
                                                     alt="{{ $game->title }}">
                                                
                                                @if($votedGameId == $game->id)
                                                    <div class="absolute inset-0 bg-gradient-to-br from-purple-600/30 to-blue-600/30 backdrop-blur-[2px] flex items-center justify-center animate-fade-in">
                                                        <div class="bg-white text-purple-600 rounded-full p-3 shadow-xl animate-pulse">
                                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="p-4 flex-grow flex flex-col justify-between">
                                                <div>
                                                    <h4 class="font-black text-gray-900 dark:text-white text-lg leading-tight mb-1 group-hover:text-purple-600 transition-colors duration-300 line-clamp-2">
                                                        {{ $game->title }}
                                                    </h4>
                                                    <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">
                                                        {{ $game->developer }}
                                                    </p>
                                                </div>

                                                @if($votedGameId == $game->id)
                                                    <div class="mt-4 pt-4 border-t border-purple-200 dark:border-purple-800">
                                                        <span class="text-xs font-black text-purple-600 dark:text-purple-400 flex items-center gap-1 uppercase animate-pulse">
                                                            <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                                            Vote Confirmed
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    @if($votedGameId)
                        <div class="mt-4 flex justify-end">
                            <form method="POST" action="{{ route('user.clear-vote', $category->id) }}">
                                @csrf @method('DELETE')
                                <button type="submit" class="group flex items-center gap-2 text-[10px] font-black text-gray-400 hover:text-red-500 transition-colors uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-red-500 rounded" aria-label="Change vote for {{ $category->name }}">
                                    <svg class="w-3 h-3 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Change My Selection
                                </button>
                            </form>
                        </div>
                    @endif
                </section>
            @endforeach
        </div>
    </div>

    <div class="bottom-0 left-0 right-0 z-50 p-4 transform transition-transform duration-500">
        <div class="max-w-4xl mx-auto bg-gradient-to-r from-gray-900/95 to-black/95 dark:from-black/95 dark:to-gray-900/95 backdrop-blur-md text-white rounded-2xl shadow-2xl border border-white/10 p-4 md:p-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="hidden md:block p-3 bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl shadow-lg">
                        <svg class="w-6 h-6 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                    <div class="text-center md:text-left">
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em]">Voting Status</p>
                        <p class="text-lg font-black italic">
                            {{ count($userVotes) === $categories->count() ? 'READY FOR THE AWARDS!' : 'CATEGORIES STILL PENDING' }}
                        </p>
                    </div>
                </div>
                
                <div class="flex gap-2 w-full md:w-auto">
                    <a href="{{ route('user.results') }}" class="flex-1 md:flex-none text-center px-6 py-3 bg-gradient-to-r from-white/10 to-white/20 hover:from-white/20 hover:to-white/30 rounded-xl font-bold transition-all uppercase text-xs tracking-widest border border-white/10 hover:border-white/20 focus:outline-none focus:ring-2 focus:ring-white/50">
                        Results
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>