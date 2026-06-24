<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
}
