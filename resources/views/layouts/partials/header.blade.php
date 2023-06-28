<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm custom-nav">

        <div class="logo-cont p-3">
            <img class="img-fluid" src="{{asset("images/BDOCTORS-LogoB.jpg")}}" alt="logone">
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto __home-link-ctn">
                <li class="nav-item links-container">
                    <a class="links title-home" href="{{url('/') }}">{{ __('Home') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto d-flex gap-3 align-items-center">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('register'))
                <li class="nav-item links-container">
                    <a class="links" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                </li>
                <li class="nav-item links-container">
                    <a class="links" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown links" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a>
                        <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profilo')}}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>

</nav>
