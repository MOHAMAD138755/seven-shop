
@extends('DashboardAdmin.layout.layout')

@section('title','Dashboard')

@section('content')

    <div class="dashboard-page">

        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="banner-content">
                <h2>Hello, Administrator!</h2>
                <p>Welcome back. Your dashboard is ready with the latest updates and insights.</p>
            </div>
            <img src="https://via.placeholder.com/300x150/8b5cf6/ffffff?text=Welcome+Graphic" alt="Welcome Graphic" class="banner-graphic">
            {{-- این URL را با یک تصویر واقعی جایگزین کنید --}}
        </div>

        <!-- Quick Stats Section -->
        <div class="quick-stats">
            <div class="stat-box">
                <div class="stat-icon purple">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-details">
                    <span class="stat-label">Total Users</span>
                    <span class="stat-value">1,452</span>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon blue">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="stat-details">
                    <span class="stat-label">New Orders</span>
                    <span class="stat-value">210</span>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon green">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-details">
                    <span class="stat-label">Revenue This Month</span>
                    <span class="stat-value">$25,600</span>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon orange">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div class="stat-details">
                    <span class="stat-label">Monthly Growth</span>
                    <span class="stat-value">+5.8%</span>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="main-content-area">
            <div class="card-container">
                <!-- Recent Activity Card -->
                <div class="card">
                    <div class="card-header">
                        <h3>Recent Activity</h3>
                        <a href="#" class="view-all-link">View All</a>
                    </div>
                    <div class="card-body">
                        <ul class="activity-list">
                            <li>
                                <span class="activity-icon"><i class="fas fa-user-plus"></i></span>
                                <div class="activity-info">
                                    <p><strong>New user registered:</strong> John Smith</p>
                                    <span class="activity-time">2 hours ago</span>
                                </div>
                            </li>
                            <li>
                                <span class="activity-icon"><i class="fas fa-shopping-cart"></i></span>
                                <div class="activity-info">
                                    <p><strong>New order placed:</strong> Order #10570</p>
                                    <span class="activity-time">5 hours ago</span>
                                </div>
                            </li>
                            <li>
                                <span class="activity-icon"><i class="fas fa-server"></i></span>
                                <div class="activity-info">
                                    <p><strong>Server maintenance:</strong> Completed successfully</p>
                                    <span class="activity-time">Yesterday</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Quick Links Card -->
                <div class="card">
                    <div class="card-header">
                        <h3>Quick Links</h3>
                    </div>
                    <div class="card-body">
                        <div class="quick-links-grid">
{{--                            <a href="{{ route('admin.users.index') }}" class="quick-link-item">--}}
                                <i class="fas fa-users"></i>
                                <span>Manage Users</span>
{{--                            </a>--}}
{{--                            <a href="{{ route('admin.products.index') }}" class="quick-link-item">--}}
                                <i class="fas fa-box"></i>
                                <span>Manage Products</span>
{{--                            </a>--}}
                            <a href="#" class="quick-link-item">
                                <i class="fas fa-cog"></i>
                                <span>Settings</span>
                            </a>
                            <a href="#" class="quick-link-item">
                                <i class="fas fa-file-alt"></i>
                                <span>Reports</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

