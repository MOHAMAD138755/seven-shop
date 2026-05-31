<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <style>
        .validation-alert {
            position: relative;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            background: linear-gradient(135deg, #ff4d4d, #d90429);
            color: #fff;
            padding: 18px 20px;
            border-radius: 16px;
            margin-bottom: 20px;
            box-shadow: 0 15px 35px rgba(217, 4, 41, 0.3);
            animation: slideDown .4s ease;
            overflow: hidden;
        }

        .validation-alert::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,.08);
            backdrop-filter: blur(5px);
        }

        .alert-icon {
            font-size: 32px;
            z-index: 1;
        }

        .alert-content {
            flex: 1;
            z-index: 1;
        }

        .alert-content h4 {
            margin: 0 0 10px;
            font-size: 18px;
            font-weight: 700;
        }

        .alert-content ul {
            margin: 0;
            padding-right: 20px;
        }

        .alert-content li {
            margin-bottom: 6px;
            line-height: 1.7;
        }

        .alert-close {
            z-index: 1;
            border: none;
            background: rgba(255,255,255,.15);
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            cursor: pointer;
            transition: .3s;
        }

        .alert-close:hover {
            background: rgba(255,255,255,.3);
            transform: rotate(90deg);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
@if ($errors->any())
    <div class="validation-alert">
        <div class="alert-icon">
            ⚠️
        </div>

        <div class="alert-content">
            <h4>خطا در ارسال اطلاعات</h4>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        <button class="alert-close" onclick="this.parentElement.remove()">
            ✕
        </button>
    </div>
@endif
</body>
</html>
