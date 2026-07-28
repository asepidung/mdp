<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->with('category')->get();
        $categories = Category::where('is_active', true)
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->get();
        
        // Fetch Site Settings
        $settings = SiteSetting::pluck('value', 'key');

        return view('welcome', compact('products', 'categories', 'testimonials', 'settings'));
    }
}
