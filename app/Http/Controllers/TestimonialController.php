<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestimonialLink;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function create($token)
    {
        $link = TestimonialLink::where('token', $token)->first();

        if (!$link) {
            abort(404, 'Link tidak ditemukan.');
        }

        if ($link->is_used) {
            abort(403, 'Maaf, link ini sudah kadaluarsa atau sudah digunakan sebelumnya.');
        }

        return view('ulasan', compact('token'));
    }

    public function store(Request $request, $token)
    {
        $link = TestimonialLink::where('token', $token)->first();

        if (!$link || $link->is_used) {
            abort(403, 'Link tidak valid atau sudah digunakan.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
        ]);

        // Simpan testimoni dan langsung tayangkan (is_active = true)
        Testimonial::create([
            'customer_name' => $validated['customer_name'],
            'rating' => $validated['rating'],
            'content' => $validated['content'],
            'is_active' => true,
        ]);

        // Hanguskan link
        $link->update(['is_used' => true]);

        return redirect()->route('ulasan.success');
    }
}
