@extends('DashboardAdmin.layout.layout')

@section('title','Config Management')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;400;700&display=swap');

    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        --bg-soft: #f8fafc;
        --glass-bg: rgba(255, 255, 255, 0.8);
        --accent-color: #6366f1;
        --text-dark: #1e293b;
        --text-light: #64748b;
        --card-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        --input-focus: rgba(99, 102, 241, 0.1);
    }

    .configuration-container {
        font-family: 'Vazirmatn', sans-serif;
        background-color: var(--bg-soft);
        padding: 32px;
        direction: rtl;
        color: var(--text-dark);
    }

    /* --- Page Header --- */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
    }

    .page-header h1 {
        font-size: 32px;
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
    }

    .page-header p {
        color: var(--text-light);
        font-size: 16px;
    }

    /* --- Layout Grid --- */
    .config-grid {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 32px;
    }

    /* --- Sidebar (Modern Glass Look) --- */
    .config-sidebar {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px;
        padding: 20px;
        height: fit-content;
        position: sticky;
        top: 32px;
        box-shadow: var(--card-shadow);
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 18px;
        text-decoration: none;
        color: var(--text-light);
        font-weight: 500;
        border-radius: 16px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 4px;
    }

    .nav-item i {
        font-size: 20px;
        transition: transform 0.3s ease;
    }

    .nav-item:hover {
        color: var(--accent-color);
        background: rgba(99, 102, 241, 0.05);
        transform: translateX(-5px); /* حرکت ملایم به سمت راست در RTL */
    }

    .nav-item.active {
        background: var(--primary-gradient);
        color: white !important;
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.4);
    }

    .nav-item.active i {
        transform: scale(1.1);
    }

    /* --- Content & Cards --- */
    .config-section .card {
        background: white;
        border-radius: 28px;
        padding: 32px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: var(--card-shadow);
        transition: transform 0.3s ease;
    }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 20px;
    }

    .card-header h2 {
        font-size: 22px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-header h2 i {
        color: var(--accent-color);
    }

    /* --- Form Elements (Premium Input Style) --- */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
        margin-right: 4px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 14px 18px;
        border-radius: 16px;
        border: 1.5px solid #e2e8f0;
        background: #fcfdfe;
        font-size: 15px;
        transition: all 0.3s ease;
        outline: none;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: var(--accent-color);
        background: white;
        box-shadow: 0 0 0 4px var(--input-focus);
    }

    .full-width {
        grid-column: span 2;
    }

    /* --- Buttons (Gradient & Interaction) --- */
    .btn {
        padding: 14px 28px;
        border-radius: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        border: none;
    }

    .btn-primary {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 25px -5px rgba(99, 102, 241, 0.4);
    }

    .btn-secondary {
        background: white;
        color: var(--text-dark);
        border: 1.5px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    /* --- Badges & Accents --- */
    .badge {
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-blue {
        background: rgba(99, 102, 241, 0.1);
        color: var(--accent-color);
    }

    /* --- Responsive --- */
    @media (max-width: 1024px) {
        .config-grid { grid-template-columns: 1fr; }
        .config-sidebar { position: static; }
        .config-nav { flex-direction: row; overflow-x: auto; }
        .nav-item { white-space: nowrap; }
    }

    @media (max-width: 768px) {
        .form-grid { grid-template-columns: 1fr; }
        .full-width { grid-column: span 1; }
        .page-header { flex-direction: column; align-items: flex-start; gap: 20px; }
        .configuration-container { padding: 16px; }
    }
</style>

@section('content')
    <main class="configuration-container">
        <!-- Header Section -->
        <div class="page-header">
            <div>
                <h1>تنظیمات سیستم</h1>
                <p>مدیریت پیکربندی‌های اصلی وب‌سایت و تنظیمات پنل مدیریت</p>
            </div>
            <div class="header-actions">
                {{--                <button class="btn btn-secondary"><i class="fas fa-save"></i> ذخیره تغییرات کلی</button>--}}
            </div>
        </div>

        <div class="config-grid">
            <!-- Sidebar Inside Main (Tabs Navigation) -->
            <aside class="config-sidebar">
                <nav class="config-nav">
                    <a href="{{ route('Dashboard.general',['lang' => app()->getLocale()]) }}" class="nav-item"><i class="fas fa-cog"></i> تنظیمات عمومی</a>
                    <a href="{{ route('Dashboard.info',['lang' => app()->getLocale()]) }}" class="nav-item"><i class="fas fa-globe"></i> اطلاعات سایت</a>
                    <a href="{{ route('Dashboard.email',['lang' => app()->getLocale()]) }}" class="nav-item active"><i class="fas fa-envelope"></i> تنظیمات ایمیل (SMTP)</a>
                    <a href="{{ route('Dashboard.security',['lang' => app()->getLocale()]) }}" class="nav-item"><i class="fas fa-shield-alt"></i> امنیت </a>
                    <a href="{{ route('Dashboard.maintenance',['lang' => app()->getLocale()]) }}" class="nav-item"><i class="fas fa-tools"></i> حالت تعمیرات</a>
                </nav>
            </aside>
            <!-- Content Area (Where forms will change) -->
            <section class="config-content">

                <!-- Section: General Settings -->
                <div id="general" class="config-section">
                    <div class="card">
                        <div class="card-header">
                            <h2><i class="fas fa-cog"></i> اطلاعات ایمیل سایت</h2>
                        </div>

                        <form action="#" method="POST">
                            @csrf
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>آدرس هاست</label>
                                    <input type="text" readonly value="{{ config('mail.mailers.smtp.host') }}">
                                </div>
                                <div class="form-group">
                                    <label>پورت</label>
                                    <input type="text" readonly value="{{ config('mail.mailers.smtp.port') }}">
                                </div>
                                <div class="form-group full-width">
                                    <label>نام کاربری</label>
                                    <input readonly value="{{ config('mail.mailers.smtp.username')}}">
                                </div>
                                <div class="form-group">
                                    <label>نام ارسال کننده</label>
                                    <input type="text" readonly value="{{ config('mail.from.name') }}">
                                </div>
                                <div class="form-group">
                                    <label>ایمیل ارسال کننده</label>
                                    <input readonly type="email" value="{{ config('mail.from.address') }}">
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('Dashboard.email-test',['lang' => app()->getLocale()]) }}" method="post">
                            @csrf
                            <input type="hidden" name="email" value="{{ $settings['email'] }}">
                            <button type="submit" class="btn btn-primary">تست ارسال</button>
                        </form>

                    </div>
                </div>

            </section>
        </div>
    </main>
@endsection
