<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PesananSeeder extends Seeder
{
    public function run()
    {
        $pesananData = [
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'nomor_telp' => '081234567890',
                'id_kriteria' => 1,      // Hanya ini kriteria yang user minta (misal Keahlian Tracking)
                'id_paket' => 1,
                'id_guide' => null,
                'tanggal_pesan' => Carbon::now()->format('Y-m-d'),
                'tanggal_keberangkatan' => Carbon::now()->addWeeks(2)->format('Y-m-d'),
                'jumlah_peserta' => 4,
                'order_id' => Str::random(10),
                'negara' => 'Indonesia',
                'bahasa' => 'Indonesia',
                'riwayat_medis' => null,
                'paspor' => null,
                'special_request' => 'Tidak ada',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama' => 'Sari Dewi',
                'email' => 'sari@example.com',
                'nomor_telp' => '081298765432',
                'id_kriteria' => 2,      // beda kriteria
                'id_paket' => 2,
                'id_guide' => null,
                'tanggal_pesan' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'tanggal_keberangkatan' => Carbon::now()->addWeeks(1)->format('Y-m-d'),
                'jumlah_peserta' => 2,
                'order_id' => Str::random(10),
                'negara' => 'Indonesia',
                'bahasa' => 'Indonesia',
                'riwayat_medis' => null,
                'paspor' => null,
                'special_request' => 'Minta guide yang fasih bahasa Inggris',
                'status' => 1,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'nama' => 'Agus Prasetyo',
                'email' => 'agus@example.com',
                'nomor_telp' => '081212345678',
                'id_kriteria' => 2,      // beda kriteria juga
                'id_paket' => 1,
                'id_guide' => null,
                'tanggal_pesan' => Carbon::now()->subWeek()->format('Y-m-d'),
                'tanggal_keberangkatan' => Carbon::now()->addWeeks(3)->format('Y-m-d'),
                'jumlah_peserta' => 5,
                'order_id' => Str::random(10),
                'negara' => 'Indonesia',
                'bahasa' => 'Indonesia',
                'riwayat_medis' => null,
                'paspor' => null,
                'special_request' => 'Ada peserta alergi serbuk sari',
                'status' => 1,
                'created_at' => Carbon::now()->subWeek(),
                'updated_at' => Carbon::now()->subWeek(),
            ],
        ];

        DB::table('pesanans')->insert($pesananData);
    }
}
