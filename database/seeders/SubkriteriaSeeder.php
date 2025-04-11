<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubkriteriaSeeder extends Seeder
{
    public function run()
{
    $subkriterias = [
        // Bahasa Asing (kriteria_id = 6)
        [
            'kriteria_id' => 6,
            'nama' => 'Kemampuan Berbicara',
            'deskripsi' => '1. Sangat Kurang
2. Kurang
3. Cukup
4. Baik',
            'profil_standar' => 4,
            'is_core_factor' => 1,
            'created_at' => Carbon::parse('2024-08-01 17:32:33'),
            'updated_at' => Carbon::parse('2024-08-02 15:59:05'),
        ],
        [
            'kriteria_id' => 6,
            'nama' => 'Kemampuan Mendengar',
            'deskripsi' => '1. Sangat Kurang
2. Kurang
3. Cukup
4. Baik',
            'profil_standar' => 3,
            'is_core_factor' => 0,
            'created_at' => Carbon::parse('2024-08-01 17:33:23'),
            'updated_at' => Carbon::parse('2024-08-02 15:59:08'),
        ],
        [
            'kriteria_id' => 6,
            'nama' => 'Pemahaman Kosakata',
            'deskripsi' => '1. Sangat Kurang
2. Kurang
3. Cukup
4. Baik',
            'profil_standar' => 3,
            'is_core_factor' => 0,
            'created_at' => Carbon::parse('2024-08-01 17:34:47'),
            'updated_at' => Carbon::parse('2024-08-02 15:59:11'),
        ],

        // Keahlian Tracking (kriteria_id = 7)
        [
            'kriteria_id' => 7,
            'nama' => 'Kemampuan Navigasi',
            'deskripsi' => '1. Tidak Mampu
2. Mampu dengan Bantuan
3. Cukup Mandiri
4. Sangat Mandiri',
            'profil_standar' => 4,
            'is_core_factor' => 1,
            'created_at' => Carbon::parse('2024-08-02 15:26:58'),
            'updated_at' => Carbon::parse('2024-08-02 15:59:30'),
        ],
        [
            'kriteria_id' => 7,
            'nama' => 'Kesiapan Fisik',
            'deskripsi' => '1. Sangat Lemah
2. Lemah
3. Cukup
4. Bugar',
            'profil_standar' => 3,
            'is_core_factor' => 1,
            'created_at' => Carbon::parse('2024-08-02 15:26:59'),
            'updated_at' => Carbon::parse('2024-08-02 15:59:34'),
        ],
        [
            'kriteria_id' => 7,
            'nama' => 'Pengalaman Tracking',
            'deskripsi' => '1. Tidak Pernah
2. < 1 Tahun
3. 1-2 Tahun
4. > 2 Tahun',
            'profil_standar' => 4,
            'is_core_factor' => 0,
            'created_at' => Carbon::parse('2024-08-02 15:27:27'),
            'updated_at' => Carbon::parse('2024-08-02 15:59:38'),
        ],

        // Pengetahuan Budaya (kriteria_id = 8)
        [
            'kriteria_id' => 8,
            'nama' => 'Sejarah Lokal',
            'deskripsi' => '1. Tidak Tahu
2. Tahu Sedikit
3. Cukup Tahu
4. Sangat Tahu',
            'profil_standar' => 3,
            'is_core_factor' => 1,
            'created_at' => Carbon::parse('2024-08-02 15:28:39'),
            'updated_at' => Carbon::parse('2024-08-02 15:59:56'),
        ],
        [
            'kriteria_id' => 8,
            'nama' => 'Adat dan Tradisi',
            'deskripsi' => '1. Tidak Mengerti
2. Kurang Mengerti
3. Cukup Mengerti
4. Sangat Mengerti',
            'profil_standar' => 4,
            'is_core_factor' => 1,
            'created_at' => Carbon::parse('2024-08-02 15:28:59'),
            'updated_at' => Carbon::parse('2024-08-02 16:00:01'),
        ],
        [
            'kriteria_id' => 8,
            'nama' => 'Kemampuan Menjelaskan Budaya',
            'deskripsi' => '1. Tidak Bisa
2. Kurang Baik
3. Cukup Baik
4. Sangat Baik',
            'profil_standar' => 3,
            'is_core_factor' => 0,
            'created_at' => Carbon::parse('2024-08-02 15:29:17'),
            'updated_at' => Carbon::parse('2024-08-02 16:00:13'),
        ],
    ];

    DB::table('subkriterias')->insert($subkriterias);
}

}
