
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">My Store Admin</a>
    <a href="{{ route('admin.products') }}" class="btn btn-outline-light btn-sm">Back to Products</a>
</nav>

<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width:700px;">
        <div class="card-body p-4">
            <h2 class="mb-4">Edit Product</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"
                              rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price (DH)</label>
                        <input type="number" name="price" class="form-control"
                               step="0.01" min="0"
                               value="{{ old('price', $product->price) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control"
                               min="0" value="{{ old('stock', $product->stock) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             width="120" class="rounded mb-2">
                    @else
                        <p class="text-muted">No image uploaded.</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Change Image (optional)</label>
                    <input type="file" name="image" class="form-control"
                           accept="image/jpeg,image/png,image/webp">
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="is_active" value="1"
                           class="form-check-input" id="is_active"
                           {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Show this product in the store
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Update Product
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
