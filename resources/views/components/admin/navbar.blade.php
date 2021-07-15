@php($route_prefix = NULL)
    @if (auth()->user()->role == 'kaprodi')
        @php($route_prefix = 'admin')
    @else
        @php($route_prefix = 'kjfd')
    @endif
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm mb-2">
    <div class="container-fluid pl-4">
        <a class="navbar-brand" href="{{ url($route_prefix.'/dashboard') }}">
            {{$brand}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ route('logout') }}">Keluar</a>
                        {{-- <a class="nav-link"  href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">Keluar</a> --}}
                    </li>
                    {{-- <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li> --}}
                @endguest
            </ul>
        </div>
    </div>
</nav>

@yield('content')