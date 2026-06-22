<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سون شاپ</title>

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
            <a href="#">خانه</a>
            <a href="#">محصولات</a>
            <a href="#">دسته‌بندی</a>
            <a href="#">تخفیف‌ها</a>
            <a href="#">تماس</a>
        </nav>

        <div class="actions">
            <button class="icon-btn" id="menuBtn">☰</button>
            <button class="icon-btn cart-btn" id="cartBtn">
                🛒 <span id="cartCount">0</span>
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

<section class="container categories">

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
<footer class="footer">
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
