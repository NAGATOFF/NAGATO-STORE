
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Product</title>
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
            <h2 class="mb-4">Add New Product</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"
                              rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price (DH)</label>
                        <input type="number" name="price" class="form-control"
                               step="0.01" min="0" value="{{ old('price') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control"
                               min="0" value="{{ old('stock', 0) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="image" class="form-control"
                           accept="image/jpeg,image/png,image/webp">
                    <small class="text-muted">Maximum size: 2 MB</small>
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="is_active" value="1"
                           class="form-check-input" id="is_active" checked>
                    <label class="form-check-label" for="is_active">
                        Show this product in the store
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Save Product
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
