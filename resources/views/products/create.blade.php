<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Product - {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <style>
        body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; background-color: #FDFDFC; color: #1b1b18; padding: 2rem 1rem; display: flex; justify-content: center; }
        .container { width: 100%; max-width: 500px; background: #fff; border: 1px solid #e3e3e0; border-radius: 0.75rem; padding: 2rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.25rem; font-weight: 500; font-size: 0.875rem; }
        input[type="text"], input[type="number"], textarea { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #e3e3e0; border-radius: 0.375rem; box-sizing: border-box; }
        .btn { padding: 0.625rem 1.25rem; background: #1b1b18; color: #fff; border: none; border-radius: 0.375rem; cursor: pointer; }
        .btn:hover { background: #000; }
        .back-link { display: inline-block; margin-top: 1rem; font-size: 0.875rem; color: #706f6c; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="margin-bottom: 1.5rem; font-size: 1.5rem;">Add New Product</h1>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 0.75rem; border-radius: 0.375rem; margin-bottom: 1rem; font-size: 0.875rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', '0.00') }}" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock Quantity</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', '0') }}" required>
            </div>
            <button type="submit" class="btn">Save Product</button>
        </form>
        <a href="{{ route('products.index') }}" class="back-link">&larr; Back to Products</a>
    </div>
</body>
</html>
