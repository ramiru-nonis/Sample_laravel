<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Products List - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
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
            justify-content: center;
            align-items: flex-start;
            padding: 2rem 1rem;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #0a0a0a;
                color: #EDEDEC;
            }
            .container {
                background-color: #161615 !important;
                border-color: #3E3E3A !important;
            }
            th {
                background-color: #1f1f1e !important;
                color: #EDEDEC !important;
                border-bottom-color: #3E3E3A !important;
            }
            td {
                border-bottom-color: #27272a !important;
                color: #EDEDEC !important;
            }
            tr:hover td {
                background-color: #1f1f1e !important;
            }
            .muted-text {
                color: #A1A09A !important;
            }
            .empty-state {
                color: #A1A09A !important;
            }
        }

        .container {
            width: 100%;
            max-width: 900px;
            background-color: #ffffff;
            border: 1px solid #e3e3e0;
            border-radius: 0.75rem;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .title {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .muted-text {
            color: #706f6c;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.9375rem;
        }

        th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            padding: 0.75rem 1rem;
            border-bottom: 2px solid #e3e3e0;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        td {
            padding: 0.875rem 1rem;
            border-bottom: 1px solid #e3e3e0;
            vertical-align: middle;
        }

        tr:hover td {
            background-color: #f8f9fa;
        }

        .price-tag {
            font-weight: 600;
            color: #10b981;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 9999px;
            text-align: center;
        }

        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #706f6c;
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-primary {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #1b1b18;
            color: #ffffff;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.375rem;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: #000000;
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

        .btn-action {
            font-size: 0.8125rem;
            color: #2563eb;
            text-decoration: none;
            margin-right: 0.5rem;
        }

        .btn-action:hover {
            text-decoration: underline;
        }

        .btn-delete {
            background: none;
            border: none;
            color: #dc2626;
            font-size: 0.8125rem;
            cursor: pointer;
            padding: 0;
        }

        .btn-delete:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1 class="title">Product List</h1>
                <p class="muted-text">Overview of all available products</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('products.create') }}" class="btn-primary">+ Add Product</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><strong>{{ $product->name }}</strong></td>
                            <td>{{ $product->description ?? 'No description' }}</td>
                            <td class="price-tag">${{ number_format($product->price, 2) }}</td>
                            <td>
                                @if($product->stock > 0)
                                    <span class="badge badge-success">{{ $product->stock }} in stock</span>
                                @else
                                    <span class="badge badge-danger">Out of stock</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn-action">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                No products found in the database.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

