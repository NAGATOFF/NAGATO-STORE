
document.addEventListener('DOMContentLoaded', function () {

    const quantityInput = document.getElementById('quantity');
    const decreaseButton = document.getElementById('decrease');
    const increaseButton = document.getElementById('increase');
    const totalPrice = document.getElementById('totalPrice');
    const whatsappButton = document.getElementById('whatsappOrder');

    // Homepage or other pages without product quantity
    if (!quantityInput || !whatsappButton) {
        return;
    }

    const productName = whatsappButton.dataset.product;
    const unitPrice = Number(whatsappButton.dataset.price);
    const maxStock = Number(whatsappButton.dataset.stock);
    const phone = whatsappButton.dataset.phone;

    function formatPrice(price) {
        return price.toFixed(2) + ' DH';
    }

    function updateOrder() {

        let quantity = parseInt(quantityInput.value, 10);

        if (!Number.isFinite(quantity)) {
            quantity = 1;
        }

        quantity = Math.max(1, Math.min(quantity, maxStock));

        quantityInput.value = quantity;

        const total = unitPrice * quantity;

        totalPrice.textContent = formatPrice(total);

        const message =
`Hello! I would like to order:

Product: ${productName}
Quantity: ${quantity}
Unit price: ${formatPrice(unitPrice)}
Total price: ${formatPrice(total)}

Thank you!`;

        whatsappButton.href =
            'https://wa.me/' + phone +
            '?text=' + encodeURIComponent(message);
    }

    decreaseButton.addEventListener('click', function () {
        quantityInput.value = Number(quantityInput.value) - 1;
        updateOrder();
    });

    increaseButton.addEventListener('click', function () {
        quantityInput.value = Number(quantityInput.value) + 1;
        updateOrder();
    });

    quantityInput.addEventListener('input', updateOrder);

    whatsappButton.addEventListener('click', function (event) {

        if (
            !Number.isInteger(Number(quantityInput.value)) ||
            Number(quantityInput.value) < 1 ||
            Number(quantityInput.value) > maxStock
        ) {
            event.preventDefault();
            alert('Please enter a valid quantity.');
        }

    });

    updateOrder();

});
