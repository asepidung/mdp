<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\SiteSetting;

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', function () {
    if (session()->has('locale')) {
        app()->setLocale(session('locale'));
    }

    $products = Product::where('is_active', true)->get();
    $testimonials = Testimonial::where('is_active', true)->get();
    
    // Fetch Site Settings (using all() to trigger Translatable mutators)
    $settings = SiteSetting::all()->pluck('value', 'key');

    return view('welcome', compact('products', 'testimonials', 'settings'));
});
