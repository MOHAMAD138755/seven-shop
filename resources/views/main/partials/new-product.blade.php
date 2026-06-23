<div class="card reveal">
    <div>
        <img src="{{ \Illuminate\Support\Facades\Storage::url($newProduct->image) }}">
    </div>
    <h3>{{ $newProduct->name }}</h3>
    <p style="color: #00ff15">قیمت: {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($newProduct->price / 10) : number_format($newProduct->price)}}</p>
    <p style="color: blue">تعداد موحود: {{ $newProduct->count }}</p>
    <button style="background-color: green;cursor: pointer">افزودن به سبد</button>
    <a href="{{ route('home.product',['lang' => app()->getLocale(),'product' => $newProduct->slug]) }}">
    <button style="background-color: red;cursor: pointer">اطلاعات بیشتر...</button>
    </a>
</div>
