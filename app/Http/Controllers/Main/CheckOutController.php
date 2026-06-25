<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CheckOutController extends Controller
{
    public function index(): View
    {
        return view('main.checkout.index');
    }
}
