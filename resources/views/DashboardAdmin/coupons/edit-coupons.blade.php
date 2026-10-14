@extends('DashboardAdmin.layout.layout')

<style>
    .users-page {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 24px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    }

    .page-header h1 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: #0f172a;
    }

    .page-header p {
        margin: 6px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .users-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 24px;
    }

    .card {
        background: #fff;
        border-radius: 20px;
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

    .table-responsive {
        overflow-x: auto;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
    }

    .users-table th,
    .users-table td {
        padding: 16px 12px;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
        font-size: 14px;
    }

    .users-table th {
        color: #64748b;
        font-weight: 600;
        background: #f8fafc;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-info img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-info strong {
        display: block;
        color: #0f172a;
        font-weight: 600;
    }

    .user-info span {
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

    .badge-admin {
        background: #ede9fe;
        color: #6d28d9;
    }

    .badge-user {
        background: #e0f2fe;
        color: #0369a1;
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
    .form-group select {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 14px;
        outline: none;
        font-size: 14px;
        background: #fff;
        transition: 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus {
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

    @media (max-width: 1024px) {
        .users-grid {
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
    }
</style>


@section('title', 'Edit Coupon')
@section('content')
    <div class="users-page">

        <div class="page-header">
            <div>
                <h1>ویرایش کوپن</h1>
            </div>

            {{--            <button class="btn btn-primary" id="openUserForm">--}}
            {{--                <i class="fas fa-plus"></i>--}}
            {{--                Add User--}}
            {{--            </button>--}}
        </div>

        <div class="users-grid">
            <!-- Users List -->
            <div class="card users-card">
                <div class="card-header">
                    <h2>کوپن {{ $coupon->code }}</h2>
                </div>

                <div class="table-responsive">
                    <table class="users-table">
                        <thead>
                        <tr>
                            <th>نام کوپن</th>
                            <th>نوع</th>
                            <th>مقدار</th>
                            <th>سقف تخفیف</th>
                            <th>حداقل قیمت سفارش</th>
                            <th>سقف استفاده</th>
                            <th>تعداد استفاده شده</th>
                            <th>زمان شروع</th>
                            <th>زمان انقضا</th>
                            <th>فعال</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div>
                                            <strong>{{ $coupon->code }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td><span>{{ $coupon->type }}</span></td>
                                <td><span>{{ $coupon->type == 'percent' ? $coupon->value . '%' : $coupon->value . 'ریال' }}</span></td>
                                <td><span>(ریال){{ $coupon->max_discount_amount ?? 'خالی' }}</span></td>
                                <td><span>(ریال){{ $coupon->min_order_amount ?? '0' }}</span></td>
                                <td><span>{{ $coupon->usage_limit }}</span></td>
                                <td><span>{{ $coupon->used_count ?? '0' }}</span></td>
                                <td><span>{{ $coupon->start_at ? \Morilog\Jalali\Jalalian::fromDateTime($coupon->start_at)->format('Y-m-d') : 'وجود ندارد' }}</span></td>
                                <td><span>{{ $coupon->expires_at ? \Morilog\Jalali\Jalalian::fromDateTime($coupon->expires_at)->format('Y-m-d') : 'وجود ندارد' }}</span></td>
                                <td><span @style(['color:red'=>$coupon->is_active == 0,'color:green'=>$coupon->is_active == 1])>
                                        {{ $coupon->is_active == 0 ? 'فعال نیست' : 'فعال است' }}</span></td>

                                                                <td>
                                                                    <div class="actions">
                                                                        <a href="{{ route('Dashboard.EditCoupon',['coupon' => $coupon->id , 'lang' => app()->getLocale()]) }}">
                                                                            <button class="icon-btn edit-btn"><i class="fas fa-edit"></i></button>
                                                                        </a>
                                                                        <form action="{{ route('Dashboard.DeleteCoupon',['coupon' => $coupon->id , 'lang' => app()->getLocale()]) }}" method="post">
                                                                            @method('DELETE') @csrf
                                                                            <button class="icon-btn delete-btn"><i class="fas fa-trash"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form -->
            <div class="card form-card" id="userFormCard">
                <div class="card-header">
                    <h2>افزودن کوپن</h2>
                    {{--                    <span class="form-note">Fill the details below</span>--}}
                </div>

                                <form action="{{ route('Dashboard.UpdateCoupon',['lang' => app()->getLocale(),'coupon'=>$coupon->id]) }}" method="post">
                                    @csrf @method('PUT')
                                    <div class="form-group">
                                        <label>نام گوپن</label>
                                        <input type="text" name="code" placeholder="Enter code" value="{{ $coupon->code }}">
                                    </div>

                                    <div class="form-group">
                                        <label>نوع</label>
                                        <select name="types" id="coupon_types">
                                            <option @selected($coupon->type == 'percent') value="percent">percent</option>
                                            <option @selected($coupon->type == 'fixed')  value="fixed">fixed</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label id="coupon_value">مقدار</label>
                                        <input type="number" name="value" value="{{ $coupon->value }}">
                                    </div>

                                    <div class="form-group">
                                        <label>سقف تخفیف(ریال)</label>
                                        <input type="number" name="max_discount_amount" value="{{ $coupon->max_discount_amount }}">
                                    </div>

                                    <div class="form-group">
                                        <label>حداقل مقدار سفارش(ریال)</label>
                                        <input type="number" name="min_order_amount" value="{{ $coupon->min_order_amount }}">
                                    </div>

                                    <div class="form-group">
                                        <label>سقف استفاده</label>
                                        <input type="number" name="usage_limit" value="{{ $coupon->usage_limit }}">
                                    </div>

                                    <div class="form-group">
                                        <label>زمان شروع</label>
                                        <input type="datetime-local" name="start_at" value="{{ $coupon->start_at }}">
                                    </div>

                                    <div class="form-group">
                                        <label>زمان پایان</label>
                                        <input type="datetime-local" name="expires_at" value="{{ $coupon->expires_at }}">
                                    </div>

                                    <div class="form-group">
                                        <label>وضعیت</label>
                                        <select name="is_active">
                                            <option value="1" @selected($coupon->is_active == '1')>فعال</option>
                                            <option value="0" @selected($coupon->is_active == '0')>غیر فعال</option>
                                        </select>
                                    </div>

{{--                                    <div class="form-group">--}}
{{--                                        <label>دسترسی این نقش</label>--}}
{{--                                        @forelse($permissions as $permission)--}}
{{--                                            <input type="checkbox" value="{{ $permission->name }}" name="permission[]">{{ $permission->name }}--}}
{{--                                        @empty--}}
{{--                                            <p style="text-align: center;color: red">دسترسی یافت نشد</p>--}}
{{--                                        @endforelse--}}
{{--                                    </div>--}}

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">ویرایش</button>
                                        <button type="reset" class="btn btn-secondary">ریست</button>
                                    </div>
                                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        let type = document.getElementById('coupon_types')
        let value = document.getElementById('coupon_value')

        function ChangeStatus() {
            if (type.value == 'percent'){
                value.innerHTML = '(مقدار بر اساس درصد)'
            }else if (type.value == 'fixed') {
                value.innerHTML = '(مقدار بر اساس ریال)'
            }
        }

        type.addEventListener('change',ChangeStatus)

        ChangeStatus()

    </script>
    @include('Errors.error')
@endsection
