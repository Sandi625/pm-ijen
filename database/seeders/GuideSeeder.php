<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guide;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data guide dengan berbagai status
        Guide::create([
            'nama_guide' => 'John Doe',
            'salary' => 5000000,
            'deskripsi_guide' => 'Guide berpengalaman di Bali.',
            'nomer_hp' => '081234567890',
            'status' => 'aktif', // status aktif
            'alamat' => 'Jl. Raya Ubud No. 1',
            'email' => 'johndoe@example.com',
            'foto' => 'john_doe.jpg',
            'bahasa' => 'Indonesia, Inggris',
        ]);

        Guide::create([
            'nama_guide' => 'Jane Smith',
            'salary' => 6000000,
            'deskripsi_guide' => 'Guide dengan spesialisasi Blue Fire Tour.',
            'nomer_hp' => '082345678901',
            'status' => 'sedang_guiding', // status sedang guiding
            'alamat' => 'Jl. Raya Seminyak No. 2',
            'email' => 'janesmith@example.com',
            'foto' => 'jane_smith.jpg',
            'bahasa' => 'Indonesia, Inggris, Jepang',
        ]);

        Guide::create([
            'nama_guide' => 'Michael Johnson',
            'salary' => 5500000,
            'deskripsi_guide' => 'Guide yang telah pensiun dari dunia guiding.',
            'nomer_hp' => '083456789012',
            'status' => 'tidak_aktif', // status tidak aktif
            'alamat' => 'Jl. Raya Denpasar No. 3',
            'email' => 'michaeljohnson@example.com',
            'foto' => 'michael_johnson.jpg',
            'bahasa' => 'Indonesia, Inggris',
        ]);
    }
}
