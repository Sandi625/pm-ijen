<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenilaiansSeeder extends Seeder
{
    public function run()
    {
        $penilaians = [
            [
                'id' => 2,
                'nama_kandidat' => 'Indah',
                'created_at' => Carbon::parse('2024-08-03 07:45:27'),
                'updated_at' => Carbon::parse('2024-08-03 07:46:38'),
            ],
            [
                'id' => 3,
                'nama_kandidat' => 'Nur',
                'created_at' => Carbon::parse('2024-08-03 07:53:01'),
                'updated_at' => Carbon::parse('2024-08-03 07:53:01'),
            ],
            [
                'id' => 4,
                'nama_kandidat' => 'Bela',
                'created_at' => Carbon::parse('2024-08-03 07:54:05'),
                'updated_at' => Carbon::parse('2024-08-03 07:54:05'),
            ],
        ];

        DB::table('penilaians')->insert($penilaians);
    }
}
