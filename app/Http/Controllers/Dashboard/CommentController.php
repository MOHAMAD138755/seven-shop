<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function comments(): View
    {
        return view('DashboardAdmin.comments.comments');
    }
}
