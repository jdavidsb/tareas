<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('messages.register') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('messages.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
            <ul class="navbar-nav navbar-right">
              <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                  {{ __('messages.lang') }} <span class="caret"></span> {{-- session()->get('idioma') --}} {{-- App::getLocale() --}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a href="{{ url('/idioma/es') }}"><img src="{{ asset('img/spain.png') }}" alt="{{ __('messages.spanish') }}" width="40" height="30" class="img-rounded center-block">{{ __('messages.spanish') }}</a>
                  <br>
                  <a href="{{ url('/idioma/en') }}"><img src="{{ asset('img/uk.png') }}" alt="{{ __('messages.english') }}" width="40" height="30" class="img-rounded center-block">{{ __('messages.english') }}</a>
                </div>
              </li>
            </ul>
        </div>
    </div>
</nav>
