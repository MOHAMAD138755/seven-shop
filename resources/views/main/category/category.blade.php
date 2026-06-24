
@extends('main.layout.layout')

@section('title','محصولات')

@section('description','محصولات این دسته بندی')

@section('content')
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <section id="product" class="container">
        <h2 class="title">🔥 محصولات این دسته بندی</h2>

        <div class="grid">
            @forelse($category->products as $item)
            <div style="margin: 20px">
                <div>
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($item->image) }}" alt="تصویر محصول">
                </div>
                <h3 style="text-align: center;padding: 5px;color: red">نام محصول: {{ $item->name }}</h3>
                <p style="color: #00ff15">قیمت: {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($item->price / 10) : number_format($item->price)}}</p>
                <p style="color: blue">تعداد موحود: {{ $item->count }}</p>
                <div>
                    <form action="{{ route('cart.create',['lang' => app()->getLocale()]) }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                        <label for="count">تعداد: </label>
                        <input type="number" name="count" id="count">
                        <br><br>
                        <button class="buy-btn" style="width: 100%" type="submit">
                            افزودن به سبد خرید
                        </button>
                    </form>

                <a href="{{ route('home.product',['lang' => app()->getLocale(),'product' => $item->slug]) }}">
                    <button style="background-color: red;cursor: pointer;color: white;margin-top: 20px;width: 100%" class="card button">اطلاعات بیشتر...</button>
                </a>
                </div>
            </div>
            @empty
                <p>محصولی یافت نشد</p>
            @endforelse
        </div>
    </section>

@endsection
