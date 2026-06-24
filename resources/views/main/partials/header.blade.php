<header class="header">
    <div class="container">

        <div class="logo">سون شاپ</div>

        <nav class="nav" id="nav">
            <a href="{{ route('home',['lang' => app()->getLocale()]) }}">خانه</a>
            <a href="{{ url('/'.app()->getLocale().'#product') }}">محصولات</a>
            <a href="{{ url('/'.app()->getLocale().'#category') }}">دسته‌بندی</a>

            @guest
                <a href="{{ route('user.register',['lang' => app()->getLocale()]) }}">ثبت نام</a>
                <a href="{{ route('user.login',['lang' => app()->getLocale()]) }}">ورود</a>
            @endguest

            @auth
                <a href="{{ route('cart.show',['lang' => app()->getLocale()]) }}">🛒سبد خرید</a>
                <form method="POST" action="{{ route('home.logout',['lang' => app()->getLocale()]) }}">
                    @csrf
                    <button style="width: 70px;cursor: pointer;border: none;border-radius: 5px;height: 25px;color: white;background-color: red" type="submit">خروج</button>
                </form>
                <a href="{{ route('home.profile',['lang' => app()->getLocale()]) }}">پروفایل شما</a>
            @endauth

            <a href="{{ url('/'.app()->getLocale().'#footer') }}">درباره ما</a>

            @if(auth()->check() &&
                 (auth()->user()->hasRole('administrator') || auth()->user()->hasRole('writer')))
                <a href="{{ route('Dashboard.َAdmin',['lang' => app()->getLocale()]) }}">پنل ادمین</a>
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
