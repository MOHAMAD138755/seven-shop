<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LikeController extends Controller
{
    public function likes(): View
    {
        $likes = Like::with('product','user')->latest()->paginate(7);
        return view('DashboardAdmin.likes.likes',compact('likes'));
    }

    public function delete_like(string $lang,Like $like): RedirectResponse
    {
        $like->delete();

        \Flasher\Toastr\Prime\toastr('با موفقیت حذف شد');
        return back();
    }
}
