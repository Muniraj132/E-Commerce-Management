<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>E-Commerce Management</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
<style>
    .card-header p{
        margin: 7px;
    }
</style>

</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('admin.partials.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('admin.partials.navbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                </div>

                {{ $slot }}

                <!-- Content Row -->


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('admin.partials.footer')
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
<!-- Add these lines to your HTML head section -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
function clearInput(id) {
            var charMap = {
                Ç: "c",
                Ö: "o",
                Ş: "s",
                İ: "i",
                I: "i",
                Ü: "u",
                Ğ: "g",
                ç: "c",
                ö: "o",
                ş: "s",
                ı: "i",
                ü: "u",
                ğ: "g",
            };

            // Get the input value
            var str = $("#" + id).val();

            // Truncate to maximum length of 100
            str = str.substring(0, 100);

            // Convert characters according to charMap
            var str_array = str.split("");
            for (var i = 0, len = str_array.length; i < len; i++) {
                str_array[i] = charMap[str_array[i]] || str_array[i];
            }

            // Join the array back into a string
            str = str_array.join("");

            // Clear the string with specified replacements
            var clearStr = str
                .replace(/\ /g, "-")
                .replace(/\--/g, "-")
                .replace(/[^a-z0-9-çöşüğı]/gi, "")
                .toLowerCase();

            // Set the processed string to the #slug element
            $("#slug").val(clearStr);
        }

</script>

</body>
</html>
