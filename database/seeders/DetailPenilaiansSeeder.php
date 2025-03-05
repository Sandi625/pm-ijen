<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DetailPenilaiansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $details = [
            [
                'id' => 5,
                'penilaian_id' => 2,
                'subkriteria_id' => 1,
                'nilai' => 3,
                'created_at' => Carbon::parse('2024-08-03 07:45:27'),
                'updated_at' => Carbon::parse('2024-08-03 07:46:45'),
            ],
            [
                'id' => 6,
                'penilaian_id' => 2,
                'subkriteria_id' => 2,
                'nilai' => 4,
                'created_at' => Carbon::parse('2024-08-03 07:45:27'),
                'updated_at' => Carbon::parse('2024-08-03 07:45:27'),
            ],
            [
                'id' => 7,
                'penilaian_id' => 2,
                'subkriteria_id' => 3,
                'nilai' => 4,
                'created_at' => Carbon::parse('2024-08-03 07:45:27'),
                'updated_at' => Carbon::parse('2024-08-03 07:45:27'),
            ],
            [
                'id' => 8,
                'penilaian_id' => 2,
                'subkriteria_id' => 5,
                'nilai' => 3,
                'created_at' => Carbon::parse('2024-08-03 07:45:27'),
                'updated_at' => Carbon::parse('2024-08-03 07:45:27'),
            ],
            [
                'id' => 9,
                'penilaian_id' => 2,
                'subkriteria_id' => 6,
                'nilai' => 2,
                'created_at' => Carbon::parse('2024-08-03 07:45:27'),
                'updated_at' => Carbon::parse('2024-08-03 07:45:27'),
            ],
            // (Data lainnya diikuti dengan pola yang sama)
            [
                'id' => 40,
                'penilaian_id' => 4,
                'subkriteria_id' => 13,
                'nilai' => 3,
                'created_at' => Carbon::parse('2024-08-03 07:54:05'),
                'updated_at' => Carbon::parse('2024-08-03 07:54:05'),
            ],
        ];

        DB::table('detail_penilaians')->insert($details);
    }
}
