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


@section('title', 'Category Management')

@section('content')
    <div class="users-page">

        <div class="page-header">

            <button class="btn btn-primary" id="openUserForm">
                <i class="fas fa-plus"></i>
                <a style="text-decoration: none" href="{{ route('Dashboard.categories',['lang' => app()->getLocale()]) }}">
                    نمایش لیست کل دسته بندی ها
                </a>
            </button>
        </div>

        <div class="users-grid">
            <!-- Users List -->
            <div class="card users-card">
                <div class="card-header">
                    <h2>این دسته بندی </h2>
                    <form action="" method="post">

                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search category...">
                        </div>

                    </form>
                </div>

                <div class="table-responsive">
                    <table class="users-table">
                        <thead>
                        <tr>
                            <th>نام دسته بندی</th>
                            <th>نام انگلیسی دسته بندی</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div>
                                            <strong>{{ $category->name }}</strong>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span>{{ $category->english_name }}</span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('Dashboard.EditFormCategory',['category' => $category->id , 'lang' => app()->getLocale()]) }}">
                                            <button class="icon-btn edit-btn"><i class="fas fa-edit"></i></button>
                                        </a>
                                        <form action="{{ route('Dashboard.DeleteCategory',['category' => $category->id , 'lang' => app()->getLocale()]) }}" method="post">
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
                    <h2>فرم ویرایش </h2>
                    {{--                    <span class="form-note">Fill the details below</span>--}}
                </div>

                <form action="{{ route('Dashboard.UpdateCategory',['lang' => app()->getLocale(), 'category' => $category->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label>نام دسته بندی</label>
                        <input type="text" name="name" value="{{ $category->name }}" placeholder="Enter name">
                    </div>

                    <div class="form-group">
                        <label>نام انگلیسی دسته بندی</label>
                        <input type="text" name="english_name" value="{{ $category->english_name }}" placeholder="Enter english_name">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">ویرایش</button>
                        <button type="reset" class="btn btn-secondary">ریست</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('Errors.error')
@endsection
