@extends('DashboardAdmin.layout.layout')

<style>

    .inline-form{
        display: flex;
    }

    .inline-form form{
        margin-left: 10px;
    }

    .products-page {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .stat-card {
        background: linear-gradient(135deg, #ffffff, #f8fafc);
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        transition: 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 36px rgba(15, 23, 42, 0.1);
    }

    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #fff;
    }

    .stat-icon.blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .stat-icon.green { background: linear-gradient(135deg, #22c55e, #16a34a); }
    .stat-icon.orange { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .stat-icon.purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

    .stat-info span {
        display: block;
        color: #64748b;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .stat-info strong {
        color: #0f172a;
        font-size: 26px;
        font-weight: 800;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 24px;
        background: #fff;
        border-radius: 22px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    }

    .page-header h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 800;
        color: #0f172a;
    }

    .page-header p {
        margin: 6px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 24px;
    }

    .card {
        background: #fff;
        border-radius: 22px;
        padding: 22px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        gap: 16px;
    }

    .card-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
    }

    .toolbar {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 10px 14px;
        border-radius: 14px;
        min-width: 260px;
    }

    .search-box i {
        color: #94a3b8;
    }

    .search-box input {
        border: none;
        outline: none;
        background: transparent;
        width: 100%;
        font-size: 14px;
    }

    .filter-select {
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        padding: 10px 14px;
        border-radius: 14px;
        outline: none;
        font-size: 14px;
        color: #334155;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .products-table {
        width: 100%;
        border-collapse: collapse;
    }

    .products-table th,
    .products-table td {
        padding: 16px 12px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
        font-size: 14px;
        white-space: nowrap;
    }

    .products-table th {
        color: #64748b;
        font-weight: 600;
        background: #f8fafc;
    }

    .product-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .product-info img {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        object-fit: cover;
        background: #f1f5f9;
    }

    .product-info strong {
        display: block;
        color: #0f172a;
        font-weight: 700;
    }

    .product-info span {
        color: #64748b;
        font-size: 12px;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-active {
        background: #dcfce7;
        color: #15803d;
    }

    .badge-pending {
        background: #fef3c7;
        color: #b45309;
    }

    .actions {
        display: flex;
        gap: 8px;
    }

    .icon-btn {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .edit-btn {
        background: #e0f2fe;
        color: #0284c7;
    }

    .delete-btn {
        background: #fee2e2;
        color: #ef4444;
    }

    .icon-btn:hover {
        transform: translateY(-2px);
    }

    .form-note {
        font-size: 13px;
        color: #64748b;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
    }

    .form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 14px;
        outline: none;
        font-size: 14px;
        background: #fff;
        transition: 0.3s ease;
        resize: vertical;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 20px;
    }

    .btn {
        padding: 12px 18px;
        border: none;
        border-radius: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #0f172a;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    @media (max-width: 1100px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .products-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .page-header,
        .card-header,
        .form-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            min-width: 100%;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
    #productFormCard{
        position: relative;
        right: 20px;
    }
</style>

@section('title', 'Order Management')

@section('content')
    <div class="products-page">

        <div class="page-header">
            <div>
                <h1>مدیریت سفارشات</h1>
                <p>ادمین وبسایت میتواند سفارشات را مدیریت کند</p>
            </div>
        </div>
        <div class="products-grid">
            <!-- Product Table -->
            <div class="card products-card">
                <div class="card-header">
                    <h2>همه سفارشات</h2>
                </div>

                <div class="table-responsive">
                    <table class="products-table">
                        <thead>
                        <tr>
                            <th>کاربر</th>
                            <th>مبلغ کل</th>
                            <th>زمان گذاشته شدن</th>
                            <th>عملیات </th>
                        </tr>
                        </thead>
{{--                        <tbody>--}}
{{--                        @forelse($likes as $like)--}}

{{--                            <tr>--}}
{{--                                <td>--}}
{{--                                    <div class="user-info">--}}
{{--                                        <div>--}}
{{--                                            <strong>{{ $like->user->name }}</strong>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}

{{--                                <td>--}}
{{--                                    <span>{{ $like->product->name }}</span>--}}
{{--                                </td>--}}

{{--                                <td><i style="color: {{ $like->is_like == 1 ? 'green' : 'red' }}" class="{{ $like->is_like == 1 ? 'fa-solid fa-thumbs-up' : 'fa-solid fa-thumbs-down' }}"></i></td>--}}
{{--                                <td><span class="badge badge-admin">{{ \Morilog\Jalali\Jalalian::fromDateTime($like->created_at)->format('Y-m-d H:i:s')  }}</span></td>--}}
{{--                                <td>--}}
{{--                                    <div class="actions">--}}
{{--                                        <form action="{{ route('Dashboard.DeleteLike',['like' => $like->id , 'lang' => app()->getLocale()]) }}" method="post">--}}
{{--                                            @method('DELETE') @csrf--}}
{{--                                            <button class="icon-btn delete-btn"><i class="fas fa-trash"></i></button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                            <p style="text-align: center;color: red">لایک و دیسلایکی  یافت نشد</p>--}}
{{--                        @endforelse--}}
{{--                        {{ $likes->links() }}--}}
{{--                        </tbody>--}}
                    </table>
                </div>
            </div>

        </div>
@endsection
