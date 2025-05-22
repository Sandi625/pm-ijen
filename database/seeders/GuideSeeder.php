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
    Guide::create([
        'nama_guide' => 'Dani',
        'salary' => 5000000,
        'deskripsi_guide' => 'Guide berpengalaman di Bali.',
        'nomer_hp' => '081234567890',
        'status' => 'aktif',
        'alamat' => 'Jl. Raya Ubud No. 1',
        'email' => 'dani@example.com',
        'foto' => 'dani.jpg',
        'bahasa' => 'Indonesia, Inggris',
        'user_id' => 4, // sesuaikan dengan ID user yang cocok
    ]);

    Guide::create([
        'nama_guide' => 'Richard',
        'salary' => 6000000,
        'deskripsi_guide' => 'Guide dengan spesialisasi Blue Fire Tour.',
        'nomer_hp' => '082345678901',
        'status' => 'aktif',
        'alamat' => 'Jl. Raya Seminyak No. 2',
        'email' => 'richard@example.com',
        'foto' => 'richard.jpg',
        'bahasa' => 'Indonesia, Inggris, Jepang',
        'user_id' => 5,
    ]);

    Guide::create([
        'nama_guide' => 'Yohanes',
        'salary' => 5500000,
        'deskripsi_guide' => 'Guide yang telah pensiun dari dunia guiding.',
        'nomer_hp' => '083456789012',
        'status' => 'aktif',  // ubah dari 'non-aktif' ke 'aktif'
        'alamat' => 'Jl. Raya Denpasar No. 3',
        'email' => 'yohanes@example.com',
        'foto' => 'yohanes.jpg',
        'bahasa' => 'Indonesia, Inggris',
        'user_id' => 6,
    ]);

    Guide::create([
        'nama_guide' => 'Putri',
        'salary' => 5800000,
        'deskripsi_guide' => 'Guide ramah dan komunikatif.',
        'nomer_hp' => '084567890123',
        'status' => 'aktif',
        'alamat' => 'Jl. Raya Kuta No. 4',
        'email' => 'putri@example.com',
        'foto' => 'putri.jpg',
        'bahasa' => 'Indonesia, Inggris, Korea',
        'user_id' => 7,
    ]);

    Guide::create([
        'nama_guide' => 'Duwik',
        'salary' => 5300000,
        'deskripsi_guide' => 'Guide lokal dengan pengetahuan sejarah kuat.',
        'nomer_hp' => '085678901234',
        'status' => 'aktif',
        'alamat' => 'Jl. Raya Lovina No. 5',
        'email' => 'duwik@example.com',
        'foto' => 'duwik.jpg',
        'bahasa' => 'Indonesia, Inggris, Jerman',
        'user_id' => 8,
    ]);
}


}
