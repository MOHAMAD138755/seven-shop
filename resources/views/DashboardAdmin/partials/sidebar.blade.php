<aside class="sidebar">
    <div class="sidebar-logo" style="padding: 1.5rem; font-size: 1.5rem; font-weight: 700; color: var(--primary); text-align: center;">
        ADMIN<span style="color: white;">PRO</span>
    </div>

    <nav style="margin-top: 1rem;">
        <a href="{{ route('Dashboard.َAdmin',['lang' => app()->getLocale()]) }}" class="nav-link active">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="{{ route('Dashboard.Users',['lang' => app()->getLocale()]) }}" class="nav-link">
            <i class="fas fa-users"></i> Users
        </a>
        <a href="{{ route('Dashboard.Products',['lang' => app()->getLocale()]) }}" class="nav-link">
            <i class="fas fa-shopping-cart"></i> Products
        </a>
        <a href="#" class="nav-link">
            <i class="fas fa-chart-line"></i> Analytics
        </a>
        <div style="padding: 1rem 1.5rem; font-size: 0.75rem; color: var(--text-light); text-transform: uppercase; letter-spacing: 1px;">
            Settings
        </div>
        <a href="#" class="nav-link">
            <i class="fas fa-cog"></i> Configuration
        </a>
        <a href="#" class="nav-link">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </nav>
</aside>
