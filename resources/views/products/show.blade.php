
@extends('layouts.app')

@section('title', $product->name . ' | NAGATO STORE')

@section('content')

<section class="details-section">
    <div class="container">

        <div class="breadcrumb-premium">
            <a href="{{ route('home') }}">Home</a>
            <i class="bi bi-chevron-right"></i>
            <span>{{ $product->name }}</span>
        </div>

        <div class="row g-5 align-items-center">

            <div class="col-lg-6">
                <div class="details-image-wrapper">

                    @if($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="details-image"
                        >
                    @else
                        <img
                            src="https://placehold.co/800x900/f4f2ee/222222?text=NAGATO+STORE"
                            alt="{{ $product->name }}"
                            class="details-image"
                        >
                    @endif

                    <span class="details-image-label">
                        NAGATO SELECTION
                    </span>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="details-content">

                    <span class="eyebrow">NAGATO STORE / COLLECTION</span>

                    <h1>{{ $product->name }}</h1>

                    <div class="details-price">
                        <span id="unitPrice"
                              data-price="{{ (float)$product->price }}">
                            {{ number_format((float)$product->price, 2) }}
                        </span>
                        <small>DH</small>
                    </div>

                    <div class="details-divider"></div>

                    <h6 class="details-label">PRODUCT DESCRIPTION</h6>

                    <p class="details-description">
                        {{ $product->description ?: 'Discover this product from our exclusive NAGATO STORE collection.' }}
                    </p>

                    <div class="stock-info">
                        @if($product->stock > 0)
                            <span class="stock-dot"></span>
                            <span>Available in stock ({{ $product->stock }})</span>
                        @else
                            <span class="stock-dot out-of-stock"></span>
                            <span>Out of stock</span>
                        @endif
                    </div>

                    <div class="details-divider"></div>

                    <label class="details-label mb-3">QUANTITY</label>

                    <div class="quantity-control">
                        <button type="button" id="minusQty" aria-label="Decrease quantity">
                            <i class="bi bi-dash"></i>
                        </button>

                        <input type="number"
                               id="quantity"
                               value="1"
                               min="1"
                               max="{{ max(1, (int)$product->stock) }}"
                               readonly>

                        <button type="button" id="plusQty" aria-label="Increase quantity">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>

                    <div class="order-total">
                        <span>TOTAL</span>
                        <strong><span id="totalPrice">{{ number_format((float)$product->price, 2) }}</span> DH</strong>
                    </div>

                    @if($product->stock > 0)

                        <button type="button" id="whatsappOrder" class="whatsapp-order-btn">
                            <i class="bi bi-whatsapp"></i>
                            ORDER VIA WHATSAPP
                            <i class="bi bi-arrow-up-right ms-auto"></i>
                        </button>

                    @else

                        <button class="whatsapp-order-btn disabled" disabled>
                            OUT OF STOCK
                        </button>

                    @endif

                    <div class="details-benefits">
                        <div>
                            <i class="bi bi-chat-dots"></i>
                            <span>Direct ordering</span>
                        </div>
                        <div>
                            <i class="bi bi-shield-check"></i>
                            <span>Customer support</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const quantityInput = document.getElementById('quantity');
    const minusButton = document.getElementById('minusQty');
    const plusButton = document.getElementById('plusQty');
    const totalElement = document.getElementById('totalPrice');
    const orderButton = document.getElementById('whatsappOrder');

    if (!quantityInput || !totalElement) return;

    const unitPrice = Number(document.getElementById('unitPrice').dataset.price);
    const maxStock = Number(quantityInput.max);

    function updateTotal() {
        const quantity = Number(quantityInput.value);
        totalElement.textContent = (unitPrice * quantity).toFixed(2);
    }

    minusButton.addEventListener('click', function () {
        let quantity = Number(quantityInput.value);

        if (quantity > 1) {
            quantityInput.value = quantity - 1;
            updateTotal();
        }
    });

    plusButton.addEventListener('click', function () {
        let quantity = Number(quantityInput.value);

        if (quantity < maxStock) {
            quantityInput.value = quantity + 1;
            updateTotal();
        }
    });

    if (orderButton) {
        orderButton.addEventListener('click', function () {

            const quantity = Number(quantityInput.value);
            const total = (unitPrice * quantity).toFixed(2);

            const message =
                "Hello NAGATO STORE!%0A%0A" +
                "I would like to order:%0A" +
                "Product: {{ addslashes($product->name) }}%0A" +
                "Quantity: " + quantity + "%0A" +
                "Unit Price: " + unitPrice.toFixed(2) + " DH%0A" +
                "Total: " + total + " DH";

            const phone = "{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}";

            window.open(
                "https://wa.me/" + phone + "?text=" + encodeURIComponent(
                    "Hello NAGATO STORE!\n\n" +
                    "I would like to order:\n" +
                    "Product: {{ addslashes($product->name) }}\n" +
                    "Quantity: " + quantity + "\n" +
                    "Unit Price: " + unitPrice.toFixed(2) + " DH\n" +
                    "Total: " + total + " DH"
                ),
                "_blank"
            );
        });
    }

});
</script>
@endsection
