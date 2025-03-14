<x-sub-page-layout>
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <img class="card-img img-fluid" src="{{ asset($product->image) }}" alt="{{ $product->name }}" id="product-detail">
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{ $product->name }}</h1>
                            <p class="h3 py-2">₹ {{ $product->price }}</p>
                            <h6>Description:</h6>
                            <p>{{ $product->description }}</p>
                            <!-- Separate Add to Cart Form -->
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    @auth
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" id="add-to-cart-quantity" value="1">
                                            <button type="submit" class="btn btn-success btn-lg">Add To Cart</button>
                                        </form>
                                    @else
                                        <button type="submit" class="btn btn-danger btn-lg login-alert">Add To Cart</button>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-sub-page-layout>

