@extends('DashboardAdmin.layout.layout')

<style>
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

@section('title', 'Products Management')

@section('content')
    <div class="products-page">

        <!-- Top Stats -->
{{--        <div class="stats-grid">--}}
{{--            <div class="stat-card">--}}
{{--                <div class="stat-icon blue">--}}
{{--                    <i class="fas fa-box"></i>--}}
{{--                </div>--}}
{{--                <div class="stat-info">--}}
{{--                    <span>Total Products</span>--}}
{{--                    <strong>248</strong>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="stat-card">--}}
{{--                <div class="stat-icon green">--}}
{{--                    <i class="fas fa-check-circle"></i>--}}
{{--                </div>--}}
{{--                <div class="stat-info">--}}
{{--                    <span>Active Products</span>--}}
{{--                    <strong>210</strong>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="stat-card">--}}
{{--                <div class="stat-icon orange">--}}
{{--                    <i class="fas fa-exclamation-triangle"></i>--}}
{{--                </div>--}}
{{--                <div class="stat-info">--}}
{{--                    <span>Low Stock</span>--}}
{{--                    <strong>18</strong>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="stat-card">--}}
{{--                <div class="stat-icon purple">--}}
{{--                    <i class="fas fa-tags"></i>--}}
{{--                </div>--}}
{{--                <div class="stat-info">--}}
{{--                    <span>Categories</span>--}}
{{--                    <strong>32</strong>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="page-header">
            <div>
                <h1>محصولات</h1>
                <p>ادمین وبسایت میتواند محصولات را اضافه و حذف و ویرایش کند</p>
            </div>

{{--            <button class="btn btn-primary" id="openProductForm">--}}
{{--                <i class="fas fa-plus"></i>--}}
{{--                Add Product--}}
{{--            </button>--}}
        </div>
        <div class="products-grid">
            <!-- Product Table -->
            <div class="card products-card">
                <div class="card-header">
                    <h2>همه محصولات</h2>

                    <div class="toolbar">
                            <form action="{{ route('Dashboard.SearchProduct',['lang' => app()->getLocale()])}}" method="get">
                                <div class="search-box">
                                    <i class="fas fa-search"></i>
                                    <input type="text" name="name" value="{{ request('name') }}" placeholder="enter name">
                                    <input type="text" name="price" value="{{ request('price') }}" placeholder="enter price">
                                    <button type="submit" class="btn">جستجو</button>
                                </div>
                            </form>

                        <select class="filter-select">
                            <option>همه ی دسته بندی ها</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="products-table">
                        <thead>
                        <tr>
                            <th>محصولات</th>
                            <th>نام محصول</th>
                            <th>دسته بندی</th>
                            <th>قیمت</th>
                            <th>تعداد</th>
                            <th>اسلاگ</th>
                            <th>عکس</th>
                            <th>آخرین ویرایش</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    <div class="product-info">
                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" alt="Product">
                                    </div>
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $settings[4]->value == 'toman' ? 'تومان' : 'ریال' }}{{ $settings[4]->value == 'toman' ? number_format($product->price / 10) : number_format($product->price)}}</td>
                                <td><span class="badge badge-pending">{{ $product->count }}</span></td>
                                <td>{{ $product->slug }}</td>
                               <td>
                                   <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" alt="Product" width="100px" height="100px">
                               </td>
                                <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($product->updated_at)->format('Y/m/d H:i:s') }}</td>
                                <td>
                                    <div class="actions">

                                        <a href="{{ route('Dashboard.EditFormProduct',['lang' => app()->getLocale(), 'product' => $product->id]) }}">
                                        <button class="icon-btn edit-btn"><i class="fas fa-edit"></i></button>
                                        </a>

                                        <form action="{{ route('Dashboard.DeleteProduct',['lang' => app()->getLocale(), 'product' => $product->id]) }}" method="post">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="icon-btn delete-btn"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <form action="{{ route('Dashboard.State',['lang' => app()->getLocale(), 'product' => $product->id]) }}" method="post">
                                            @csrf
                                            <button type="submit" class="icon-btn delete-btn"><i class="fas fa-chart-line"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p style="text-align: center;color: red">محصولی یافت نشد</p>
                        @endforelse
                        {{ $products->links() }}

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Product Form -->
            <div class="card form-card" id="productFormCard">
                <div class="card-header">
                    <h2>اضافه کردن محصول</h2>
                </div>

                <form action="{{ route('Dashboard.AddProduct',['lang' => app()->getLocale()]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>نام محصول</label>
                        <input type="text" name="name" placeholder="Enter product name">
                    </div>

                    <div class="form-group">
                        <label>توضیحات</label>
                        <textarea rows="4" name="description" placeholder="Write product description..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>انتخاب دسته بندی</label>
                        <select name="category">
                            @foreach($categories as $category)
                                <option>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>قیمت</label>
                        <input type="number" name="price" placeholder="Enter price Rial">
                    </div>

                    <div class="form-group">
                        <label>count</label>
                        <input type="number" name="count" placeholder="Enter count">
                    </div>

                    <div class="form-group">
                        <label>عکس محصول</label>
                        <input type="file" name="image" placeholder="Image link">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">ذخیره محصولات</button>
                        <button type="reset" class="btn btn-secondary">ریست</button>
                    </div>
                </form>
            </div>
        </div>
        @include('Errors.error')
    </div>
@endsection
