<!DOCTYPE html>
<html lang="en">

<head>
    <title>Raj Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ asset('assets/img/download.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/download.png')}}">

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

    <div class="container mt-2" id="alert-message">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
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
    </script>
</body>

</html>
