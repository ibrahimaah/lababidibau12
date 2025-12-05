<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="@yield('meta_keywords','LABABIDI')">
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/favicon.png" rel="apple-touch-icon">
    <link rel="canonical" href="{{ url()->current() }}" />
    <!-- Google Fonts -->
    
    <!-- Bootstrap Library --> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
            crossorigin="anonymous">
    </script>
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <!----------------------->

    <!-- Vendor CSS Files -->
    {{-- <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> --}}

    <link href="{{ asset('assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    
    

    

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/component.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toggleButton.css') }}" />
    
    <!-- Whatsapp floating Icon --->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!----------------------------------------->
    <script src="{{ asset('assets/js/modernizr.custom.js') }}"></script>
    

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

    <!-------------------------  Tinymce -------------------------------------------->
    <!-- <script src="https://cdn.tiny.cloud/1/qr5ycpvo2ogg9vlwgxegmeg13hccvqppgw5nnv76clp6cpbs/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script src="https://cdn.tiny.cloud/1/l86ybdpz6cixgvcq47wqlesdrxxda0gc8ktjfbintv0zzt7q/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <!------------------------------------------------------------------------------------------------------>

 
        
    {{-- <link href="{{ asset('assets/css/header.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        :root {
            --bs-primary: {{ setting('primary_color', '#6c757d') }};
            --bs-secondary: {{ setting('secondary_color', '#0d6efd') }};
            --bs-success: {{ setting('success_color', '#198754') }};
            --bs-danger: {{ setting('danger_color', '#dc3545') }};
            --bs-warning: {{ setting('warning_color', '#ffc107') }};
            --bs-info: {{ setting('info_color', '#0dcaf0') }};
            --bs-light: {{ setting('light_color', '#f8f9fa') }};
            --bs-dark: {{ setting('dark_color', '#212529') }};
            --bs-body-bg: {{ setting('background_color', '#ffffff') }};
            --bs-body-color: {{ setting('text_color', '#212529') }};
        }
        
        /* Buttons */
        .btn-primary { background-color: var(--bs-primary) !important; border-color: var(--bs-primary) !important; }
        .btn-secondary { background-color: var(--bs-secondary) !important; border-color: var(--bs-secondary) !important; }
        .btn-success { background-color: var(--bs-success) !important; border-color: var(--bs-success) !important; }
        .btn-danger { background-color: var(--bs-danger) !important; border-color: var(--bs-danger) !important; }
        .btn-warning { background-color: var(--bs-warning) !important; border-color: var(--bs-warning) !important; }
        .btn-info { background-color: var(--bs-info) !important; border-color: var(--bs-info) !important; }
        .btn-light { background-color: var(--bs-light) !important; border-color: var(--bs-light) !important; }
        .btn-dark { background-color: var(--bs-dark) !important; border-color: var(--bs-dark) !important; }
        
        /* Text */
        .text-primary { color: var(--bs-primary) !important; }
        .text-secondary { color: var(--bs-secondary) !important; }
        .text-success { color: var(--bs-success) !important; }
        .text-danger { color: var(--bs-danger) !important; }
        .text-warning { color: var(--bs-warning) !important; }
        .text-info { color: var(--bs-info) !important; }
        .text-light { color: var(--bs-light) !important; }
        .text-dark { color: var(--bs-dark) !important; }
        
        /* Backgrounds */
        .bg-primary { background-color: var(--bs-primary) !important; }
        .bg-secondary { background-color: var(--bs-secondary) !important; }
        .bg-success { background-color: var(--bs-success) !important; }
        .bg-danger { background-color: var(--bs-danger) !important; }
        .bg-warning { background-color: var(--bs-warning) !important; }
        .bg-info { background-color: var(--bs-info) !important; }
        .bg-light { background-color: var(--bs-light) !important; }
        .bg-dark { background-color: var(--bs-dark) !important; }
        
        /* Borders */
        .border-primary { border-color: var(--bs-primary) !important; }
        .border-secondary { border-color: var(--bs-secondary) !important; }
        .border-success { border-color: var(--bs-success) !important; }
        .border-danger { border-color: var(--bs-danger) !important; }
        .border-warning { border-color: var(--bs-warning) !important; }
        .border-info { border-color: var(--bs-info) !important; }
        .border-light { border-color: var(--bs-light) !important; }
        .border-dark { border-color: var(--bs-dark) !important; }
        
        /* Alerts */
        .alert-primary { background-color: var(--bs-primary) !important; border-color: var(--bs-primary) !important; color: #fff !important; }
        .alert-secondary { background-color: var(--bs-secondary) !important; border-color: var(--bs-secondary) !important; color: #fff !important; }
        .alert-success { background-color: var(--bs-success) !important; border-color: var(--bs-success) !important; color: #fff !important; }
        .alert-danger { background-color: var(--bs-danger) !important; border-color: var(--bs-danger) !important; color: #fff !important; }
        .alert-warning { background-color: var(--bs-warning) !important; border-color: var(--bs-warning) !important; color: #212529 !important; }
        .alert-info { background-color: var(--bs-info) !important; border-color: var(--bs-info) !important; color: #212529 !important; }
        .alert-light { background-color: var(--bs-light) !important; border-color: var(--bs-light) !important; color: #212529 !important; }
        .alert-dark { background-color: var(--bs-dark) !important; border-color: var(--bs-dark) !important; color: #fff !important; }
        </style>
        
    <title>@yield('title','LABABIDI BAU')</title>
    
</head>
<body>


    
    @yield('content')
    

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->
    <script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    
    
    <!--- jQuery Cookies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    

    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/classie.js') }}"></script>
    <script src="{{ asset('assets/js/cbpGridGallery.js') }}"></script>


    
    <!--------------------------------------------------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


    <script>
        new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
    </script>

    <script src="{{ asset('assets/js/header.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>