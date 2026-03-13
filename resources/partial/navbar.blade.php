<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container">

        {{-- Logo --}}
        <a class="navbar-brand" href="{{ route('home') }}">
            <span>Creatics</span>
        </a>

        {{-- Toggle Button --}}
        <button class="navbar-toggler" type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            {{-- Left Side Links --}}
            <ul class="navbar-nav">

                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('shop') }}">
                        Shop
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('why') }}">
                        Why Us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('testimonial') }}">
                        Testimonial
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">
                        Contact Us
                    </a>
                </li>

            </ul>

            {{-- Right Side Options --}}
            <div class="user_option ml-auto d-flex align-items-center">

                @auth
                    <a href="{{ route('dashboard') }}" class="mr-3">
                        <i class="fa fa-user"></i>
                        <span>Dashboard</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="mr-3">
                        <i class="fa fa-user"></i>
                        <span>Login</span>
                    </a>

                    <a href="{{ route('register') }}" class="mr-3">
                        <i class="fa fa-user"></i>
                        <span>Sign Up</span>
                    </a>
                @endauth

                {{-- Cart --}}
                <a href="{{ route('cartproducts') }}" class="mr-3">
                    <div style="position: relative; display: inline-block;">
                        <i class="fa fa-shopping-cart" style="font-size: 22px;"></i>

                        @if(isset($count) && $count > 0)
                            <span style="
                                position: absolute;
                                top: -8px;
                                right: -10px;
                                background: red;
                                color: white;
                                border-radius: 50%;
                                padding: 2px 6px;
                                font-size: 12px;
                                font-weight: bold;">
                                {{ $count }}
                            </span>
                        @endif
                    </div>
                </a>

                {{-- Search --}}
                <form class="form-inline">
                    <button class="btn nav_search-btn" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>

            </div>
        </div>
    </nav>
</header>