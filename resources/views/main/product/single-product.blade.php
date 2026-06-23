@extends('main.layout.layout')

@section('title',$settings['site_name'])

@section('description',$settings['meta_description'])

@section('content')
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="container">

        <div class="product-card">

            <div class="gallery">

                <div class="main-image">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" alt="تصویر محصول">
                </div>

            </div>

            <div class="product-info">


                <h1 class="product-title">
                    {{ $product->name }}
                </h1>

{{--                <div class="rating">--}}
{{--                    ★★★★★ (4.9)--}}
{{--                </div>--}}

                <p class="description">
                    توضیحات: {{ $product->description }}
                </p>

                <div class="price-box">
                    <p style="color: #00ff15">قیمت: {{ $settings['currency'] == 'toman' ? 'تومان' : 'ریال' }}{{ $settings['currency'] == 'toman' ? number_format($product->price / 10) : number_format($product->price)}}</p>
                </div>

                <div class="features">

                    <div class="feature">
                        <span>تعداد موجود</span>
                        <strong>{{ $product->count }}</strong>
                    </div>

                    <div class="feature">
                        <span>زمان گذاشتن شدن محصول: </span>
                        <strong>{{ \Morilog\Jalali\Jalalian::fromDateTime($product->created_at)->format('Y-m-d') }}</strong>
                    </div>

                </div>

                <div class="actions">
                    <button class="buy-btn">
                        افزودن به سبد خرید
                    </button>

{{--                    <button class="wishlist">--}}
{{--                        ❤--}}
{{--                    </button>--}}
                </div>

            </div>

        </div>

    </div>


    <section class="comments-section">

        <h2 class="section-title">
            نظرات کاربران
        </h2>
        <p style="color: red;margin: 30px;text-align: center">(نظر شما وقتی قابل نمایش است که مدیر فروشگاه آن را تایید کند)</p>

        <!-- Add Comment -->
        @auth
        <div class="comment-box">

            <h3>ثبت نظر</h3>

            <form action="{{ route('home.comment',['lang' => app()->getLocale()]) }}" method="post">
            @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="form-group">
                    <textarea name="content" placeholder="نظر خود را بنویسید..."></textarea>
                </div>

                <button type="submit" class="submit-btn">
                    ثبت نظر
                </button>

            </form>

        </div>
        @endauth
        @guest
            <p style="text-align: center;font-size: 20px;color: red">برای ارسال نظر ورود کنید</p>
        @endguest
        <!-- Comments List -->

        <div class="comments-list">

            <!-- Comment -->

            <div class="comment-item">
                <div class="comment-header">

                    @forelse($comments as $comment)
                    <div style="width: 50px;height: 50px;border-radius: 50%">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($comment->user->profile_path) }}" alt="پروفایل کاربر">
                    </div>

                    <div class="user-info">
                        <h4>{{ $comment->user->name }}</h4>
                        <span>{{ $comment->created_at->locale('fa')->diffForHumans() }}</span>
                    </div>

                </div>

                <div class="comment-body">

                    {{ $comment->content }}

                </div>
                @include('Errors.error')
                @empty
                    <p>کامنتی موجود نیست</p>
                @endforelse

                <div class="comment-actions">

                    <button class="reply-toggle">
                        پاسخ
                    </button>

                </div>

                <!-- Reply Form -->

                <div class="reply-form">

                    <form action="{{ route('home.reply',['lang' => app()->getLocale()]) }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <textarea name="reply_content" placeholder="پاسخ خود را بنویسید..."></textarea>

                        <button type="submit">
                            ثبت پاسخ
                        </button>

                    </form>

                </div>

                <!-- Replies -->

{{--                <div class="replies">--}}

{{--                    <div class="reply-item">--}}

{{--                        <div class="comment-header">--}}

{{--                            <div class="avatar admin">--}}
{{--                                م--}}
{{--                            </div>--}}

{{--                            <div class="user-info">--}}
{{--                                <h4>مدیر فروشگاه</h4>--}}
{{--                                <span>۱ ساعت پیش</span>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                        <div class="comment-body">--}}

{{--                            ممنون از اینکه نظرتون رو ثبت کردید ❤️--}}

{{--                        </div>--}}

{{--                    </div>--}}

                </div>

            </div>


    </section>

    <script>

        document.querySelectorAll('.reply-toggle').forEach(button => {

            button.addEventListener('click', function(){

                const form =
                    this.parentElement.nextElementSibling;

                form.classList.toggle('active');

            });

        });

    </script>
@endsection
