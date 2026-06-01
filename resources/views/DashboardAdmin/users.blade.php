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


@section('title', 'Users Management')

@section('content')
    <div class="users-page">

        <div class="page-header">
            <div>
                <h1>Users</h1>
                <p>Manage your users, add new ones, edit details, or remove access.</p>
            </div>

            <button class="btn btn-primary" id="openUserForm">
                <i class="fas fa-plus"></i>
                Add User
            </button>
        </div>

        <div class="users-grid">
            <!-- Users List -->
            <div class="card users-card">
                <div class="card-header">
                    <h2>All Users</h2>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search users...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="users-table">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=4f46e5&color=fff" alt="John Doe">
                                    <div>
                                        <strong>John Doe</strong>
                                        <span>@johndoe</span>
                                    </div>
                                </div>
                            </td>
                            <td>john@example.com</td>
                            <td><span class="badge badge-admin">Admin</span></td>
                            <td><span class="badge badge-active">Active</span></td>
                            <td>2026-01-12</td>
                            <td>
                                <div class="actions">
                                    <button class="icon-btn edit-btn"><i class="fas fa-edit"></i></button>
                                    <button class="icon-btn delete-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="user-info">
                                    <img src="https://ui-avatars.com/api/?name=Sarah+Ali&background=0f172a&color=fff" alt="Sarah Ali">
                                    <div>
                                        <strong>Sarah Ali</strong>
                                        <span>@sarahali</span>
                                    </div>
                                </div>
                            </td>
                            <td>sarah@example.com</td>
                            <td><span class="badge badge-user">User</span></td>
                            <td><span class="badge badge-pending">Pending</span></td>
                            <td>2026-02-03</td>
                            <td>
                                <div class="actions">
                                    <button class="icon-btn edit-btn"><i class="fas fa-edit"></i></button>
                                    <button class="icon-btn delete-btn"><i class="fas fa-trash"></i></button>
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
                    <h2>Add / Edit User</h2>
                    <span class="form-note">Fill the details below</span>
                </div>

                <form>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" placeholder="Enter full name">
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" placeholder="Enter username">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select>
                            <option value="">Select role</option>
                            <option value="admin">Admin</option>
                            <option value="manager">Manager</option>
                            <option value="user">User</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="blocked">Blocked</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" placeholder="Enter password">
                    </div>

                    <div class="form-group">
                        <label>Avatar URL</label>
                        <input type="text" placeholder="Avatar image link">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save User</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
