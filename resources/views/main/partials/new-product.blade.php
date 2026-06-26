<div class="card reveal">
    <div>
        <img src="{{ \Illuminate\Support\Facades\Storage::url($newProduct->image) }}">
    </div>
    <h3>{{ $newProduct->name }}</h3>
    <p style="color: #00ff15">قیمت: {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($newProduct->price / 10) : number_format($newProduct->price)}}</p>
    <p style="color: blue">تعداد موحود: {{ $newProduct->count }}</p>

        <form action="{{ route('cart.create',['lang' => app()->getLocale()]) }}" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $newProduct->id }}">
            <label for="count">تعداد: </label>
            <input type="number" name="count" id="count">
            <br><br>
            <button class="buy-btn" type="submit">
                {{__('main.Add To Cart')}}
            </button>
        </form>

    <a href="{{ route('home.product',['lang' => app()->getLocale(),'product' => $newProduct->slug]) }}">
    <button style="background-color: red;cursor: pointer">{{__('main.More Information')}}</button>
    </a>
</div>
