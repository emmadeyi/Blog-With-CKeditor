<div class="header bg-dark">
    <div class="header-left">
        <a href="{{ url('/') }}" class="logo">
            <span><img src="{{asset('template/img/logo/logo.png')}}" alt="{{ env('APP_NAME') }}" class="logo"></span>
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
    <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
    <ul class="nav user-menu float-right">
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif
            
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else                      
            <li class="nav-item">
                <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                    </a>
    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
            </li>            
        @endguest
    </ul>
    <div class="dropdown mobile-user-menu float-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('accounts.edit', Auth::user()->id)}}">Edit Profile</a>
            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
        </div>
    </div>
</div>