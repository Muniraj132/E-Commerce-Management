<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h1 align-self-center" href="{{ url('/') }}">
            Raj
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#categories">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#featured-products">Featured Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop') }}">Products</a>
                    </li>
                </ul>
            </div>
            <div class="navbar align-self-center d-flex">
                <a class="nav-icon position-relative text-decoration-none" href="{{ route('cart.view') }}" title="Cart">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">{{ \App\Models\CartItem::where('user_id', auth()->id())->count() ?? 0 }}</span>
                </a>
                @guest
                    <a class="nav-icon position-relative text-decoration-none" href="{{ route('login') }}" title="Login">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                    </a>
                @else
                    @if(auth()->user()->role === 'admin')
                        <a class="nav-icon position-relative text-decoration-none" href="{{ route('admin.dashboard') }}" title="Admin Dashboard">
                            <i class="fa fa-fw fa-user-shield text-dark mr-3"></i>
                        </a>
                    @elseif(auth()->user()->role === 'user')
                        <a class="nav-icon position-relative text-decoration-none" href="{{ route('orders') }}" title="My Account">
                            <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-icon position-relative text-decoration-none" title="Logout">
                            <i class="fa fa-fw fa-sign-out-alt text-dark mr-3"></i>
                        </a>
                    </form>

                @endguest
            </div>
        </div>
    </div>
</nav>
