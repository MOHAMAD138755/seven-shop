<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>در حال تعمیرات</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    <style>

        :root{
            --bg1:#0f172a;
            --bg2:#111827;
            --card:rgba(255,255,255,0.08);
            --border:rgba(255,255,255,0.15);
            --text:#ffffff;
            --muted:rgba(255,255,255,0.75);
            --accent:#38bdf8;
            --accent2:#8b5cf6;
            --shadow:0 20px 60px rgba(0,0,0,.35);
        }

        *{
            box-sizing:border-box;
        }

        .container{
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body{
            margin:0;
            font-family:'Vazirmatn', sans-serif;
            min-height:100vh;
            color:var(--text);
            background:
                radial-gradient(circle at top, rgba(56,189,248,.20), transparent 35%),
                radial-gradient(circle at bottom right, rgba(139,92,246,.20), transparent 30%),
                linear-gradient(135deg, var(--bg1), var(--bg2));
        }


        .card-item{
            width:min(100%, 980px);
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap:32px;
            align-items:center;
            background:var(--card);
            border:1px solid var(--border);
            backdrop-filter: blur(18px);
            border-radius:28px;
            box-shadow:var(--shadow);
            padding:28px;
            position:relative;
            overflow:hidden;
        }

        .card-item::before{
            content:"";
            position:absolute;
            inset:-2px;
            background:linear-gradient(135deg, rgba(56,189,248,.18), rgba(139,92,246,.14), transparent);
            pointer-events:none;
            mask: linear-gradient(#000, transparent 90%);
        }

        .content{
            position:relative;
            z-index:1;
        }

        .badge{
            display:inline-flex;
            align-items:center;
            gap:10px;
            padding:10px 16px;
            border-radius:999px;
            background:rgba(255,255,255,0.08);
            border:1px solid rgba(255,255,255,0.12);
            color:var(--muted);
            font-size:14px;
            margin-bottom:18px;
        }

        .dot{
            width:10px;
            height:10px;
            border-radius:50%;
            background:#f59e0b;
            box-shadow:0 0 18px #f59e0b;
            animation:pulse 1.6s infinite ease-in-out;
        }

        @keyframes pulse{
            0%,100%{transform:scale(1); opacity:1;}
            50%{transform:scale(1.4); opacity:.65;}
        }

        h1{
            margin:0 0 14px;
            font-size:clamp(2rem, 4vw, 4rem);
            line-height:1.15;
            font-weight:800;
            letter-spacing:-0.5px;
        }

        p{
            margin:0 0 18px;
            font-size:1.05rem;
            line-height:1.9;
            color:var(--muted);
            max-width:52ch;
        }

        .actions{
            display:flex;
            flex-wrap:wrap;
            gap:12px;
            margin-top:24px;
        }

        .btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:10px;
            padding:12px 18px;
            border-radius:14px;
            text-decoration:none;
            font-weight:600;
            transition:.25s ease;
            border:1px solid transparent;
            cursor:pointer;
            user-select:none;
        }

        /*.btn-primary{*/
        /*    background:linear-gradient(135deg, var(--accent), var(--accent2));*/
        /*    color:#fff;*/
        /*    box-shadow:0 10px 30px rgba(56,189,248,.25);*/
        /*}*/

        /*.btn-primary:hover{*/
        /*    transform:translateY(-2px);*/
        /*    filter:brightness(1.05);*/
        /*}*/

        .btn-secondary{
            background:rgba(255,255,255,0.06);
            color:#fff;
            border-color:rgba(255,255,255,0.12);
        }

        .btn-secondary:hover{
            background:rgba(255,255,255,0.10);
            transform:translateY(-2px);
        }

        .image-box{
            position:relative;
            z-index:1;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .image-frame{
            width:min(100%, 380px);
            aspect-ratio:1 / 1;
            border-radius:24px;
            background:rgba(255,255,255,0.05);
            border:1px solid rgba(255,255,255,0.10);
            overflow:hidden;
            display:flex;
            align-items:center;
            justify-content:center;
            box-shadow:0 18px 50px rgba(0,0,0,.25);
        }

        .image-frame img{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
        }

        .placeholder{
            text-align:center;
            color:rgba(255,255,255,0.55);
            padding:24px;
        }

        .placeholder svg{
            width:96px;
            height:96px;
            margin-bottom:12px;
            opacity:.8;
        }

        .footer-note{
            margin-top:18px;
            font-size:.95rem;
            color:rgba(255,255,255,0.55);
        }

        .spinner{
            width:18px;
            height:18px;
            border-radius:50%;
            border:2px solid rgba(255,255,255,.35);
            border-top-color:#fff;
            animation:spin 1s linear infinite;
        }

        @keyframes spin{
            to{ transform:rotate(360deg); }
        }

        @media (max-width: 860px){
            .card-item{
                grid-template-columns:1fr;
                text-align:center;
            }
            p{
                margin-left:auto;
                margin-right:auto;
            }
            .actions{
                justify-content:center;
            }
            .image-frame{
                width:min(100%, 320px);
            }
        }
    </style>
</head>
<body>
<div class="container">
    <section class="card-item">
        <div class="content">
            <div class="badge">
                <span class="dot"></span>
                <span>سایت در حال بروزرسانی است</span>
            </div>

            <h1>{{ $settings['title'] }}</h1>

            <p>
                {{ $settings['description'] }}
            </p>

            <div class="actions">
                <a href="/" class="btn btn-primary">
                    <span class="spinner"></span>
                    بازگشت به صفحه اصلی
                </a>
                <a href="/" class="btn btn-secondary">
                    تماس با:09907393873
                </a>
            </div>
        </div>

        <div class="image-box">
            <div class="image-frame" id="imageContainer">
                <!-- اگر عکس داری، src را عوض کن -->
                <div class="placeholder">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M4 5a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5z"></path>
                        <path d="M8 11l2.5 2.5L15 9l5 6H4l4-4z"></path>
                        <circle cx="9" cy="8" r="1.5"></circle>
                    </svg>
                    <div><img src="{{ \Illuminate\Support\Facades\Storage::url($settings['image']) }}" alt="logo"></div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    const timeEl = document.getElementById('currentTime');
    const now = new Date();
    timeEl.textContent = now.toLocaleString('fa-IR', {
        dateStyle: 'medium',
        timeStyle: 'short'
    });

</script>
</body>
</html>
