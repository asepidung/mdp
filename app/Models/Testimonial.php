<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasTranslations;

    protected $fillable = ['customer_name', 'content', 'rating', 'is_active'];

    public $translatable = ['content'];
}
