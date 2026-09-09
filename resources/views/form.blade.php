<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>User Registration - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                *, ::after, ::before {
                    box-sizing: border-box;
                    margin: 0;
                    padding: 0;
                }
                body {
                    font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                    background-color: #FDFDFC;
                    color: #1b1b18;
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 1.5rem;
                }
                @media (prefers-color-scheme: dark) {
                    body {
                        background-color: #0a0a0a;
                        color: #EDEDEC;
                    }
                    .card {
                        background-color: #161615 !important;
                        border-color: #3E3E3A !important;
                    }
                    .input-field {
                        background-color: #1f1f1e !important;
                        border-color: #3E3E3A !important;
                        color: #EDEDEC !important;
                    }
                    .input-field:focus {
                        border-color: #ffffff !important;
                    }
                    .muted-text {
                        color: #A1A09A !important;
                    }
                }
                .card {
                    width: 100%;
                    max-width: 460px;
                    background-color: #ffffff;
                    border: 1px solid #e3e3e0;
                    border-radius: 0.75rem;
                    padding: 2rem;
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
                }
                .title {
                    font-size: 1.5rem;
                    font-weight: 600;
                    margin-bottom: 0.5rem;
                }
                .muted-text {
                    color: #706f6c;
                    font-size: 0.875rem;
                    margin-bottom: 1.5rem;
                }
                .form-group {
                    margin-bottom: 1.25rem;
                }
                label {
                    display: block;
                    font-size: 0.875rem;
                    font-weight: 500;
                    margin-bottom: 0.375rem;
                }
                .input-field {
                    width: 100%;
                    padding: 0.625rem 0.875rem;
                    border: 1px solid #e3e3e0;
                    border-radius: 0.375rem;
                    font-size: 0.9375rem;
                    background-color: #ffffff;
                    color: #1b1b18;
                    outline: none;
                    transition: border-color 0.2s, box-shadow 0.2s;
                }
                .input-field:focus {
                    border-color: #1b1b18;
                    box-shadow: 0 0 0 1px #1b1b18;
                }
                .btn-submit {
                    width: 100%;
                    padding: 0.75rem 1rem;
                    background-color: #1b1b18;
                    color: #ffffff;
                    border: none;
                    border-radius: 0.375rem;
                    font-size: 0.9375rem;
                    font-weight: 500;
                    cursor: pointer;
                    transition: background-color 0.2s, transform 0.1s;
                }
                .btn-submit:hover {
                    background-color: #000000;
                }
                .btn-submit:active {
                    transform: scale(0.99);
                }
                .alert-success {
                    background-color: #ecfdf5;
                    color: #065f46;
                    border: 1px solid #a7f3d0;
                    padding: 0.75rem 1rem;
                    border-radius: 0.375rem;
                    font-size: 0.875rem;
                    margin-bottom: 1.25rem;
                }
                .alert-error {
                    color: #e11d48;
                    font-size: 0.75rem;
                    margin-top: 0.375rem;
                }
                .back-link {
                    display: inline-block;
                    margin-top: 1.25rem;
                    font-size: 0.875rem;
                    color: #706f6c;
                    text-decoration: none;
                }
                .back-link:hover {
                    text-decoration: underline;
                }
            </style>
        @endif
    </head>
    <body class="bg-[#FDFDFC] text-[#1b1b18] flex p-6 lg:p-8 items-center justify-center min-h-screen flex-col">
        <main class="card w-full max-w-md bg-white border border-[#e3e3e0] rounded-xl p-8 shadow-sm">
            <h1 class="text-2xl font-bold mb-2">User Registration</h1>
            <p class="text-sm text-[#706f6c] mb-6">
                Fill in the details below to submit the form.
            </p>

            {{-- Flash Success Message --}}
            @if(session('success'))
                <div class="alert-success mb-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">
                    <strong>✓ Success:</strong> {{ session('success') }}
                </div>
            @endif

            {{-- Global Validation Errors --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 text-sm">
                    <p class="font-semibold mb-1">Please correct the following errors:</p>
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('form.store') }}" method="POST" class="space-y-4">
                @csrf

                {{-- Name Field --}}
                <div class="form-group">
                    <label for="name" class="block text-sm font-medium mb-1">Full Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name') }}" 
                        placeholder="John Doe" 
                        required
                        class="input-field w-full px-3.5 py-2 rounded-md border border-[#e3e3e0] bg-white text-[#1b1b18] focus:outline-none focus:ring-1 focus:ring-black text-sm"
                    >
                    @error('name')
                        <p class="alert-error text-xs text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email Field --}}
                <div class="form-group">
                    <label for="email" class="block text-sm font-medium mb-1">Email Address</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}" 
                        placeholder="name@example.com" 
                        required
                        class="input-field w-full px-3.5 py-2 rounded-md border border-[#e3e3e0] bg-white text-[#1b1b18] focus:outline-none focus:ring-1 focus:ring-black text-sm"
                    >
                    @error('email')
                        <p class="alert-error text-xs text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div class="form-group">
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Minimum 8 characters" 
                        required
                        class="input-field w-full px-3.5 py-2 rounded-md border border-[#e3e3e0] bg-white text-[#1b1b18] focus:outline-none focus:ring-1 focus:ring-black text-sm"
                    >
                    @error('password')
                        <p class="alert-error text-xs text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <button 
                    type="submit" 
                    class="btn-submit w-full mt-4 px-5 py-2.5 bg-[#1b1b18] text-white font-medium text-sm rounded-md hover:bg-black transition cursor-pointer"
                >
                    Submit Form
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="back-link text-xs text-[#706f6c] hover:underline">
                    &larr; Back to Home
                </a>
            </div>
        </main>
    </body>
</html>
