<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <meta name="description" content="">
    <title>Register</title>
    @vite(['resources/js/app.js'])
</head>
<body style="background-image: url('{{ asset('storage/photo_web/logo.webp') }}')">

<div>
    <button class="fa">
        <a href="{{ route('user.login',['lang' => 'fa']) }}">فارسی</a>
    </button>

    <button class="en">
        <a href="{{ route('user.login',['lang' => 'en']) }}">English</a>
    </button>
</div>

<div class="container">

    {{--    <div class="rings">--}}
    {{--        <div class="ring r1"></div>--}}
    {{--        <div class="ring r2"></div>--}}
    {{--        <div class="ring r3"></div>--}}
    {{--    </div>--}}

    <div class="Form-container">
        <h2>{{ __('main.register') }}</h2>
        <form action="{{ route('register-user',['lang' => app()->getLocale() ]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="Input-Box">
                <input type="text" name="username" required>
                <span>{{ __('main.username') }}</span>
            </div>
            <br>
            <div class="Input-Box">
                <input type="password" name="password" required>
                <span>{{ __('main.password') }}</span>
            </div>
            <br>
            <div class="Input-Box">
                <input type="password" name="password_confirmation" required>
                <span>{{ __('main.repass') }}</span>
            </div>
            <br>
            <div class="Input-Box">
                <input type="email" name="email" required>
                <span>{{ __('main.email') }}</span>
            </div>
            <br>
            <div class="Input-Box">
                <input type="file" name="img" required>
            </div>
            <br>
            <button type="submit" class="login-button">{{ __('main.send') }}</button>
        </form>
    </div>

</div>
@include('Errors.error')
</body>
</html>
