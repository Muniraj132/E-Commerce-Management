<!DOCTYPE html>
<html lang="en">

<head>
    <title>Raj Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-icon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico')}}">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/templatemo.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
  <link rel="stylesheet" href="{{asset('assets/css/fontawesome.min.css')}}">
</head>

<body>
    <!-- Start Top Nav -->
        @include('frontend.partials.nav')
    <!-- Close Top Nav -->


    <!-- Header -->
        @include('frontend.partials.header')
    <!-- Close Header -->

    <!-- Modal -->
         @include('frontend.partials.search')

        <div class="container mt-2" id="alert-message">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 0.9rem;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 0.9rem;">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>

            {{ $slot }}

    <!-- Start Footer -->
        @include('frontend.partials.footer')
    <!-- End Footer -->

<!-- Start Script -->
<script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/templatemo.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        $(document).ready(function(){

            $(".login-alert").click(function() {
                alert("Please log in to add products to your cart.");
                window.location.href = "{{ route('login') }}"; // Redirect to login page
            });
        });

     $("#alert-message").removeAttr('style').delay(2000).fadeOut();
    </script>
<!-- End Script -->
</body>

</html>
