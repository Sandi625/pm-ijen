<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // Admin
    User::factory()->create([
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('admin'),
        'level' => 'admin',
    ]);

    // Pelanggan (User biasa)
    User::factory()->create([
        'name' => 'John Doe',
        'email' => 'user@example.com',
        'password' => bcrypt('user123'),
        'level' => 'pelanggan',
    ]);

    // Guide
    User::factory()->create([
        'name' => 'Guide One',
        'email' => 'guide@example.com',
        'password' => bcrypt('guide123'),
        'level' => 'guide',
    ]);


        // Menjalankan semua seeder yang telah Anda buat
        $this->call([
            KriteriaSeeder::class,
            SubkriteriaSeeder::class,
            PaketSeeder::class,
            GuideSeeder::class,
            // PesananSeeder::class,
            // PenilaiansSeeder::class,
            // DetailPenilaiansSeeder::class,
        ]);
    }
}
