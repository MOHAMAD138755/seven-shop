
@extends('DashboardAdmin.layout.layout')

@section('title','Dashboard')

@section('content')

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Welcome Back, John! 👋</h1>
    </div>

    <!-- Example Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
        <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <p style="color: var(--text-light); font-size: 0.9rem;">Total Revenue</p>
            <h2 style="font-size: 1.8rem; margin-top: 0.5rem;">$24,500</h2>
            <span style="color: #10b981; font-size: 0.85rem;"><i class="fas fa-arrow-up"></i> +12% from last month</span>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <p style="color: var(--text-light); font-size: 0.9rem;">Active Users</p>
            <h2 style="font-size: 1.8rem; margin-top: 0.5rem;">1,240</h2>
            <span style="color: #10b981; font-size: 0.85rem;"><i class="fas fa-arrow-up"></i> +5.4%</span>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
            <p style="color: var(--text-light); font-size: 0.9rem;">Pending Orders</p>
            <h2 style="font-size: 1.8rem; margin-top: 0.5rem;">43</h2>
            <span style="color: #f59e0b; font-size: 0.85rem;"><i class="fas fa-clock"></i> Needs attention</span>
        </div>
    </div>

@endsection
