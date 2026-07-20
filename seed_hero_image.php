<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

App\Models\SiteSetting::updateOrCreate(['key' => 'hero_image'], ['value' => '']);
echo "hero_image inserted!\n";
