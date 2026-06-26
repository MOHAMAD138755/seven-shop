<header class="header">
    <div class="container">

        <div class="logo">سون شاپ</div>

        <nav class="nav" id="nav">
            <a href="{{ route('home',['lang' => app()->getLocale()]) }}">خانه <i class="fa-solid fa-house"></i></a>
            <a href="{{ url('/'.app()->getLocale().'#product') }}">محصولات<i class="fa-solid fa-box-open"></i></a>
            <a href="{{ url('/'.app()->getLocale().'#category') }}">دسته‌بندی<i class="fa-solid fa-layer-group"></i></a>

            @guest
                <a href="{{ route('user.register',['lang' => app()->getLocale()]) }}">ثبت نام</a>
                <a href="{{ route('user.login',['lang' => app()->getLocale()]) }}">ورود</a>
            @endguest

            <div>
            <form action="{{ route('home.search',['lang' => app()->getLocale()]) }}" method="get">
            <input id="search-bar" name="name" placeholder="جستجوی محصول">
                <button type="submit"></button>
            </form>
            </div>

            @auth
                <a href="{{ route('cart.show',['lang' => app()->getLocale()]) }}">سبد خرید<i class="fa-solid fa-cart-shopping"></i></a>
                <form method="POST" action="{{ route('home.logout',['lang' => app()->getLocale()]) }}">
                    @csrf
                    <button style="width: 70px;cursor: pointer;border: none;border-radius: 5px;height: 25px;color: white;background-color: red" type="submit">خروج<i class="fa-solid fa-right-from-bracket"></i></button>
                </form>
                <a href="{{ route('home.profile',['lang' => app()->getLocale()]) }}">پروفایل شما<i class="fa-solid fa-user"></i></a>
                <a href="{{ route('reaction.show',['lang' => app()->getLocale()]) }}">موارد پسندیده شده<i class="fa-solid fa-heart"></i></a>
            @endauth

            <a href="{{ url('/'.app()->getLocale().'#footer') }}">درباره ما<i class="fa-solid fa-circle-info"></i></a>

            @if(auth()->check() &&
                 (auth()->user()->hasRole('administrator') || auth()->user()->hasRole('writer')))
                <a href="{{ route('Dashboard.َAdmin',['lang' => app()->getLocale()]) }}">پنل ادمین<i class="fa-solid fa-gauge-high"></i></a>
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
