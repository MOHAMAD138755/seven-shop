<div class="card reveal">
    <div>
        <img src="{{ \Illuminate\Support\Facades\Storage::url($BestLike->image) }}">
    </div>
    <h3>{{ $BestLike->name }}</h3>
    <p style="color: #00ff15">قیمت: {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($BestLike->price / 10) : number_format($BestLike->price)}}</p>
    <p style="color: blue">تعداد موحود: {{ $BestLike->count }}</p>
    <form action="{{ route('cart.create',['lang' => app()->getLocale()]) }}" method="post">
        @csrf
        <input type="hidden" name="product_id" value="{{ $BestLike->id }}">
        <label for="count">تعداد: </label>
        <input type="number" name="count" id="count">
        <br><br>
        <button class="buy-btn" type="submit">
            {{__('main.Add To Cart')}}
        </button>
    </form>
    <a href="{{ route('home.product',['lang' => app()->getLocale(),'product' => $BestLike->slug]) }}">
        <button style="background-color: red;cursor: pointer">{{__('main.More Information')}}</button>
    </a>
</div>
