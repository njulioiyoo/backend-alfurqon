<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $website_name }} - @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">

    @foreach (['vendor/bootstrap.min.css', 'vendor/flaticon.css', 'plugins/swiper.min.css', 'plugins/magnific-popup.css', 'style.css'] as $style)
        <link rel="stylesheet" href="{{ asset("assets/css/$style") }}">
    @endforeach
</head>

<body>
    <div class="header-area header-area--default">
        <header class="header-area header-sticky">
            @include('templates.header')
        </header>
    </div>

    @yield('content')

    <footer class="footer-area bg-footer">
        @include('templates.footer')
    </footer>

    <a href="#" class="scroll-top" id="scroll-top">
        <i class="arrow-top flaticon-up-arrow"></i>
        <i class="arrow-bottom flaticon-up-arrow"></i>
    </a>
    <div class="mobile-menu-overlay" id="mobile-menu-overlay">
        @include('components.mobile_header')
    </div>

    @foreach (['vendor/modernizr-2.8.3.min.js', 'vendor/jquery-3.5.1.min.js', 'vendor/jquery-migrate-3.3.0.min.js', 'vendor/bootstrap.min.js', 'plugins/swiper.min.js', 'plugins/waypoints.min.js', 'plugins/counterup.min.js', 'plugins/jquery.magnific-popup.min.js', 'plugins/wow.min.js', 'plugins/ajax.mail.js', 'main.js'] as $script)
        <script src="{{ asset("assets/js/$script") }}"></script>
    @endforeach

    @stack('extend-scripts')
</body>

</html>