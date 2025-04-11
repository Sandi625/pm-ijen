<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        $kriterias = [
            [
                'id' => 6,
                'kode' => 'K001',
                'nama' => 'Bahasa Asing',
                'deskripsi' => 'Kemampuan dalam menggunakan bahasa asing, seperti bahasa Inggris.',
                'created_at' => Carbon::parse('2024-08-01 17:12:34'),
                'updated_at' => Carbon::parse('2024-08-01 17:22:10'),
            ],
            [
                'id' => 7,
                'kode' => 'K002',
                'nama' => 'Keahlian Tracking',
                'deskripsi' => 'Kemampuan memandu peserta dalam jalur tracking secara aman dan efisien.',
                'created_at' => Carbon::parse('2024-08-01 17:22:17'),
                'updated_at' => Carbon::parse('2024-08-01 17:22:17'),
            ],
            [
                'id' => 8,
                'kode' => 'K003',
                'nama' => 'Pengetahuan Budaya',
                'deskripsi' => 'Pemahaman tentang sejarah, budaya lokal, dan tradisi daerah tujuan wisata.',
                'created_at' => Carbon::parse('2024-08-01 17:22:22'),
                'updated_at' => Carbon::parse('2024-08-01 17:22:22'),
            ],
        ];

        DB::table('kriterias')->insert($kriterias);
    }
}
