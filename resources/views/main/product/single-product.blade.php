@extends('main.layout.layout')

@section('title',$settings['site_name'])

@section('description',$settings['meta_description'])

@section('content')
    <div class="container">

        <div class="product-card">

            <div class="gallery">

                <div class="main-image">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" alt="تصویر محصول">
                </div>

            </div>

            <div class="product-info">


                <h1 class="product-title">
                    {{ $product->name }}
                </h1>

{{--                <div class="rating">--}}
{{--                    ★★★★★ (4.9)--}}
{{--                </div>--}}

                <p class="description">
                    توضیحات: {{ $product->description }}
                </p>

                <div class="price-box">
                    <p style="color: #00ff15">قیمت: {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($product->price / 10) : number_format($product->price)}}</p>
                </div>

                <div class="features">

                    <div class="feature">
                        <span>تعداد موجود</span>
                        <strong>{{ $product->count }}</strong>
                    </div>

                    <div class="feature">
                        <span>زمان گذاشتن شدن محصول: </span>
                        <strong>{{ \Morilog\Jalali\Jalalian::fromDateTime($product->created_at)->format('Y-m-d') }}</strong>
                    </div>

                </div>

                <div class="actions">
                    <button class="buy-btn">
                        افزودن به سبد خرید
                    </button>

{{--                    <button class="wishlist">--}}
{{--                        ❤--}}
{{--                    </button>--}}
                </div>

            </div>

        </div>

    </div>
@endsection
