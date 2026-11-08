
@extends('layouts.app')

@section('title', 'NAGATO STORE | Discover Something Special')

@section('content')

<section class="premium-hero">
    <div class="container">
        <div class="hero-grid">

            <div class="hero-text">
                <span class="eyebrow">
                    <span class="gold-dot"></span>
                    WELCOME TO NAGATO STORE
                </span>

                <h1>
                    Discover<br>
                    Something <span>Special.</span>
                </h1>

                <p>
                    Explore our exclusive collection and find products
                    that match your style. Quality, simplicity and
                    a better shopping experience.
                </p>

                <div class="hero-actions">
                    <a href="#products" class="btn-premium">
                        Explore Collection
                        <i class="bi bi-arrow-up-right"></i>
                    </a>

                    <span class="hero-note">
                        QUALITY MEETS STYLE
                    </span>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-image-frame">
                    <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1000"
                         alt="NAGATO STORE Collection">
                </div>

                <div class="hero-floating-card">
                    <span class="floating-icon">
                        <i class="bi bi-stars"></i>
                    </span>
                    <div>
                        <strong>Premium Selection</strong>
                        <small>Carefully selected products</small>
                    </div>
                </div>

                <div class="hero-number">N° 01</div>
            </div>

        </div>
    </div>
</section>

<section class="collection-section" id="products">
    <div class="container">

        <div class="section-heading">
            <div>
                <span class="eyebrow">OUR COLLECTION</span>
                <h2>Find Your <span>Favorites.</span></h2>
                <p>Explore our latest products and discover something new.</p>
            </div>

            <div class="product-counter">
                <strong>{{ $products->total() }}</strong>
                <span>PRODUCTS</span>
            </div>
        </div>

        <form action="{{ route('home') }}" method="GET" class="premium-search">
            <div class="search-box">
                <i class="bi bi-search search-icon"></i>

                <input
                    type="search"
                    name="search"
                    placeholder="Search for products..."
                    value="{{ request('search') }}"
                >

                @if(request('search'))
                    <a href="{{ route('home') }}" class="clear-search">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif

                <button type="submit" class="search-btn">
                    Search
                </button>
            </div>
        </form>

        @if(request('search'))
            <div class="search-result-text">
                Results for: <strong>{{ request('search') }}</strong>
                <span>({{ $products->total() }} found)</span>
            </div>
        @endif

        @if($products->count() > 0)

            <div class="row g-4 product-grid">

                @foreach($products as $product)

                    <div class="col-6 col-md-4 col-lg-3">

                        <article class="premium-product-card">

                            <a href="{{ route('products.show', $product->slug) }}"
                               class="product-image-link">

                                <div class="product-image-wrapper">

                                    @if($product->image)
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="product-image"
                                            loading="lazy"
                                        >
                                    @else
                                        <img
                                            src="https://placehold.co/600x700/f4f2ee/222222?text=NAGATO+STORE"
                                            alt="{{ $product->name }}"
                                            class="product-image"
                                            loading="lazy"
                                        >
                                    @endif

                                    <span class="product-badge">COLLECTION</span>

                                    <span class="quick-view">
                                        <i class="bi bi-arrow-up-right"></i>
                                    </span>

                                </div>
                            </a>

                            <div class="product-card-content">

                                <span class="product-category">NAGATO SELECTION</span>

                                <h3>
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>

                                <div class="product-card-bottom">
                                    <span class="product-price">
                                        {{ number_format((float)$product->price, 2) }}
                                        <small>DH</small>
                                    </span>

                                    <a href="{{ route('products.show', $product->slug) }}"
                                       class="product-arrow">
                                        <i class="bi bi-arrow-up-right"></i>
                                    </a>
                                </div>

                            </div>
                        </article>

                    </div>

                @endforeach

            </div>

            <div class="premium-pagination">
                {{ $products->links() }}
            </div>

        @else

            <div class="empty-state">
                <i class="bi bi-search"></i>

                <h3>No products found</h3>

                <p>Try searching with another keyword.</p>

                <a href="{{ route('home') }}" class="btn-premium">
                    View All Products
                </a>
            </div>

        @endif

    </div>
</section>

<section class="about-section" id="about">
    <div class="container">
        <div class="about-inner">
            <span class="eyebrow">THE NAGATO EXPERIENCE</span>
            <h2>Simple Shopping.<br><span>Better Choices.</span></h2>
            <p>
                Discover our collection, choose your favorite products
                and order directly through WhatsApp.
            </p>
            <a href="#products" class="about-link">
                Explore the store <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

@endsection
