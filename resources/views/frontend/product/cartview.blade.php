<x-sub-page-layout>
    <section style="min-height: 66vh" class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <!-- col end -->
                <div class="col-lg-12 mt-5">
              <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Your Cart</h5>
                            @if($cartItems->isEmpty())
                                <p class="text-center">Your cart is empty.</p>
                            @else
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price(₹)</th>
                                            <th>Quantity</th>
                                            <th>Total(₹)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $grandTotal = 0;
                                        @endphp
                                        @foreach($cartItems as $item)
                                            @php
                                                $total = $item->price * $item->quantity;
                                                $grandTotal += $total;
                                            @endphp
                                            <tr>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ number_format($item->price, 2) }}</td>
                                                <td>
                                                    <ul class="list-inline pb-3">
                                                        <input type="hidden" name="product-quantity" class="product-quantity" value="{{ $item->quantity }}" data-id="{{ $item->id }}">
                                                        <li class="list-inline-item"><button class="btn btn-success btn-minus">-</button></li>
                                                        <li class="list-inline-item"><span class="badge bg-secondary quantity-display">{{ $item->quantity }}</span></li>
                                                        <li class="list-inline-item"><button class="btn btn-success btn-plus">+</button></li>
                                                    </ul>
                                                </td>
                                                <td>{{ number_format($total, 2) }}</td>
                                                <td>
                                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Grand Total</strong></td>
                                            <td><strong>{{ number_format($grandTotal, 2) }}</strong></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div style="text-align: end" class="text-right" >
                                    <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-sub-page-layout>
<script>
    $(document).ready(function() {
        $(".btn-minus, .btn-plus").click(function(e) {
            e.preventDefault();

            var row = $(this).closest("td");
            var quantityInput = row.find(".product-quantity");
            var quantityDisplay = row.find(".quantity-display");
            var currentQuantity = parseInt(quantityInput.val());
            var productId = quantityInput.data("id");

            if ($(this).hasClass("btn-plus")) {
                currentQuantity += 1;
            } else if ($(this).hasClass("btn-minus") && currentQuantity > 1) {
                currentQuantity -= 1;
            }

            quantityInput.val(currentQuantity);
            quantityDisplay.text(currentQuantity);

            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: productId,
                    quantity: currentQuantity
                },
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    }
                },
                error: function(xhr) {
                    console.error("Error updating cart:", xhr.responseText);
                    $("#alert-message").html('<div class="alert alert-danger">Failed to update cart. Please try again.</div>');
                }
            });
        });
    });
</script>
