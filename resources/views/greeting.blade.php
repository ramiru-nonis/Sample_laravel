<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Greeting - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                body {
                    font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                }
            </style>
        @endif
    </head>
    <body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 lg:p-8 items-center justify-center min-h-screen flex-col">
        <main class="w-full max-w-xl bg-white border border-[#e3e3e0] rounded-lg p-8 shadow-sm">
            <h1 class="text-2xl font-semibold mb-4">Hello & Welcome!</h1>
            <p class="text-[#706f6c] mb-6">
                Have a great day ahead!
            </p>
            <a href="{{ url('/') }}" class="inline-block px-5 py-2 border border-[#19140035] hover:border-[#1915014a] rounded-sm text-sm font-medium">
                &larr; Back to Home
            </a>
        </main>
    </body>
</html>
