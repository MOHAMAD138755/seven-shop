<div class="card reveal">
    <div>
        <img src="{{ \Illuminate\Support\Facades\Storage::url($newProduct->image) }}">
    </div>
    <h3>{{ $newProduct->name }}</h3>
    <p style="color: #00ff15">قیمت: {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($newProduct->price / 10) : number_format($newProduct->price)}}</p>
    <p style="color: blue">تعداد موحود: {{ $newProduct->count }}</p>
    <button onclick="addToCart(this)">افزودن به سبد</button>
</div>
