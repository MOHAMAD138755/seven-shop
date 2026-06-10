<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function comments(): View
    {
        $comments = Comment::with('user', 'product')->latest()->get();
        return view('DashboardAdmin.comments.comments',compact('comments'));
    }
}
