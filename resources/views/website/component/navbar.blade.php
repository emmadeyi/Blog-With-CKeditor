{{-- Navigation Bar --}}

<nav class="navbar container">
    <a  href="{{route('index')}}">
        <h2 class="logo">
            <img src="{{asset('template/img/logo/logo.png')}}" alt="{{ env('APP_NAME') }}" class="logo">
        </h2>
    </a>
    <div class="menu" id="menu">
        <ul class="list">
            <li class="list-item">
                <a href="{{route('index')}}" class="list-link current">Home</a>
            </li>
            <li class="list-item">
                <a href="{{route('posts')}}" class="list-link">News</a>
            </li>
            <li class="list-item">
                <a href="{{route('categories')}}" class="list-link">#All Tags</a>
            </li>
            @if($navtags->count() > 0)
                @foreach($navtags as $category)
                    @if($category->posts->count() > 0)
                    <li class="list-item">
                        <a href="{{route('category.details', $category->slug)}}" class="list-link">{{$category->name}}</a>
                    </li>
                    @endif
                @endforeach
            @endif
            <li class="list-item">
                <a href="#contact" class="list-link">Contact</a>
            </li>
            {{-- <li class="list-item screen-lg-hidden">
                <a href="{{route('login')}}" class="list-link">Sign in</a>
            </li>
            <li class="list-item screen-lg-hidden">
                <a href="{{route('register')}}" class="list-link">Sign up</a>
            </li> --}}
        </ul>
    </div>

    <div class="list list-right">
        {{-- <button class="btn place-items-center" id="theme-toggle-btn">
            <i class="ri-sun-line sun-icon"></i>
            <i class="ri-moon-line moon-icon"></i>
        </button>
        <button class="btn place-items-center" id="search-icon">
            <i class="ri-search-line"></i>
        </button> --}}
        <button class="btn place-items-center screen-lg-hidden menu-toggle-icon" id="menu-toggle-icon">
            <i class="ri-menu-3-line open-menu-icon"></i>
            <i class="ri-close-line close-menu-icon"></i>
        </button>
        {{-- <a href="{{route('login')}}" class="list-link screen-sm-hidden">Sign in</a>
        <a href="{{route('register')}}" class="list-link screen-sm-hidden btn sign-up-btn fancy-border">
            <span>Sign up</span>
        </a> --}}
    </div>
</nav>