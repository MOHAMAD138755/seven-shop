
@extends('main.layout.layout')

@section('title',$settings['site_name'])

@section('description',$settings['meta_description'])

@section('content')

    <!-- PRELOADER -->
    <div id="preloader">
        <div class="loader"></div>
    </div>


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

    <button id="backToTop">↑</button>


@endsection
