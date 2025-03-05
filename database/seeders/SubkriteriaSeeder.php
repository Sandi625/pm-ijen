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
            [
                'kriteria_id' => 6,
                'nama' => 'Pengetahuan Umum',
                'deskripsi' => '1. Sangat Kurang
2. Kurang
3. Cukup
4. Baik',
                'profil_standar' => 3,
                'is_core_factor' => 1,
                'created_at' => Carbon::parse('2024-08-01 17:32:33'),
                'updated_at' => Carbon::parse('2024-08-02 15:59:05'),
            ],
            [
                'kriteria_id' => 6,
                'nama' => 'Obat-obatan',
                'deskripsi' => '1. Sangat Kurang
2. Kurang
3. Cukup
4. Baik',
                'profil_standar' => 3,
                'is_core_factor' => 1,
                'created_at' => Carbon::parse('2024-08-01 17:33:23'),
                'updated_at' => Carbon::parse('2024-08-02 15:59:08'),
            ],
            [
                'kriteria_id' => 6,
                'nama' => 'Pengetahuan Bidang Kerja',
                'deskripsi' => '1. Sangat Kurang
2. Kurang
3. Cukup
4. Baik',
                'profil_standar' => 4,
                'is_core_factor' => 0,
                'created_at' => Carbon::parse('2024-08-01 17:34:47'),
                'updated_at' => Carbon::parse('2024-08-02 15:59:11'),
            ],
            [
                'kriteria_id' => 6,
                'nama' => 'Keterampilan',
                'deskripsi' => '1. Sangat Kurang
2. Kurang
3. Cukup
4. Baik',
                'profil_standar' => 3,
                'is_core_factor' => 0,
                'created_at' => Carbon::parse('2024-08-02 15:19:17'),
                'updated_at' => Carbon::parse('2024-08-02 15:59:14'),
            ],
            [
                'kriteria_id' => 7,
                'nama' => 'Pendidikan Terakhir',
                'deskripsi' => '1. SMA
2. D2 Kebidanan
3. D3 Kebidanan
4. D4 Kebidanan',
                'profil_standar' => 4,
                'is_core_factor' => 1,
                'created_at' => Carbon::parse('2024-08-02 15:26:58'),
                'updated_at' => Carbon::parse('2024-08-02 15:59:30'),
            ],
            [
                'kriteria_id' => 7,
                'nama' => 'Usia',
                'deskripsi' => '1. 17-20
2. 21-25
3. 26-30
4. 31-34',
                'profil_standar' => 3,
                'is_core_factor' => 1,
                'created_at' => Carbon::parse('2024-08-02 15:26:59'),
                'updated_at' => Carbon::parse('2024-08-02 15:59:34'),
            ],
            [
                'kriteria_id' => 7,
                'nama' => 'Pengalaman Bekerja',
                'deskripsi' => '1. Belum Bekerja
2. Pernah Bekerja 1 Tahun
3. Pernah Bekerja Lebih Dari 2 Tahun
4. Pernah Bekerja Lebih Dari 3 Tahun',
                'profil_standar' => 4,
                'is_core_factor' => 0,
                'created_at' => Carbon::parse('2024-08-02 15:27:27'),
                'updated_at' => Carbon::parse('2024-08-02 15:59:38'),
            ],
            [
                'kriteria_id' => 7,
                'nama' => 'Nilai IPK',
                'deskripsi' => '1. 2.00
2. 3.00
3. 3.50
4. 4.00',
                'profil_standar' => 4,
                'is_core_factor' => 0,
                'created_at' => Carbon::parse('2024-08-02 15:27:40'),
                'updated_at' => Carbon::parse('2024-08-02 15:59:43'),
            ],
            [
                'kriteria_id' => 8,
                'nama' => 'Kepribadian',
                'deskripsi' => '1. Sangat Kurang
2. Kurang
3. Cukup
4. Baik',
                'profil_standar' => 3,
                'is_core_factor' => 1,
                'created_at' => Carbon::parse('2024-08-02 15:28:39'),
                'updated_at' => Carbon::parse('2024-08-02 15:59:56'),
            ],
            [
                'kriteria_id' => 8,
                'nama' => 'Etika',
                'deskripsi' => '1. Sangat Kurang
2. Kurang
3. Cukup
4. Baik',
                'profil_standar' => 4,
                'is_core_factor' => 1,
                'created_at' => Carbon::parse('2024-08-02 15:28:59'),
                'updated_at' => Carbon::parse('2024-08-02 16:00:01'),
            ],
            [
                'kriteria_id' => 8,
                'nama' => 'Percaya Diri',
                'deskripsi' => '1. Sangat Kurang
2. Kurang
3. Cukup
4. Baik',
                'profil_standar' => 3,
                'is_core_factor' => 0,
                'created_at' => Carbon::parse('2024-08-02 15:29:11'),
                'updated_at' => Carbon::parse('2024-08-02 16:00:09'),
            ],
            [
                'kriteria_id' => 8,
                'nama' => 'Motivasi',
                'deskripsi' => '1. Sangat Kurang
2. Kurang
3. Cukup
4. Baik',
                'profil_standar' => 3,
                'is_core_factor' => 0,
                'created_at' => Carbon::parse('2024-08-02 15:29:17'),
                'updated_at' => Carbon::parse('2024-08-02 16:00:13'),
            ],
        ];

        DB::table('subkriterias')->insert($subkriterias);
    }
}
