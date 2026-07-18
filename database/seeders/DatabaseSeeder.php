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
            ['key' => 'about_text', 'value' => 'Setiap puding dari Mbok Dewor dibuat secara eksklusif menggunakan susu segar berkualitas tinggi, buah-buahan terbaik, dan tanpa pengawet buatan.'],
        ];

        foreach ($settings as $setting) {
            \App\Models\SiteSetting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
