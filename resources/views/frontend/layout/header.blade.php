    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5 wow fadeIn"
        style="background-color:black !important" data-wow-delay="0.1s">
        <a href="{{ route('home') }}" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="text-primary m-0">Baker</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto p-4 p-lg-0">
                <a href="{{ route('home') }}" class="nav-item nav-link @if(Route::currentRouteName() == 'home') active @endif">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link @if(Route::currentRouteName() == 'about') active @endif">About</a>
                <a href="{{ route('service') }}" class="nav-item nav-link @if(Route::currentRouteName() == 'service') active @endif">Services</a>
                <a href="{{ route('cart.index') }}" class="nav-item nav-link @if(Route::currentRouteName() == 'cart.index') active @endif">Cart</a>
            </div>
            <div class=" d-none d-lg-flex">
                @guest

                <a href="{{ route('login') }}">
                    <div class="flex-shrink-0 btn-lg-square border border-light rounded-circle">

                        <i class="fa-solid fa-arrow-right-to-bracket fs-4"></i>

                    </div>
                </a>

                @endguest

                @auth

                    <a href="{{ route('profile') }}">
                    <div class="flex-shrink-0 btn-lg-square border border-light rounded-circle">

                        <i class="fa-solid fa-user fs-4"></i>

                    </div>
                </a>

                @endauth

            </div>
        </div>
    </nav>
    <!-- Navbar End -->
