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

Route::get('/fix-hosting', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        $storagePath = public_path('storage');
        
        if (is_link($storagePath)) {
            unlink($storagePath);
        }
        
        if (!file_exists($storagePath)) {
            mkdir($storagePath, 0775, true);
        }
        
        return 'Hosting cache cleared and storage folder fixed! Silakan coba upload gambar lagi.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/ulasan-sukses', function () {
    return view('ulasan-success');
})->name('ulasan.success');

Route::get('/ulasan/{token}', [\App\Http\Controllers\TestimonialController::class, 'create'])->name('ulasan.create');
Route::post('/ulasan/{token}', [\App\Http\Controllers\TestimonialController::class, 'store'])->name('ulasan.store');
