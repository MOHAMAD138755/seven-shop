<header class="header">
    <div class="container">

        <div class="logo">{{__('main.Seven Shop')}}</div>

        <nav class="nav" id="nav">
            <a href="{{ route('home',['lang' => app()->getLocale()]) }}">{{__('main.Home')}}<i class="fa-solid fa-house"></i></a>
            <a href="{{ url('/'.app()->getLocale().'#product') }}">{{__('main.Products')}}<i class="fa-solid fa-box-open"></i></a>
            <a href="{{ url('/'.app()->getLocale().'#category') }}">{{__('main.Categories')}}<i class="fa-solid fa-layer-group"></i></a>

            @guest
                <a href="{{ route('user.register',['lang' => app()->getLocale()]) }}">{{__('main.register')}}</a>
                <a href="{{ route('user.login',['lang' => app()->getLocale()]) }}">{{__('main.login')}}</a>
            @endguest

            <div>
            <form action="{{ route('home.search',['lang' => app()->getLocale()]) }}" method="get">
            <input id="search-bar" name="name" placeholder="{{__('main.Search Products...')}}">
                <button type="submit"></button>
            </form>
            </div>

            @auth
                <a href="{{ route('cart.show',['lang' => app()->getLocale()]) }}">{{__('main.Carts')}}<i class="fa-solid fa-cart-shopping"></i></a>
                <form method="POST" action="{{ route('home.logout',['lang' => app()->getLocale()]) }}">
                    @csrf
                    <button style="width: 70px;cursor: pointer;border: none;border-radius: 5px;height: 25px;color: white;background-color: red" type="submit">{{__('main.Exit')}}<i class="fa-solid fa-right-from-bracket"></i></button>
                </form>
                <a href="{{ route('home.profile',['lang' => app()->getLocale()]) }}">{{__('main.User Profile')}}<i class="fa-solid fa-user"></i></a>
                <a href="{{ route('reaction.show',['lang' => app()->getLocale()]) }}">{{__('main.Favorite')}}<i class="fa-solid fa-heart"></i></a>
            @endauth

            <a href="{{ url('/'.app()->getLocale().'#footer') }}">{{__('main.About Us')}}<i class="fa-solid fa-circle-info"></i></a>

            @if(auth()->check() &&
                 (auth()->user()->hasRole('administrator') || auth()->user()->hasRole('writer')))
                <a href="{{ route('Dashboard.َAdmin',['lang' => app()->getLocale()]) }}">{{__('main.Admin Panel')}}<i class="fa-solid fa-gauge-high"></i></a>
            @endif

        </nav>

        <div class="actions">
            <button class="icon-btn" id="menuBtn">☰</button>
            <button class="icon-btn cart-btn" id="cartBtn">
                <span id="cartCount">0</span>
            </button>
        </div>

    </div>
</header>
