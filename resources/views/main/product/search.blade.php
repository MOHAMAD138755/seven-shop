
@extends('main.layout.layout')

@section('content')

    <!-- PRELOADER -->
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <!-- PRODUCTS -->
    <section id="product" class="container">
        <h2 class="title">نتایج جستجو</h2>

        <div class="grid">

            @forelse($products as $product)
                @include('main.partials.search-product',['product' => $product])
            @empty
                <p>محصولی وجود ندارد</p>
            @endforelse

        </div>
    </section>

    <button id="backToTop">↑</button>


@endsection
