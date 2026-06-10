<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function comments(): View
    {
        $comments = Comment::with('user', 'product')->latest()->get();
        return view('DashboardAdmin.comments.comments',compact('comments'));
    }

    public function delete(string $lang ,Comment $comment): RedirectResponse
    {
        $comment->delete();

        \Flasher\Toastr\Prime\toastr("کامنت با موفقیت حذف شد", "success");
        return back();
    }

    public function approve_comment(string $lang ,Comment $comment): RedirectResponse
    {
        $comment->update([
            'status' => 1
        ]);

        \Flasher\Toastr\Prime\toastr("کامنت با موفقیت تایید شد", "success");
        return back();
    }

}
