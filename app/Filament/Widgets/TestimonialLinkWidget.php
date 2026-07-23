<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\TestimonialLink;
use Illuminate\Support\Str;

class TestimonialLinkWidget extends Widget
{
    protected static string $view = 'filament.widgets.testimonial-link-widget';

    public $generatedLink = null;

    public function generateLink()
    {
        $token = Str::random(10);
        TestimonialLink::create(['token' => $token]);
        
        $this->generatedLink = url('/ulasan/' . $token);
    }
}
