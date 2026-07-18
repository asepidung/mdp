<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $fillable = ['name', 'description', 'image_path', 'is_active'];

    public $translatable = ['name', 'description'];
}
