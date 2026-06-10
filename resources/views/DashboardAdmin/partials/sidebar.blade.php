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
        <a href="{{ route('Dashboard.categories',['lang' => app()->getLocale()]) }}" class="nav-link">
            <i class="fas fa-chart-line"></i> Categories
        </a>
        <a href="{{ route('Dashboard.comments',['lang' => app()->getLocale()]) }}" class="nav-link">
            <i class="fas fa-message"></i> Comments
        </a>
        <div style="padding: 1rem 1.5rem; font-size: 0.75rem; color: var(--text-light); text-transform: uppercase; letter-spacing: 1px;">
            Settings
        </div>
        <a href="{{ route('Dashboard.config',['lang' => app()->getLocale()]) }}" class="nav-link">
            <i class="fas fa-cog"></i> Configuration
        </a>
        <form action="{{ route('Dashboard.logout',['lang' => app()->getLocale()]) }}" class="nav-link" method="post">
            @csrf
            <i class="fas fa-sign-out-alt"></i>
            <button style="width: 100px;height: 30px;border-radius: 5px;border: none;background-color: red;color: white;cursor: pointer" type="submit">Logout</button>
        </form>
    </nav>
</aside>
