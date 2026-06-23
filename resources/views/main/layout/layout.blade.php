<!doctype html>
<html lang="{{ $settings['language'] ?? 'fa' }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', $settings['meta_description'] ?? '' )">
    <meta name="keywords" content="سون شاپ,فروشگاه اینترنتی,فروشگاه,seven shop">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/main.css','resources/js/main.js'])
    <title>@yield('title',$settings['site_name'] ?? '')</title>
</head>
<body>

<div class="wrapper">

    <div class="main-content">
        <!-- Include Header -->
        @include('main.partials.header')

        <!-- Main Page Content -->
        <main class="page-body">
            @yield('content')
        </main>

        <!-- Include Footer -->
        @include('main.partials.footer')
    </div>
</div>

</body>
</html>
