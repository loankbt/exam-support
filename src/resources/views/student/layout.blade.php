<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.4.8/p5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.4.8/addons/p5.dom.js"></script>
    <title>@yield('title')</title>
    @stack('css')
</head>

<body>
    @yield('content')

    <!-- Footer -->
    <footer class="page-footer font-small indigo">

        <!-- Footer Links -->
        <div class="container">
            <hr class="rgba-white-light" style="margin: 0 15%;">
            <!-- Grid row-->
            <div class="row d-flex text-center justify-content-center mb-md-0 mb-4">
                <!-- Grid column -->
                <div class="col-md-8 col-12 mt-5">
                    <p style="line-height: 1.7rem">Entrance Exam 2020</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row-->
            <hr class="clearfix d-md-none rgba-white-light" style="margin: 10% 15% 5%;">
        </div>
        <!-- Footer Links -->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2020 Copyright</div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->

    @stack('scripts')
</body>
</html>