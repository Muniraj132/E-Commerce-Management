<!-- Start Featured Product -->
<section id="featured-products" class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Featured Product</h1>
                <p>
                    <b>Handpicked Just for You – Shop Our Top Picks!</b>
                    Best Sellers & New Arrivals – Discover What’s Trending!
                </p>
            </div>
        </div>
        <div class="row">
            @foreach($featuredProducts as $product)
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="{{ route('shop', ['slug' => $product->slug]) }}">
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <a href="{{ route('product', ['slug' => $product->slug]) }}" class="h2 text-decoration-none text-dark">{{ $product->name }}</a>
                        <p class="text-left mt-2">₹ {{ $product->price }}</p>
                        <p class="text-center"><a href="{{ route('shop', ['slug' => $product->slug]) }}" class="btn btn-sm btn-primary">View</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center">
            <p class=""><a href="{{ route('shop') }}" class="btn btn-success">View All</a></p>
        </div>
    </div>
</section>
<!-- End Featured Product -->

