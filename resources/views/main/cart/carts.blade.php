@extends('main.layout.layout')

@section('title',$settings['site_name'])

@section('description',$settings['meta_description'])

@section('content')

    <section class="items">

        @forelse($carts as $cart)
        <div class="item">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($cart->product->image) }}" alt="تصویر محصول">

            <div class="info">
                <h3>نام محصول: {{ $cart->product->name }}</h3>
                <span>توضیحات: {{ $cart->product->description }}</span>
                <br>
                <span>تعداد انتخاب شده: {{ $cart->quantity }}</span>
                <br>
                <span>تعداد موجود: {{ $cart->product->count }}</span>
            </div>

            <div class="qty">
                <form action="{{ route('cart.update',['lang' => app()->getLocale(),'cart' => $cart->id]) }}" method="post">
                    @csrf @method('PUT')
                    <label>ویرایش تعداد: </label>
                    <input type="number" name="count" value="{{ $cart->quantity }}">
                    <button type="submit" style="background-color: blueviolet;width: 100%;color: white;padding: 5px">ویرایش</button>
                </form>
            </div>

            <div class="price">
                <p style="color: #00ff15">قیمت: {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($cart->product->price / 10) : number_format($cart->product->price)}}</p>
            </div>

        </div>



    </section>

    <aside class="summary">
        <h3>جمع سفارش</h3>

        <div>
            <span>مبلغ کل</span>
            <strong>1,250,000 تومان</strong>
        </div>
        <a href="{{ route('home.product',['lang' => app()->getLocale(),'product' => $cart->product->slug]) }}">
            <button style="background-color: red;cursor: pointer">اطلاعات بیشتر...</button>
        </a>

        <form action="{{ route('cart.delete',['lang' => app()->getLocale()]) }}" method="post">
            @csrf @method('DELETE')
            <input type="hidden" name="cart_id" value="{{ $cart->id }}">
            <button style="background-color: blue;cursor: pointer" type="submit">حذف محصول</button>
        </form>

        @empty
            <p style="text-align: center;margin: 30px;color: red">سبد خرید خالی است</p>
        @endforelse

        @if($carts->count() > 0)
        <button>
            ادامه خرید
        </button>
        @endif
    </aside>

<script>
    document.querySelectorAll(".cart-item").forEach(item => {

        const plus = item.querySelector(".plus");
        const minus = item.querySelector(".minus");
        const quantity = item.querySelector(".quantity");

        plus.addEventListener("click", () => {
            quantity.textContent =
                Number(quantity.textContent) + 1;
        });

        minus.addEventListener("click", () => {
            if (Number(quantity.textContent) > 1) {
                quantity.textContent =
                    Number(quantity.textContent) - 1;
            }
        });

        item.querySelector(".remove-btn")
            .addEventListener("click", () => {
                item.remove();
            });
    });
</script>
@endsection
