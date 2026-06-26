<div class="card reveal">
    <div>
        <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}">
    </div>
    <h3>{{ $product->name }}</h3>
    <p style="color: #00ff15">قیمت: {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($product->price / 10) : number_format($product->price)}}</p>
    <p style="color: blue">تعداد موحود: {{ $product->count }}</p>
    <form action="{{ route('cart.create',['lang' => app()->getLocale()]) }}" method="post">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <label for="count">تعداد: </label>
        <input type="number" name="count" id="count">
        <br><br>
        <button class="buy-btn" type="submit">
            افزودن به سبد خرید
        </button>
    </form>
    <a href="{{ route('home.product',['lang' => app()->getLocale(),'product' => $product->slug]) }}">
        <button style="background-color: red;cursor: pointer">اطلاعات بیشتر...</button>
    </a>
</div>
