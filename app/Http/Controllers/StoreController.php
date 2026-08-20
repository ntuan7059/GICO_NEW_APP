<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        $locale = app()->getLocale();

        $banners = Banner::where('status', 1)
            ->with('translations')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $categories = Category::where('status', 1)
            ->with('translation')
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        $products = Product::where('status', 1)
            ->with(['translations', 'thumbnail', 'primaryVariant', 'category.translation'])
            ->withCount('reviews')
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        return view('themes.xylo.home', compact('banners', 'categories', 'products'));
    }
}
