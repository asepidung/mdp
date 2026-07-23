<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialLink extends Model
{
    use HasFactory;

    protected $fillable = ['token', 'is_used'];
}
