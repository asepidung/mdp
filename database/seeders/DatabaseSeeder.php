<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Check if user already exists to avoid duplication
        if (!User::where('username', 'saepullrock')->exists()) {
            User::factory()->create([
                'name' => 'asep idung',
                'username' => 'saepullrock',
                'password' => bcrypt('91142552'),
            ]);
        }

        // Seed Default Settings
                $settings = [
            ['key' => 'whatsapp_number', 'value' => '081335374099'],
            ['key' => 'hero_title', 'value' => 'Rasakan Kelezatan Puding Asli Mbok Dewor'],
            ['key' => 'hero_image', 'value' => ''],
            ['key' => 'hero_description', 'value' => 'Sensasi dessert lumer berkelas dunia yang dibuat secara higienis menggunakan susu segar murni dan bahan organik premium. Tekstur selembut sutra yang siap memanjakan setiap suapan.'],
            ['key' => 'hero_badge', 'value' => 'Premium Quality'],
            ['key' => 'about_title', 'value' => 'Dibuat dengan Bahan Susu Premium Pilihan & Penuh Kasih Sayang'],
            ['key' => 'about_text', 'value' => 'Setiap puding dari Mbok Dewor dibuat secara eksklusif menggunakan susu segar berkualitas tinggi, buah-buahan terbaik, dan tanpa pengawet buatan.'],
            ['key' => 'instagram_url', 'value' => 'https://www.instagram.com/mbokdeworpuding/'],
            ['key' => 'google_maps_url', 'value' => 'https://share.google/tS77CW3sIQk78KZ2S'],
            ['key' => 'address', 'value' => 'Jl. Dasana Indah blok RD VI No.19 - 20, Bojong Nangka, Kecamatan Kelapa Dua, Kabupaten Tangerang, Banten 15810'],
        ];

        foreach ($settings as $setting) {
            \App\Models\SiteSetting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
