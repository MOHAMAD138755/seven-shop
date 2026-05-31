<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ایمیل ارسال شد</title>

    <style>
        body {
            margin: 0;
            font-family: Tahoma, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #fff;
            width: 420px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        .icon {
            font-size: 60px;
            margin-bottom: 10px;
        }

        h2 {
            margin: 10px 0;
            color: #333;
        }

        p {
            color: #666;
            font-size: 14px;
            line-height: 1.8;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #3730a3;
        }

        .small {
            margin-top: 15px;
            font-size: 12px;
            color: #999;
        }

        @media (max-width: 480px) {
            .card {
                width: 90%;
            }
        }
    </style>

</head>

<body>

<div class="card">

    <div class="icon">📩</div>

    <h2>ایمیل ارسال شد</h2>

    <p>
        <a href="{{ route('lastet-reset-password-user',['lang' => app()->getLocale() , 'token' => $token , 'email' => $user['email']]) }}">
            برای ادامه کلیک کنید
        </a>
    </p>

    <a href="{{ route('user.login',['lang' => app()->getLocale()]) }}" class="btn">بازگشت به صفحه ورود</a>

    <div class="small">
        اگر ایمیلی دریافت نکردید، پوشه Spam را بررسی کنید.
    </div>

</div>

</body>
</html>
