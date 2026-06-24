<footer id="footer" class="footer">
    <div class="footer-grid">
{{--@dd($settings)--}}
        <div>
            <h3>سون شاپ</h3>
            <p>بهترین تجربه خرید آنلاین</p>
        </div>

        <div>
            <h4>لینک‌ها</h4>
            <p><i class="fa-brands fa-instagram"></i> {{ $settings['instagram'] }}</p>
            <p><i class="fa-brands fa-telegram"></i> {{ $settings['telegram'] }}</p>
            <p><i class="fa-brands fa-youtube"></i> {{ $settings['youtube'] }}</p>
        </div>

        <div>
            <h4>پشتیبانی</h4>
            <p><i class="fa-solid fa-phone"></i> {{ $settings['phone'] }}</p>
            <p><i class="fa-solid fa-envelope"></i> {{ $settings['email'] }}</p>
        </div>

    </div>

</footer>
