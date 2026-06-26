<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Product;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $settings = settings();

        SEOTools::setTitle(($settings['site_name'] ?? 'سون شاپ') . ' | فروشگاه اینترنتی');

        SEOTools::setDescription($settings['meta_description'] ?? '');

        SEOTools::metatags()->setKeywords([
            'سون شاپ',
            'فروشگاه اینترنتی',
            'خرید آنلاین'
        ]);

        SEOTools::setCanonical(request()->url());

        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::opengraph()->setTitle($settings['site_name'] ?? 'سون شاپ');
        SEOTools::opengraph()->setDescription($settings['meta_description'] ?? '');
        SEOTools::opengraph()->addImage(asset('images/og-default.jpg'));

        SEOTools::twitter()->setTitle($settings['site_name'] ?? 'سون شاپ');

        SEOTools::jsonLd()->setType('WebSite');
        SEOTools::jsonLd()->setUrl(url('/'));

        $newProducts = Product::where('count','!=',0)->latest()->take(8)->get();
        $categories = Category::getAllCached(5);
        $BestSellers = Cache::remember('BestSellers', 86400, function () {
            return Product::getBestSellers();
        });
        $BestLikes = Cache::remember('BestLikes', 86400, function () {
            return Product::getBestLikes();
        });
        return view('main.home',compact('categories','newProducts','BestSellers','BestLikes'));
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        \Flasher\Toastr\Prime\toastr('با موفقیت خارج شدید');
        return back();
    }

    public function category(string $lang, Category $category): View
    {
        return view('main.category.category',compact('category'));
    }

    public function product(string $lang , Product $product): View
    {
        $comments = Comment::where('status',1)->where('product_id',$product->id)
            ->whereNull('parent_id')->with(['replies' => function ($query) {
                $query->where('status',1);
            }])->get();

        $reactionCount = Product::GetLikeOrDislike($product->id);
        $checkUserReaction = Like::where('product_id',$product->id)->where('user_id',Auth::id())->first();

        return view('main.product.single-product',['product'=>$product,'comments'=>$comments,
            'reactionCount'=>$reactionCount,'checkUserReaction'=>$checkUserReaction]);
    }

    public function create_comment(Request $request): RedirectResponse
    {
        $request->validate([
            'content'=>'required|max:200|string',
        ]);

        Comment::create([
            'content' => $request['content'],
            'product_id' => $request['product_id'],
            'user_id' => Auth::id(),
            'status' => 0,
        ]);

        \Flasher\Toastr\Prime\toastr('کامنت با موفقیت ایجاد شد','success');
        return back();
    }

    public function reply_comment(Request $request): RedirectResponse
    {
        $request->validate([
            'reply_content'=>'required|max:200|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        if($request->has('parent_id'))
        {
            $parentComment = Comment::find($request->parent_id);
            if($parentComment && $parentComment->user->id == Auth::id()){
                \Flasher\Toastr\Prime\toastr('شما نمی توانید به کامنت خود پاسخ دهید','error');
                return back();
            }
        }

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'parent_id' => $request->parent_id,
            'content' => $request->reply_content
        ]);

        \Flasher\Toastr\Prime\toastr('پاسخ به کامنت با موفقیت ایجاد شد','success');
        return back();

    }

    public function profile(): View
    {
        $user = auth()->user();
        return view('main.user.profile',compact('user'));
    }

    public function profile_update(string $lang,Request $request,User $user): RedirectResponse
    {
        $request->validate([
            'name' => ['string','min:5','max:20','regex:/^[A-Za-z\p{Arabic}\s]+$/u',
            Rule::unique('users')->ignore(auth()->id())
            ],
            'email' => 'email',
            'profile' => 'file|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        if ($request->hasFile('profile')) {

            $user->update([
                'profile_path' => Storage::disk('public')->delete($user->profile_path),
            ]);

            $path = Storage::disk('public')->putFile('profile_images', $request->file('profile'));

            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'profile_path' => $path
            ]);
        }

        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);

        \Flasher\Toastr\Prime\toastr('اطلاعات شما با موفقیت ویرایش شد','success');
        return back();
    }

    public function search_product(Request $request): View
    {
        $products = Product::where('count', '>', 0)
            ->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%')
                    ->orWhere('slug', 'like', '%' . $request->name . '%')
                    ->orWhere('description', 'like', '%' . $request->name . '%');
            })
            ->latest()
            ->paginate(5);

        return view('main.product.search',compact('products'));
    }

}
