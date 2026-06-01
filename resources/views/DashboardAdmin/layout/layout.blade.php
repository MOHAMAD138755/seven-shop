<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/dashboard.css'])
    <title>@yield('title','Admin Dashboard')</title>
</head>
<body>

<div class="wrapper">
    <!-- Include Sidebar -->
    @include('DashboardAdmin.partials.sidebar')

    <div class="main-content">
        <!-- Include Header -->
        @include('DashboardAdmin.partials.header')

        <!-- Main Page Content -->
        <main class="page-body">
            @yield('content')
        </main>

        <!-- Include Footer -->
        @include('DashboardAdmin.partials.footer')
    </div>
</div>

<!-- JS Logic -->
<script>
    document.getElementById('toggleSidebar')?.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('active');
        // Adjust main content margin if needed
        const mainContent = document.querySelector('.main-content');
        if(window.innerWidth > 768) {
            mainContent.style.marginLeft = mainContent.style.marginLeft === '0px' ? '260px' : '0px';
        }
    });
</script>

</body>
</html>
