<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::query()
            ->where('is_active', 1)
            ->latest('id')
            ->get();

        $featuredProducts = Product::query()
            ->with(['category', 'images'])
            ->where('is_active', 1)
            ->where('is_featured', 1)
            ->latest('id')
            ->take(8)
            ->get();

        $newProducts = Product::query()
            ->with(['category', 'images'])
            ->where('is_active', 1)
            ->latest('id')
            ->take(8)
            ->get();

        $categories = Category::query()
            ->where('status', 'active')
            ->latest('id')
            ->take(8)
            ->get();

        return view('home', compact(
            'banners',
            'featuredProducts',
            'newProducts',
            'categories'
        ));
    }
}