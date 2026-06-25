<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReactionController extends Controller
{
    public function create_reaction(Request $request): RedirectResponse
    {
        if(auth()->check()){
            $user = auth()->user();
            $reaction = $user->likes()->where('product_id',$request->product_id)->first();

            if($reaction){
                if($reaction->is_like == $request->is_like){
                    $reaction->delete();
                    \Flasher\Toastr\Prime\toastr('واکنش قبلی شما حذف شد','success');
                    return back();
                }

                $reaction->update([
                    'is_like' => $request->is_like
                ]);

                \Flasher\Toastr\Prime\toastr('واکنش شما ویرایش شد','success');
                return back();

            }

            $user->likes()->create([
                'product_id' => $request->product_id,
                'is_like' => $request->is_like,
            ]);

            \Flasher\Toastr\Prime\toastr('واکنش شما ثبت شد','success');
            return back();

        }

        \Flasher\Toastr\Prime\toastr('لطفا در سایت لاگین کنید','error');
        return back();
    }

    public function delete(Request $request): RedirectResponse
    {
        Like::where('product_id',$request->product_id)->where('user_id',auth()->id())->delete();

        \Flasher\Toastr\Prime\toastr('واکنش شما با موفقیت حذف شد','success');
        return back();
    }

    public function show(): View
    {
        $products = Like::with('product')
            ->where('user_id', auth()->id())
            ->where('is_like', 1)
            ->get()
            ->map(function ($like) {
                $product = $like->product;
                $product->like_id = $like->id;

                return $product;
            });
        return view('main.like.like',compact('products'));
    }

    public function delete_product_reaction(string $lang,Like $like): RedirectResponse
    {
        $like->delete();

        \Flasher\Toastr\Prime\toastr('با موفقیت حذف شد','success');
        return back();
    }
}
