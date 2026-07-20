<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

App\Models\SiteSetting::updateOrCreate(['key' => 'meta_title'], ['value' => 'Mbok Dewor Puding - Premium F&B Dessert']);
App\Models\SiteSetting::updateOrCreate(['key' => 'meta_description'], ['value' => 'Sensasi dessert lumer berkelas dunia yang dibuat secara higienis menggunakan susu segar murni dan bahan organik premium.']);
echo "SEO settings inserted!\n";
