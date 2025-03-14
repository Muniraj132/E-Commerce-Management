<x-sub-page-layout>
    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-3">
                <form id="categoryFilterForm" method="GET" action="{{ route('shop') }}">
                    <h1 class="h2 pb-4">Categories</h1>
                    <a href="{{ route('shop') }}" class="btn-outline">Clear Filter</a>
                    <ul class="list-unstyled templatemo-accordion mt-4">
                        @foreach($categories as $category)
                            <li class="pb-3">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="category-{{ $category->id }}"
                                    {{ request()->has('categories') && in_array($category->id, request()->categories) ? 'checked' : '' }}>
                                <label for="category-{{ $category->id }}">{{ $category->name }}</label>
                            </li>
                        @endforeach
                    </ul>
                </form>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="{{ asset($product->image) }}">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white mt-2" href="{{ route('product', ['slug' => $product->slug]) }}" title="View"><i class="far fa-eye"></i></a></li>
                                        <li>
                                            @auth
                                                <form action="{{ route('cart.add') }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="btn btn-success text-white mt-2" title="Add to Cart">
                                                        <i class="fas fa-cart-plus"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button type="submit" class="btn btn-danger text-white mt-2 login-alert" title="Add to Cart">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            @endauth
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('product', ['slug' => $product->slug]) }}" class="h3 text-decoration-none">{{ $product->name }}</a>
                                <p class="text-center mb-0">₹ {{ $product->price }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>
    <!-- End Content -->
</x-sub-page-layout>
<script>
    document.querySelectorAll('input[name="categories[]"]').forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            document.getElementById('categoryFilterForm').submit();
        });
    });

</script>
