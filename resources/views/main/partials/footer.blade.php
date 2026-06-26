<footer id="footer" class="footer">
    <div class="footer-grid">
{{--@dd($settings)--}}
        <div>
            <h3>{{__('main.Seven Shop')}}</h3>
            <p>{{__('main.A fast , Modern and Reliable Shopping Experience')}}</p>
        </div>

        <div>
            <h4>{{__('main.Links')}}</h4>
            <p><i class="fa-brands fa-instagram"></i> {{ $settings['instagram'] }}</p>
            <p><i class="fa-brands fa-telegram"></i> {{ $settings['telegram'] }}</p>
            <p><i class="fa-brands fa-youtube"></i> {{ $settings['youtube'] }}</p>
        </div>

        <div>
            <h4>{{__('main.Support')}}</h4>
            <p><i class="fa-solid fa-phone"></i> {{ $settings['phone'] }}</p>
            <p><i class="fa-solid fa-envelope"></i> {{ $settings['email'] }}</p>
        </div>

    </div>

</footer>
