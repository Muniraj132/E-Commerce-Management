<section id="categories" class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Shop by Category!</h1>
            <p>
                <b>Trending Now: Must-Have Picks for the Month!</b>
                Shop the Hottest Deals on This Month’s Top Categories!
            </p>
        </div>
    </div>
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="{{ route('products') }}"><img src="./assets/img/category_img_01.jpg" class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3">{{ $category->name }}</h5>
                <p class="text-center"><a href="{{ route('products', ['categories' => [$category->id]]) }}" class="btn btn-success">Go Shop</a></p>
            </div>
        @endforeach
    </div>
</section>

