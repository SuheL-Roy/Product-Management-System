<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
            max-width: 800px;
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
            font-size: 28px;
        }

        .content {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        input, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .error {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }

        .input-error {
            border-color: #dc3545;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .form-actions {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 2px solid #e0e0e0;
            display: flex;
            gap: 10px;
        }

        .preview-image {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
        }

        .required {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✏️ Edit Product</h1>
        </div>

        <div class="content">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Product Title <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title', $product->title) }}"
                        class="@error('title') input-error @enderror"
                    >
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Price ($) <span class="required">*</span></label>
                    <input 
                        type="number" 
                        id="price" 
                        name="price" 
                        step="0.01" 
                        min="0"
                        value="{{ old('price', $product->price) }}"
                        class="@error('price') input-error @enderror"
                    >
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Category <span class="required">*</span></label>
                    <input 
                        type="text" 
                        id="category" 
                        name="category" 
                        value="{{ old('category', $product->category) }}"
                        class="@error('category') input-error @enderror"
                    >
                    @error('category')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description <span class="required">*</span></label>
                    <textarea 
                        id="description" 
                        name="description"
                        class="@error('description') input-error @enderror"
                    >{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image URL <span class="required">*</span></label>
                    <input 
                        type="url" 
                        id="image" 
                        name="image" 
                        value="{{ old('image', $product->image) }}"
                        class="@error('image') input-error @enderror"
                    >
                    @error('image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <img src="{{ $product->image }}" alt="{{ $product->title }}" class="preview-image" id="preview">
                </div>

                <div class="form-group">
                    <label for="rating_rate">Rating (0-5)</label>
                    <input 
                        type="number" 
                        id="rating_rate" 
                        name="rating_rate" 
                        step="0.01" 
                        min="0"
                        max="5"
                        value="{{ old('rating_rate', $product->rating_rate) }}"
                        class="@error('rating_rate') input-error @enderror"
                    >
                    @error('rating_rate')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rating_count">Rating Count</label>
                    <input 
                        type="number" 
                        id="rating_count" 
                        name="rating_count" 
                        min="0"
                        value="{{ old('rating_count', $product->rating_count) }}"
                        class="@error('rating_count') input-error @enderror"
                    >
                    @error('rating_count')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Update Product
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        ← Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('image').addEventListener('input', function(e) {
            const preview = document.getElementById('preview');
            preview.src = e.target.value || '{{ $product->image }}';
        });
    </script>
</body>
</html>