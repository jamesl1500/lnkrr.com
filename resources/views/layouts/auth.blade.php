<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Lnkrr | Welcome'}}</title>
    <meta name="description" content="{{ $description ?? 'Lnkrr is a easy to use link creator that allows you to list links for your audience to see.' }}">
    <meta name="keywords" content="{{ $keywords ?? 'Lnkrr, link, shortener, free, custom, track, links' }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('imgs/lnkrr_black_circle.png') }}" type="image/png">

    <!-- Base URL -->
    <meta name="base-url" content="{{ url('/') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- API Token -->
    <meta name="api-token" content="{{ Auth::user()->api_token }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/solid.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@100;200;300;400;500;600;700;800;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
<div class="website">
    <div class="header-hold">
        @include('templates.header')
    </div>
    <div class="website-hold <?php if($no_padding){?> no-padding <?php } ?>">
        @yield('content')
    </div>
    <div class="footer-hold">
        @include('templates.footer')
    </div>
    <div id="alert_hold"></div>
</div>

<!-- Live reload -->
@env('local')

@endenv

<!-- jQuery -->
<script src="{{ asset('js/jquery.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>