<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>404 - پیدا نشد</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        body {
            height: 100vh;
            background: #0f172a;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            color: white;
        }

        /* background floating circles */
        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(59,130,246,0.2);
            animation: float 10s infinite ease-in-out;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-40px); }
            100% { transform: translateY(0px); }
        }

        .container {
            text-align: center;
            z-index: 10;
        }

        h1 {
            font-size: 140px;
            color: #ef4444;
            text-shadow: 0 0 20px rgba(239,68,68,0.5);
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0%,100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        h2 {
            margin-top: 10px;
            font-size: 28px;
        }

        p {
            margin-top: 10px;
            color: #94a3b8;
        }

        button {
            margin-top: 20px;
            padding: 12px 25px;
            border: none;
            background: #3b82f6;
            color: white;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2563eb;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

<!-- floating circles -->
<div class="circle" style="width:80px;height:80px;top:10%;left:20%"></div>
<div class="circle" style="width:120px;height:120px;top:70%;left:10%"></div>
<div class="circle" style="width:60px;height:60px;top:50%;left:80%"></div>

<div class="container">
    <h1>404</h1>
    <h2>صفحه پیدا نشد 😢</h2>
    <p>ممکنه لینک اشتباه باشه یا صفحه حذف شده باشه</p>
    <button onclick="goHome()">برگشت به خانه 🏠</button>
</div>

<script>
    function goHome() {
        window.location.href = "/";
    }

    // random movement for circles
    document.querySelectorAll('.circle').forEach(c => {
        setInterval(() => {
            c.style.transform = `translate(${Math.random()*30}px, ${Math.random()*30}px)`;
        }, 2000);
    });
</script>

</body>
</html>
