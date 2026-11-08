
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4 py-3">
    <span class="navbar-brand fw-bold">MY STORE | ADMIN</span>

    <div class="d-flex gap-2">
        <a href="{{ route('home') }}" class="btn btn-outline-light btn-sm">
            View Store
        </a>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>
</nav>

<div class="container py-5">

    <h2 class="fw-bold">Welcome, {{ session('admin_name') }}</h2>
    <p class="text-muted">Manage your online store from here.</p>

    <!-- Statistics -->
    <div class="row g-4 mt-2">

        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="text-muted">Total Products</h6>
                <h2 class="fw-bold">{{ $productsCount }}</h2>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h6 class="text-muted">Active Products</h6>
                <h2 class="fw-bold text-success">{{ $activeProductsCount }}</h2>
            </div>
        </div>

    </div>

    <!-- Management -->
    <h4 class="fw-bold mt-5 mb-3">Store Management</h4>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h5>Products</h5>
                <p class="text-muted">View, edit and delete your products.</p>
                <a href="{{ route('admin.products') }}" class="btn btn-dark mt-auto">
                    Manage Products
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h5>Add Product</h5>
                <p class="text-muted">Add a new product with price, image and stock.</p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary mt-auto">
                    + Add New Product
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h5>WhatsApp Settings</h5>
                <p class="text-muted">Change the WhatsApp number used for orders.</p>
                <a href="{{ route('admin.settings') }}" class="btn btn-success mt-auto">
                    Manage Settings
                </a>
            </div>
        </div>

    </div>

</div>

</body>
</html>
