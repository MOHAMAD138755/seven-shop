
@extends('main.layout.layout')

@section('content')

    <!-- PRELOADER -->
    <div id="preloader">
        <div class="loader"></div>
    </div>


    <!-- HERO -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="fade">{{__('main.smart shopping with seven shop')}}</h1>
            <p class="fade">{{__('main.A fast , Modern and Reliable Shopping Experience')}}</p>
            <a href="#product">
                <button class="fade">{{__('main.View Products')}}</button>
            </a>
            <a href="{{ route('home',['lang' =>app()->getLocale() == 'fa' ? 'en' : 'fa']) }}">
                <button class="fade">تغییر زبان سایت(change lang)</button>
            </a>
        </div>
    </section>

    <h2 class="cat-title">{{__('main.View Categories')}}</h2>
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
            <p>{{__('main.View Not Found Categories')}}</p>
        @endforelse
        {{ $categories->links() }}

    </section>

    <!-- PRODUCTS -->
    <section id="product" class="container">
        <h2 class="title">🔥 {{__('main.New Products')}}</h2>

        <div class="grid">

            @forelse($newProducts as $newProduct)
                @include('main.partials.new-product',['newProduct' => $newProduct])
            @empty
                <p>{{__('main.Not Found Products')}}</p>
            @endforelse

        </div>
    </section>

    <!-- PRODUCTS -->
    <section id="product" class="container">
        <h2 class="title">🔥{{__('main.Best Selling Products')}}</h2>

        <div class="grid">

            @forelse($BestSellers as $BestSeller)
                @include('main.partials.BestSellers',['BestSellers' => $BestSellers])
            @empty
                <p>{{__('main.Not Found Products')}}</p>
            @endforelse

        </div>
    </section>

    <!-- PRODUCTS -->
    <section id="product" class="container">
        <h2 class="title">🔥{{__('main.Best Favorite Products')}}</h2>

        <div class="grid">

            @forelse($BestLikes as $BestLike)
                @include('main.partials.BestLikes',['BestLike' => $BestLike])
            @empty
                <p>{{__('main.Not Found Products')}}</p>
            @endforelse

        </div>
    </section>


    <button id="backToTop">↑</button>


@endsection
