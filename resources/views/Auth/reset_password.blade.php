<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <meta name="description" content="">
    @vite(['resources/js/app.js'])
    <title>Login</title>
</head>
<body>

<div class="container">

    <div class="rings">
        <div class="ring r1"></div>
        <div class="ring r2"></div>
        <div class="ring r3"></div>
    </div>

    <div class="Form-container">
        <h2>تغییر رمز</h2>
        <form action="{{ route('update-user',['lang' => app()->getLocale()]) }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $user }}">
            <div class="Input-Box">
                <input type="password" name="password" required>
                <span>{{ __('main.password') }} جدید</span>
            </div>
            <br>
            <div class="Input-Box">
                <input type="password" name="password_confirmation" required>
                <span>{{ __('main.repass') }}</span>
            </div>
            <br>
            <button type="submit" class="login-button">{{ __('main.send') }}</button>
        </form>
    </div>

</div>
@include('Errors.error')
</body>
</html>
