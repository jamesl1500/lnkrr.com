<header class="header container">
    <div class="header_inner">
        <div class="header_logo">
            @if(Auth::check())
            <a href="{{ route('me') }}">
            @else
            <a href="/">
            @endif
                <img src="<?php echo env('APP_URL'); ?>/imgs/lnkrr_black_circle.png" alt="<?php echo env('APP_NAME'); ?> Logo">
                <h4><?php echo env('APP_NAME'); ?></h4>
            </a>
        </div>
        <div class="header_nav">
            <ul>
                <!-- See if the user is logged in -->
                @if(Auth::check())
                    <li class="{{ $page == 'home' ? 'active' : '' }}"><a href="{{ route('home')}}">Home</a></li>
                    <li class="{{ $page == 'me' ? 'active' : '' }}"><a href="{{ route('me')}}">Me</a></li>
                    <li class="{{ $page == 'to' ? 'active' : '' }}"><a href="{{ route('to', Auth::user()->url)}}">Profile</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @else
                    <li class="{{ $page == 'about' ? 'active' : '' }}"><a href="{{ route('about')}}">About</a></li>
                    <li class="{{ $page == 'login' ? 'active' : '' }}"><a href="{{ route('login')}}">Login</a></li>
                    <li class="{{ $page == 'register' ? 'active' : '' }}"><a href="{{ route('register')}}">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</header>