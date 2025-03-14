<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 'active')->take(3)->get();

        $featuredProducts = Product::where('status', 'active')->where('featured', 1)->take(6)->get();

        return view('home', compact('categories', 'featuredProducts'));
    }

    public function productShow($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            abort(404);
        }
        return view('frontend.product.product-view', compact('product'));
    }
}
