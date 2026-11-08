
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'NAGATO STORE')</title>

    <meta name="description" content="Discover premium products at NAGATO STORE.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/store.css') }}?v={{ time() }}">
</head>

<body>

<header class="site-header">
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand brand-logo" href="{{ route('home') }}">
                NAGATO<span> STORE.</span>
            </a>

            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#mainNav">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-4">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#products">Products</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#about">About</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('home') }}#products" class="nav-shop-btn">
                            Shop Now <i class="bi bi-arrow-up-right"></i>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer class="site-footer">
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-md-6">
                <a href="{{ route('home') }}" class="brand-logo footer-brand">
                    NAGATO<span> STORE.</span>
                </a>
                <p class="footer-description">
                    Discover your style. Experience quality.
                </p>
            </div>

            <div class="col-md-6 text-md-end">
                <p class="mb-0 footer-copy">
                    © {{ date('Y') }} NAGATO STORE. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@yield('scripts')

</body>
</html>
