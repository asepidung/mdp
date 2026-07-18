<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $products = App\Models\Product::all();
    $testimonials = App\Models\Testimonial::all();
    $settings = App\Models\SiteSetting::pluck('value', 'key');
    
    $html = view('welcome', compact('products', 'testimonials', 'settings'))->render();
    
    if (strpos($html, 'Sempurnakan Momen Spesialmu') !== false) {
        echo "SUCCESS: Blade rendered correctly and contains hero text.\n";
    } else {
        echo "WARNING: Hero text not found.\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}
