<!doctype html>
<html lang="{{ $settings['language'] ?? 'fa' }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {!! SEO::generate() !!}

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/main.css','resources/js/main.js'])
</head>
<body>

<div class="wrapper">

    <div class="main-content">
        <!-- Include Header -->
        @include('main.partials.header')

        <!-- Main Page Content -->
        <main class="page-body">
            @include('Errors.error')
            @yield('content')
        </main>

        <!-- Include Footer -->
        @include('main.partials.footer')
    </div>
</div>

</body>
</html>
