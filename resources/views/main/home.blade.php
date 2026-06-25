
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

    <h2 class="cat-title">دسته بندی ها</h2>
    <section id="category" class="container categories">
        @forelse($categories as $category)
            <a href="{{ route('home.category',['lang' => app()->getLocale(),'category' => $category->name]) }}">
        <div class="category">
            <i class="fa-solid fa-layer-group"></i>
            <span>{{ $category->name }}</span><br>
            <span>{{ $category->english_name }}</span>
        </div>
            </a>
        @empty
            <p>هیچ دسته بندی یافت نشد</p>
        @endforelse
        {{ $categories->links() }}

    </section>

    <!-- PRODUCTS -->
    <section id="product" class="container">
        <h2 class="title">🔥 جدید ترین محصولات</h2>

        <div class="grid">

            @forelse($newProducts as $newProduct)
                @include('main.partials.new-product',['newProduct' => $newProduct])
            @empty
                <p>محصولی وجود ندارد</p>
            @endforelse

        </div>
    </section>

    <!-- PRODUCTS -->
    <section id="product" class="container">
        <h2 class="title">🔥 پر فروش ترین محصولات</h2>

        <div class="grid">

            @forelse($BestSellers as $BestSeller)
                @include('main.partials.BestSellers',['BestSellers' => $BestSellers])
            @empty
                <p>محصولی وجود ندارد</p>
            @endforelse

        </div>
    </section>

    <!-- PRODUCTS -->
    <section id="product" class="container">
        <h2 class="title">🔥 محبوب ترین محصولات</h2>

        <div class="grid">

            @forelse($BestLikes as $BestLike)
                @include('main.partials.BestLikes',['BestLike' => $BestLike])
            @empty
                <p>محصولی وجود ندارد</p>
            @endforelse

        </div>
    </section>

    <!-- CART -->
    <div class="cart" id="cart">
        <h3>🛒 سبد خرید</h3>
        <p id="cartText">سبد خرید خالی است</p>
    </div>

    <button id="backToTop">↑</button>


@endsection
