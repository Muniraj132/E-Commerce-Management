<x-sub-page-layout>
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-12 m-auto">
                <h1 class="h1 pb-4">Order Placed Successfully!</h1>
                <p class="pb-4">
                    <b>Thank you for shopping with us!</b>
                </p>
                <p class="pb-4">Your order has been confirmed. Your order number is: <b>{{ $order->order_number ?? '' }}</b></p>
                <a href="{{ route('products') }}" class="btn btn-success">Continue Shopping</a>
            </div>
        </div>
    </section>
</x-sub-page-layout>
