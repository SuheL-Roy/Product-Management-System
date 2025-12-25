<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Product Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            color: white;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .subtitle {
            opacity: 0.9;
            font-size: 14px;
        }

        .content {
            padding: 30px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-warning {
            background: #ffc107;
            color: #000;
        }

        .btn-warning:hover {
            background: #e0a800;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 13px;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
        }

        .description {
            max-width: 400px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .category-badge {
            background: #e7f3ff;
            color: #0066cc;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .rating-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stars {
            display: flex;
            gap: 2px;
            font-size: 16px;
        }

        .star {
            color: #ddd;
        }

        .star.filled {
            color: #ffc107;
        }

        .star.half {
            background: linear-gradient(90deg, #ffc107 50%, #ddd 50%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .rating-text {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .rating-count {
            font-size: 12px;
            color: #666;
        }

        .price {
            font-size: 18px;
            font-weight: 700;
            color: #28a745;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .pagination {
            margin-top: 25px;
            display: flex;
            justify-content: center;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }

        .empty-state svg {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .product-count {
            color: rgba(255,255,255,0.9);
            font-size: 16px;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Product Management System</h1>
            @if($products->total() > 0)
                <p class="product-count">Total Products: {{ $products->total() }}</p>
            @endif
        </div>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    ✗ {{ session('error') }}
                </div>
            @endif

            <div class="action-bar">
                <h2>Products List</h2>
                <form action="{{ route('products.fetch') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        📥 Fetch Products from API
                    </button>
                </form>
            </div>

            @if($products->count() > 0)
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Rating</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <img src="{{ $product->image }}" alt="{{ $product->title }}" class="product-img">
                                    </td>
                                    <td><strong>{{ $product->title }}</strong></td>
                                    <td><span class="price">${{ number_format($product->price, 2) }}</span></td>
                                    <td>
                                        @if($product->rating_rate)
                                            <div class="rating-container">
                                                <div class="stars">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= floor($product->rating_rate))
                                                            <span class="star filled">★</span>
                                                        @elseif($i - 0.5 <= $product->rating_rate)
                                                            <span class="star half">★</span>
                                                        @else
                                                            <span class="star">★</span>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <div>
                                                    <div class="rating-text">{{ number_format($product->rating_rate, 1) }}</div>
                                                    @if($product->rating_count)
                                                        <div class="rating-count">({{ number_format($product->rating_count) }})</div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <span style="color: #999;">No rating</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="category-badge">{{ ucfirst($product->category) }}</span>
                                    </td>
                                    <td>
                                        <div class="description">{{ $product->description }}</div>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                                                ✏️ Edit
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    🗑️ Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    {{ $products->links() }}
                </div>
            @else
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3>No Products Found</h3>
                    <p>Click the "Fetch Products from API" button to load products from FakeStore API</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>