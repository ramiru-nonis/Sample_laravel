<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{!! html_entity_decode($video['snippet']['title'] ?? 'Watch Video') !!} - YouTube</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-slate-100 font-sans antialiased min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Link -->
        <a href="{{ route('youtube.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 hover:text-white mb-6 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Search
        </a>

        <!-- Video Player -->
        <div class="relative w-full aspect-video bg-black rounded-2xl overflow-hidden shadow-2xl mb-6">
            <iframe class="absolute inset-0 w-full h-full" 
                    src="https://www.youtube.com/embed/{{ $video['id'] }}?autoplay=1" 
                    title="{!! html_entity_decode($video['snippet']['title'] ?? '') !!}" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
            </iframe>
        </div>

        <!-- Details -->
        <div class="bg-slate-800/80 border border-slate-700/60 rounded-2xl p-6 shadow-xl">
            <h1 class="text-xl sm:text-2xl font-bold text-white mb-3">
                {!! html_entity_decode($video['snippet']['title'] ?? '') !!}
            </h1>

            <div class="flex flex-wrap items-center justify-between border-b border-slate-700/60 pb-4 mb-4 gap-4 text-sm text-slate-400">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-slate-200">{{ $video['snippet']['channelTitle'] ?? '' }}</span>
                </div>
                <div class="flex items-center gap-4">
                    @if(isset($video['statistics']['viewCount']))
                        <span>👁️ {{ number_format($video['statistics']['viewCount']) }} views</span>
                    @endif
                    @if(isset($video['statistics']['likeCount']))
                        <span>👍 {{ number_format($video['statistics']['likeCount']) }} likes</span>
                    @endif
                    <span>📅 {{ \Carbon\Carbon::parse($video['snippet']['publishedAt'])->format('M d, Y') }}</span>
                </div>
            </div>

            <!-- Description -->
            <div class="text-sm text-slate-300 whitespace-pre-line leading-relaxed">
                {{ $video['snippet']['description'] ?? 'No description available.' }}
            </div>
        </div>
    </div>
</body>
</html>
