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
    }
}
