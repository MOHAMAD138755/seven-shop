@extends('main.layout.layout')

@section('title',$settings['site_name'])

@section('description',$settings['meta_description'])

@section('content')

    <div class="checkout-container">

        <div class="form-section">

            <h2>تسویه حساب</h2>

            <form id="checkoutForm">

                <div class="row">

                    <div class="input-group">
                        <label>نام و نام خانوادگی</label>
                        <input type="tel" id="phone">
                    </div>

                    <div class="input-group">
                        <label>شماره تماس</label>
                        <input type="tel" id="phone">
                    </div>
                </div>

                <div class="input-group">
                    <label>آدرس کامل</label>
                    <textarea id="address" rows="4"></textarea>
                </div>

            </form>

        </div>

        <div class="summary">

            <h2>خلاصه سفارش</h2>

            <div class="product">
                <span>محصول شماره ۱</span>
                <span>500,000 تومان</span>
            </div>

            <div class="product">
                <span>محصول شماره ۲</span>
                <span>300,000 تومان</span>
            </div>

            <div class="product">
                <span>هزینه ارسال</span>
                <span>50,000 تومان</span>
            </div>

            <div class="total">
                جمع کل: 850,000 تومان
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
