<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }} - {{ config()->get('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" type="image/x-icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{ asset('modules/frontend/') }}/lib/animate/animate.min.css" />
    <link href="{{ asset('modules/frontend/') }}/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="{{ asset('modules/frontend/') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ asset('modules/frontend/') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('modules/frontend/') }}/css/style.css" rel="stylesheet">
    <style>
        ::-webkit-scrollbar {
            display: none;
        }

        .alert-custom {
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            z-index: 9999;
        }
    </style>
    @stack('css')
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->
    <div class="alert-custom">
        <div id="alert-container"></div>
    </div>
    @include('frontend::layouts.header')

    @yield('content')


    @include('frontend::layouts.footer')
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('modules/frontend/') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('modules/frontend/') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('modules/frontend/') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('modules/frontend/') }}/lib/counterup/counterup.min.js"></script>
    <script src="{{ asset('modules/frontend/') }}/lib/lightbox/js/lightbox.min.js"></script>
    <script src="{{ asset('modules/frontend/') }}/lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('modules/frontend') }}/js/main.js"></script>
    <script type="text/javascript">
        const alertPlaceholder = document.getElementById('alert-container')
        const Toaster = (message, type) => {
            const wrapper = document.createElement('div')
            wrapper.innerHTML = [
                `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                `   <div>${message}</div>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                '</div>'
            ].join('')

            alertPlaceholder.append(wrapper)
        }

        const Toast = (message, type) => {
            Toaster(message, type);
            setTimeout(() => {
                alertPlaceholder.innerHTML = '';
            }, 3000);
        }
    </script>
    @stack('js')
</body>

</html>
