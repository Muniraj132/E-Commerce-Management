<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $productCount = Product::count();
        $OrderCount = Order::count();
        $categoryCount = Category::count();
        return view('dashboard',compact('userCount','productCount','OrderCount','categoryCount'));
    }
}
