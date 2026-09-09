<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Color Page - {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; background-color: #FDFDFC; color: #1b1b18; padding: 2rem; display: flex; justify-content: center; }
        .card { max-width: 500px; width: 100%; background: #fff; border: 1px solid #e3e3e0; border-radius: 0.75rem; padding: 2rem; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Color Settings</h1>
        <p>Manage application colors and visual theme presets.</p>
        <a href="{{ url('/') }}">&larr; Back to Home</a>
    </div>
</body>
</html>
