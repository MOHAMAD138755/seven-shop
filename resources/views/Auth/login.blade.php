<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <meta name="description" content="">
    @vite(['resources/css/LoginStyle.css','resources/css/Animation.css'])
    <title>Login</title>
</head>
<body style="background-image: url({{ asset('storage/photo_web/logo.webp') }})">

<div>
    <button class="fa">
        <a href="{{ route('user.login',['lang' => 'fa']) }}">فارسی</a>
    </button>

    <button class="en">
        <a href="{{ route('user.login',['lang' => 'en']) }}">English</a>
    </button>
</div>

<div class="container">

    <div class="rings">
        <div class="ring r1"></div>
        <div class="ring r2"></div>
        <div class="ring r3"></div>
    </div>

    <div class="Form-container">
        <h2>{{ __('main.login') }}</h2>
        <form action="{{ route('login-user',['lang' => app()->getLocale() ]) }}" method="post">
            @csrf
            <div class="Input-Box">
                <input type="text" name="name" required>
                <span>{{ __('main.username') }}</span>
            </div>
            <br>
            <div class="Input-Box">
                <input type="password" name="password" required>
                <span>{{ __('main.password') }}</span>
            </div>
            <br>
            <div class="Input-Box">
                <input type="checkbox" name="remember">
                <span class="remember-text">{{ __('main.remember') }}</span>
            </div>
            <br>
            <div class="Input-Box">
                <a href="{{ route('new-password',['lang' => app()->getLocale()]) }}">{{ __('main.reset') }}</a>
            </div>
            <br>
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
            <br>
            <button type="submit" class="login-button">{{ __('main.send') }}</button>
        </form>
    </div>

</div>
@include('Errors.error')
</body>
</html>
