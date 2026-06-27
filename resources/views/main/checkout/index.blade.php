@extends('main.layout.layout')

@section('content')

    <div class="checkout-container">

        <div class="form-section">

            <h2>تسویه حساب</h2>

            <form id="checkoutForm" action="{{ route('checkout.submit',['lang' => app()->getLocale()]) }}" method="post">
                @csrf
                <div class="row">

                    <div class="input-group">
                        <label>نام و نام خانوادگی</label>
                        <input type="tel" name="full_name">
                    </div>

                    <div class="input-group">
                        <label>شماره تماس</label>
                        <input type="tel" name="phone">
                    </div>
                </div>

                <div class="input-group">
                    <label>آدرس کامل</label>
                    <textarea rows="4" name="address"></textarea>
                </div>

                <div class="input-group">
                    <label>توضیحات(اختیاری)</label>
                    <textarea rows="4" name="description"></textarea>
                </div>
            <button type="submit" class="buy-btn" style="width: 100%">ثبت سفارش و پرداخت</button>
            </form>

        </div>

        <div class="summary">

            <h2>خلاصه سفارش</h2><br>
            @forelse($carts as $cart)
            <div class="product">
                <span>نام محصول: {{ $cart->product->name }}</span>
                <p style="color: #00ff15">قیمت: {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($cart->product->price / 10) : number_format($cart->product->price)}}</p>
            </div>
            @empty
                <p style="text-align: center;margin: 30px;color: red">محصولی وجود ندارد</p>
            @endforelse
            <div class="total">
                <p style="color: #00ff15">قیمت کل: {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($cart->product->price / 10) : number_format($cart->product->price)}}</p>
            </div>

        </div>

    </div>

    <script>
        const cardInput = document.getElementById("card");

        cardInput.addEventListener("input", (e) => {

            let value = e.target.value
                .replace(/\D/g, "")
                .substring(0, 16);

            let parts = value.match(/.{1,4}/g);

            e.target.value = parts
                ? parts.join("-")
                : "";
        });

        document
            .getElementById("checkoutForm")
            .addEventListener("submit", function(e){

                e.preventDefault();

                const name =
                    document.getElementById("fullname")
                        .value
                        .trim();

                if(name.length < 3){
                    alert("نام و نام خانوادگی معتبر وارد کنید");
                    return;
                }

                document.getElementById("successMsg")
                    .style.display = "block";

                this.reset();
            });
    </script>

@endsection
