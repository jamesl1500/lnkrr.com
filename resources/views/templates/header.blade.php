<header class="header container">
    <div class="header_inner">
        <div class="header_logo">
            <a href="{{ route('me') }}">
                <img src="{{ asset('imgs/lnkrr_black_circle.png') }}" alt="<?php echo env('APP_NAME'); ?> Logo">
                <h4><?php echo env('APP_NAME'); ?></h4>
            </a>
        </div>
        <div class="header_nav">
            <ul>
                <li class="{{ $page == 'home' ? 'active' : '' }}"><a href="{{ route('home')}}">Home</a></li>
                <li class="{{ $page == 'me' ? 'active' : '' }}"><a href="{{ route('me')}}">Me</a></li>
                <li class="{{ $page == 'settings' ? 'active' : '' }}"><a href="{{ route('settings')}}">Settings</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</header>