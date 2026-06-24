@extends('main.layout.layout')

@section('title',$settings['site_name'])
@vite(['resources/css/profile.css'])
@section('description',$settings['meta_description'])

@section('content')

    <div class="profile-header">
        <div class="profile-avatar">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($user->profile_path) }}" alt="پروفایل">
        </div>

        <div class="profile-info">
            <h1>{{ $user->name }}</h1>
            <p>{{ $user->roles[0]->name }}</p>
        </div>

        <button class="edit-btn">
            ویرایش پروفایل
        </button>
    </div>

    <div class="profile-content">

        <div class="info-card">
            <span>ایمیل</span>
            <h3>{{ $user->email }}</h3>
        </div>

        <div class="info-card">
            <span>آخرین ویرایش اطلاعات</span>
            <h3>{{ \Morilog\Jalali\Jalalian::fromDateTime($user->updated_at )->format('Y-m-d')}}</h3>
        </div>

        <div class="info-card">
            <span>تاریخ عضویت</span>
            <h3>{{ \Morilog\Jalali\Jalalian::fromDateTime($user->created_at )->format('Y-m-d')}}</h3>
        </div>

        <div class="info-card">
            <span>نقش</span>
            <h3>{{ $user->roles[0]->name  }}</h3>
        </div>

    </div>

    <div class="profile-modal" id="editModal">

        <div class="modal-box">
            <form action="{{ route('home.profile.update',['lang' => app()->getLocale(),'user' => $user->name]) }}" method="post" enctype="multipart/form-data">
                @csrf @method('PUT')
            <h2>ویرایش پروفایل</h2>

            <input type="text" name="name" value="{{ $user->name }}" placeholder="نام">

            <input type="email" name="email" value="{{ $user->email }}"  placeholder="ایمیل">

            <input type="file" name="profile">

            <button type="submit">ثبت تغییرات</button>
            </form>
        </div>

    </div>

    <script>
        const modal = document.getElementById("editModal");
        const btn = document.querySelector(".edit-btn");

        btn.onclick = () => {
            modal.style.display = "flex";
        };

        modal.onclick = e => {
            if(e.target === modal){
                modal.style.display = "none";
            }
        };
    </script>

@endsection
