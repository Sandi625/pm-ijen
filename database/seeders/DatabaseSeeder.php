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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'level' => 'admin', // Menambahkan level admin
        ]);

        // User biasa
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => bcrypt('user123'),
            'level' => 'user', // Menambahkan level user
        ]);


        // Menjalankan semua seeder yang telah Anda buat
        $this->call([
            KriteriaSeeder::class,
            SubkriteriaSeeder::class,
            PaketSeeder::class,
            // PenilaiansSeeder::class,
            // DetailPenilaiansSeeder::class,
        ]);
    }
}
