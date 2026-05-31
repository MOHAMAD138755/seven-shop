<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <meta name="description" content="">
    @vite(['resources/js/app.js'])
    <title>new password</title>
</head>
<body>

<div>
    <button class="fa">
        <a href="{{ route('new-password',['lang' => 'fa']) }}">فارسی</a>
    </button>

    <button class="en">
        <a href="{{ route('new-password',['lang' => 'en']) }}">English</a>
    </button>
</div>

<div class="container">

    <div class="rings">
        <div class="ring r1"></div>
        <div class="ring r2"></div>
        <div class="ring r3"></div>
    </div>

    <div class="Form-container">
        <h2>{{ __('main.new_password') }}</h2>
        <form action="{{ route('update-password-user',['lang' => app()->getLocale()]) }}" method="post">
            @csrf
            <div class="Input-Box">
                <input type="email" name="email" required>
                <span>{{ __('main.email') }}</span>
            </div>
            <br>
            <button type="submit" class="login-button">{{ __('main.send') }}</button>
        </form>
    </div>

</div>
@include('Errors.error')
</body>
</html>
