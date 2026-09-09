<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YouTube Video Search - {{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-slate-100 font-sans antialiased min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Header -->
        <header class="flex flex-col sm:flex-row justify-between items-center mb-10 pb-6 border-b border-slate-800 gap-4">
            <div class="flex items-center gap-3">
                <div class="bg-red-600 text-white p-3 rounded-2xl shadow-lg shadow-red-600/30">
                    <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-wide">YouTube Search</h1>
                    <p class="text-xs text-slate-400">Integrated with YouTube Data API v3</p>
                </div>
            </div>

            <!-- Search Form -->
            <form action="{{ route('youtube.index') }}" method="GET" class="w-full sm:w-auto flex items-center gap-2">
                <div class="relative w-full sm:w-80">
                    <input type="text" name="q" value="{{ $query }}" placeholder="Search videos..." 
                           class="w-full bg-slate-800 border border-slate-700 text-white pl-4 pr-10 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm transition">
                </div>
                <button type="submit" class="bg-red-600 hover:bg-red-500 text-white px-5 py-2.5 rounded-xl font-medium text-sm transition shadow-lg shadow-red-600/20 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Search
                </button>
            </form>
        </header>

        <!-- Flash Messages -->
        @if(session('error'))
            <div class="mb-6 bg-red-950/50 border border-red-800 text-red-300 px-4 py-3 rounded-xl text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Video Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($videos as $video)
                @php
                    $videoId = $video['id']['videoId'] ?? null;
                    $snippet = $video['snippet'] ?? [];
                    $thumbnail = $snippet['thumbnails']['high']['url'] ?? ($snippet['thumbnails']['medium']['url'] ?? '');
                @endphp

                @if($videoId)
                    <div class="bg-slate-800/80 border border-slate-700/60 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:border-slate-600 transition group flex flex-col">
                        <a href="{{ route('youtube.show', $videoId) }}" class="relative block overflow-hidden">
                            <img src="{{ $thumbnail }}" alt="{{ $snippet['title'] }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <div class="bg-red-600 text-white p-3 rounded-full shadow-lg">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-semibold text-white text-base line-clamp-2 leading-snug group-hover:text-red-400 transition">
                                    <a href="{{ route('youtube.show', $videoId) }}">
                                        {!! html_entity_decode($snippet['title']) !!}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-400 mt-2 font-medium">{{ $snippet['channelTitle'] ?? '' }}</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-700/50 flex justify-between items-center text-xs text-slate-500">
                                <span>{{ isset($snippet['publishedAt']) ? \Carbon\Carbon::parse($snippet['publishedAt'])->diffForHumans() : '' }}</span>
                                <a href="{{ route('youtube.show', $videoId) }}" class="text-red-400 hover:text-red-300 font-semibold flex items-center gap-1">
                                    Watch
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-span-full py-16 text-center text-slate-400">
                    <svg class="w-16 h-16 mx-auto mb-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-lg font-medium">No videos found</p>
                    <p class="text-sm text-slate-500 mt-1">Try searching for something else above.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
