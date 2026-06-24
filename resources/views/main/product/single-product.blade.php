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
                    نام محصول: {{ $product->name }}
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

                    <div class="feature">
                        <span>تعداد لایک ها</span>
                        <strong>{{ $reactionCount[0]->like_count }}</strong>
                    </div>

                    <div class="feature">
                        <span>تعداد دیسلایک ها</span>
                        <strong>{{ $reactionCount[0]->dislike_count }}</strong>
                    </div>

                </div>
                <h3>واکنش شما: </h3>
                <div style="display: flex;">
                @if(!$checkUserReaction)
                <form action="{{ route('reaction.create',['lang' => app()->getLocale()]) }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="is_like" value="1">
                    <button type="submit" class="fa-solid fa-thumbs-up wishlist" style="margin: 20px;color: green"></button>
                </form>

                <form action="{{ route('reaction.create',['lang' => app()->getLocale()]) }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="is_like" value="0">
                    <button type="submit" class="fa-solid fa-thumbs-down wishlist" style="margin: 20px;color: red"></button>
                </form>

                    @elseif($checkUserReaction->is_like == 1)
                        <form action="{{ route('reaction.delete',['lang' => app()->getLocale()]) }}" method="post">
                            @csrf @method('DELETE')
                            <input type="hidden" name="product_id" value="{{ $product->id }}">لغو لایک
                            <button type="submit" class="fa-solid fa-thumbs-up wishlist" style="margin: 20px;color: green"></button>
                        </form>
                    @elseif($checkUserReaction->is_like == 0)
                        <form action="{{ route('reaction.delete',['lang' => app()->getLocale()]) }}" method="post">
                            @csrf @method('DELETE')
                            <input type="hidden" name="product_id" value="{{ $product->id }}">لغو دیسلایک
                            <button type="submit" class="fa-solid fa-thumbs-down wishlist" style="margin: 20px;color: red"></button>
                        </form>
                    @endif
                </div>


                <div class="actions">
                    <form action="{{ route('cart.create',['lang' => app()->getLocale()]) }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <label for="count">تعداد: </label>
                        <input type="number" name="count" id="count">
                        <br><br>
                    <button class="buy-btn" type="submit">
                        افزودن به سبد خرید
                    </button>
                    </form>
                    @include('Errors.error')
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

                    @forelse($comments as $comment)
                <div class="comment-item">
                    <div class="comment-header">
                    <div style="width: 50px;height: 50px;">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($comment->user->profile_path) }}" alt="پروفایل کاربر"
                        style="border-radius: 50%">
                    </div>

                    <div class="user-info">
                        <h4>{{ $comment->user->name }}</h4>
                        <span>{{ $comment->created_at->locale('fa')->diffForHumans() }}</span>
                    </div>

                </div>

                <div class="comment-body">

                    {{ $comment->content }}

                </div>


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
                @forelse($comment->replies as $reply)
                <div class="replies">

                    <div class="reply-item">

                        <div class="comment-header">

                            <div style="width: 50px;height: 50px;">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($reply->user->profile_path) }}" alt="پروفایل کاربر"
                                style="border-radius: 50%">
                            </div>

                            <div class="user-info">
                                <h4>{{ $reply->user->name }}</h4>
                                <span>{{ $reply->created_at->locale('fa')->diffForHumans() }}</span>
                            </div>

                        </div>

                        <div class="comment-body">

                            {{ $reply->content }}

                        </div>

                    </div>

                </div>
                @empty
                    <p>ریپلای موجود نیست</p>
                @endforelse

            </div>

            @empty
                <p>کامنتی موجود نیست</p>
            @endforelse

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
