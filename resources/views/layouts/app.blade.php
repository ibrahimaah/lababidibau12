<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="@yield('meta_keywords','Reinster')">
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/favicon.png" rel="apple-touch-icon">
    <link rel="canonical" href="{{ url()->current() }}" />
 
    @include('partials._app_styles')
    
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

    </style>

    <link rel="stylesheet" href="{{ asset('assets/css/override-bs.css') }}">

    <title>@yield('title','Reinster')</title>

</head>

<body>

    @include('partials._navbar')

    @yield('content')

    @include('partials._app_scripts')

    @stack('scripts')

</body>
</html>