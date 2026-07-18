<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\SiteSetting;

Route::get('/', function () {
    $products = Product::where('is_active', true)->get();
    $testimonials = Testimonial::where('is_active', true)->get();
    
    // Fetch Site Settings
    $settings = SiteSetting::pluck('value', 'key');

    return view('welcome', compact('products', 'testimonials', 'settings'));
});
