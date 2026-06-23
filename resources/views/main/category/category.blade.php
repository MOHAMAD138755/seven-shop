
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
                <button style="background-color: green;cursor: pointer;margin-right: 70px;color: white;margin-top: 20px" class="card button">افزودن به سبد</button>
            </div>
            @empty
                <p>محصولی یافت نشد</p>
            @endforelse
        </div>
    </section>

@endsection
