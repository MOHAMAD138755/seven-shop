<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function products(): View
    {
        return view('DashboardAdmin.products');
    }
}
