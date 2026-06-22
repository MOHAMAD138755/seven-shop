<!DOCTYPE html>
<html lang="{{ $settings['language'] ?? 'fa' }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings['meta_description'] ?? '' }}">
    <meta name="keywords" content="سون شاپ,فروشگاه اینترنتی,فروشگاه,seven shop">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>{{ $settings['site_name'] ?? '' }}</title>

    @vite(['resources/css/main.css','resources/js/main.js'])
</head>
<body>

<!-- PRELOADER -->
<div id="preloader">
    <div class="loader"></div>
</div>

<!-- HEADER -->
<header class="header">
    <div class="container">

        <div class="logo">سون شاپ</div>

        <nav class="nav" id="nav">
            <a href="{{ route('home',['lang' => app()->getLocale()]) }}">خانه</a>
            <a href="#product">محصولات</a>
            <a href="#category">دسته‌بندی</a>

            @guest
            <a href="{{ route('user.register',['lang' => app()->getLocale()]) }}">ثبت نام</a>
            <a href="{{ route('user.login',['lang' => app()->getLocale()]) }}">ورود</a>
            @endguest

            @auth
                <a href="#">🛒سبد خرید</a>
                <form method="POST" action="{{ route('home.logout',['lang' => app()->getLocale()]) }}">
                    @csrf
                    <button style="width: 70px;cursor: pointer;border: none;border-radius: 5px;height: 25px;color: white;background-color: red" type="submit">خروج</button>
                </form>
                <a href="#">پروفایل شما</a>
            @endauth

            <a href="#footer">درباره ما</a>

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

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h1 class="fade">خرید هوشمند از سون شاپ</h1>
        <p class="fade">تجربه خرید سریع، مدرن و مطمئن</p>
        <a href="#product">
        <button class="fade">مشاهده محصولات</button>
        </a>
    </div>
</section>

<section id="category" class="container categories">

    <div class="category">
        <div class="icon">📱</div>
        <span>موبایل</span>
    </div>

    <div class="category">
        <div class="icon">💻</div>
        <span>لپ‌تاپ</span>
    </div>

    <div class="category">
        <div class="icon">🎧</div>
        <span>هدفون</span>
    </div>

    <div class="category">
        <div class="icon">⌚</div>
        <span>ساعت هوشمند</span>
    </div>

    <div class="category">
        <div class="icon">🎮</div>
        <span>گیمینگ</span>
    </div>

</section>

<!-- PRODUCTS -->
<section id="product" class="container">
    <h2 class="title">🔥 محصولات ویژه</h2>

    <div class="grid">

        <div class="card reveal">
            <div class="img"></div>
            <h3>گوشی سامسونگ</h3>
            <p>12,000,000 تومان</p>
            <button onclick="addToCart(this)">افزودن به سبد</button>
        </div>

        <div class="card reveal">
            <div class="img"></div>
            <h3>هدفون سونی</h3>
            <p>2,500,000 تومان</p>
            <button onclick="addToCart(this)">افزودن به سبد</button>
        </div>

        <div class="card reveal">
            <div class="img"></div>
            <h3>لپ تاپ ایسوس</h3>
            <p>35,000,000 تومان</p>
            <button onclick="addToCart(this)">افزودن به سبد</button>
        </div>

        <div class="card reveal">
            <div class="img"></div>
            <h3>ساعت هوشمند</h3>
            <p>3,200,000 تومان</p>
            <button onclick="addToCart(this)">افزودن به سبد</button>
        </div>

    </div>
</section>

<!-- CART -->
<div class="cart" id="cart">
    <h3>🛒 سبد خرید</h3>
    <p id="cartText">سبد خرید خالی است</p>
</div>

<!-- FOOTER -->
<footer id="footer" class="footer">
    <div class="footer-grid">

        <div>
            <h3>سون شاپ</h3>
            <p>بهترین تجربه خرید آنلاین</p>
        </div>

        <div>
            <h4>لینک‌ها</h4>
            <a href="#">خانه</a>
            <a href="#">محصولات</a>
            <a href="#">تماس</a>
        </div>

        <div>
            <h4>پشتیبانی</h4>
            <a href="#">سوالات متداول</a>
            <a href="#">تماس با ما</a>
        </div>

    </div>

</footer>

<button id="backToTop">↑</button>

</body>
</html>
