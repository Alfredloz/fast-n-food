<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container d_flex nav_container">
        <div class="left_navbar">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('/images/logo-v2.svg') }}" alt="Logo brand" height="50px">
            </a>
        </div>
        <div class="right_navbar">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav right_nav">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item list_item">
                        <a class="nav_btns" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item list_item ">
                            <a class="nav_btns" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->full_name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item nav_btns" href="{{ route('admin.index') }}">
                              Dashboard
                          </a>
                          <a class="dropdown-item nav_btns" href="{{ route('logout') }}" onclick="event.preventDefault();
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
    </div>
</nav>
