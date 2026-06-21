@extends('DashboardAdmin.layout.layout')

<style>

    .select-style{
        width: 130px;
        height: 35px;
        text-align: center;
        font-weight: bolder;
        cursor: pointer;
       background-color: #b6b6b6;
        border-radius: 5px;
    }

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

    #order-details {

        width: 90%;
        max-width: 500px;
        padding: 0;
        border: none;
        border-radius: 16px;margin: auto;
        max-height: 85%;
        overflow-y: auto;
        background-color: #ffffff;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
        0 10px 10px -5px rgba(0, 0, 0, 0.04);


        transition: opacity 0.3s ease, transform 0.3s ease, display 0.3s allow-discrete;
        opacity: 0;
        transform: scale(0.95);
    }


    #order-details:popover-open {
        opacity: 1;
        transform: scale(1);
    }


    #order-details::backdrop {
        background-color: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(4px);
    }

    #order-details h2{
        margin: 0;
        padding: 20px;
        font-size: 1.25rem;
        color: #1f2937;
        border-bottom: 1px solid #f3f4f6;
        text-align: right;
    }

    #order-details h4{
        margin: 0;
        padding: 20px;
        color: #00ff15;
        border-bottom: 1px solid #f3f4f6;
        text-align: right;
    }


    .order-content {
        padding: 20px;
        direction: rtl;
        text-align: right;
        color: #4b5563;
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
                            <th>شماره سفارش</th>
                            <th>کاربر</th>
                            <th>مبلغ کل</th>
                            <th>آدرس</th>
                            <th>شماره تماس</th>
                            <th>وضعیت</th>
                            <th>زمان گذاشته شدن</th>
                            <th>دیدن سفارش </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $order)

                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div>
                                            <strong>{{ $order->id }}</strong>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span>{{ $order->user->name }}</span>
                                </td>

                                <td>{{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($order->total_price / 10) : number_format($order->total_price)}}</td>

                                <td>
                                    <span>{{ $order->address }}</span>
                                </td>
                                <td>
                                    <span>{{ $order->phone_number }}</span>
                                </td>
                                <td>
                                    <span style="color: #00ff15">{{ $order->status }}: وضعیت فعلی</span>
                                    <form action="{{ route('Dashboard.OrdersUpdate',['lang' => app()->getLocale() , 'order' => $order->id]) }}" method="post">
                                        @csrf @method('PUT')
                                        <select name="status" class="select-style">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : ''}}>در انتظار</option>
                                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : ''}}>پرداخت شده</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : ''}}>ارسال شده</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : ''}}>در حال پردازش</option>
                                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : ''}}>تحویل داده شده</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : ''}}>لغو شده</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">تغییر وضعیت</button>
                                    </form>
                                </td>
                                <td>
                                   <p>{{ \Morilog\Jalali\Jalalian::fromDateTime($order->created_at)->format('Y-m-d H:i:s') }}</p>
                                </td>

                                <td>
                                    <button popovertarget="order-details" type="button" class="icon-btn delete-btn"><i class="fas fa-eye"></i></button>

                                    <div id="order-details" class="modal" popover>
                                        <h2>جزئیات سفارش</h2>
                                        <h2>{{ $order->user->name }}<strong>:مشتری</strong></h2>
                                        <h4>{{ $order->status }}<strong>:وضعیت</strong></h4>
                                        @foreach($order->items as $item)

                                        <div class="order-content">
                                            <p><strong>شماره سفارش آیتم:</strong>{{ $item->id }}</p>
                                            <p><strong>نام محصول سفارش داده شده:</strong>{{ $item->product->name }}</p>
                                            <p><strong>تعداد مصحول سفارش داده شده:</strong>{{ $item->quantity }}</p>
                                            <p><strong>قیمت محصول:</strong>{{ $item->price }}</p>
                                            <p><strong>زمان سفارش آیتم:</strong></p><p>{{ \Morilog\Jalali\Jalalian::fromDateTime($item->created_at)}}</p>
                                        </div>

                                        @endforeach

                                        <div style="padding: 15px; border-top: 1px solid #f3f4f6; text-align: left;">
                                            <button onclick="document.getElementById('order-details').hidePopover()"
                                                    style="padding: 8px 16px; border-radius: 8px; border: none; background: #f3f4f6; cursor: pointer;">
                                                بستن
                                            </button>
                                        </div>
                                    </div>
                                </td>

                        @empty
                            <p style="text-align: center;color: red"> سفارشی یافت نشد</p>
                        @endforelse
                        {{ $orders->links() }}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
@endsection
