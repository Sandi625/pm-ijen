<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $pakets = [
            [
                'id' => 1,
                'nama_paket' => 'Bali Explore 3 Hari 2 Malam',
                'deskripsi_paket' => 'Nikmati keindahan alam dan budaya Bali dalam perjalanan selama 3 hari penuh petualangan dan relaksasi.',
                'harga' => 1850000.00,
                'durasi' => '3 hari 2 malam',
                'destinasi' => 'Ubud, Kuta, Tanah Lot',
                'include' => 'Transportasi darat, Makan 3x sehari, Hotel bintang 3, Tiket masuk objek wisata',
                'exclude' => 'Tiket pesawat, Pengeluaran pribadi',
                'itinerary' => 'itinerary_bali_explore.pdf', // Store file path here
                'information_trip' => 'Cocok untuk pasangan atau keluarga kecil yang ingin menjelajahi sisi budaya dan pantai Bali dengan waktu yang singkat.',
                'foto' => 'bali_explore.jpg',
                'created_at' => Carbon::parse('2024-08-03 07:45:27'),
                'updated_at' => Carbon::parse('2024-08-03 07:46:38'),
            ],
            [
                'id' => 2,
                'nama_paket' => 'Lombok Adventure 5 Hari',
                'deskripsi_paket' => 'Eksplorasi keindahan alam Lombok mulai dari pantai hingga air terjun yang memukau.',
                'harga' => 3250000.00,
                'durasi' => '5 hari 4 malam',
                'destinasi' => 'Pantai Tanjung Aan, Gili Trawangan, Air Terjun Sendang Gile',
                'include' => 'Akomodasi hotel & resort, Makan, Transportasi lokal, Tiket objek wisata',
                'exclude' => 'Tiket pesawat, Snorkeling equipment (jika tidak disewa), Pengeluaran pribadi',
                'itinerary' => 'itinerary_lombok_adventure.pdf',
                'information_trip' => 'Trip ini cocok untuk Anda yang suka eksplorasi alam dan pengalaman budaya lokal Lombok.',
                'foto' => 'lombok_adventure.jpg',
                'created_at' => Carbon::parse('2024-08-03 07:53:01'),
                'updated_at' => Carbon::parse('2024-08-03 07:53:01'),
            ],
            [
                'id' => 3,
                'nama_paket' => 'Yogyakarta Heritage Tour 4 Hari',
                'deskripsi_paket' => 'Menelusuri jejak sejarah dan budaya Jawa melalui destinasi legendaris di Yogyakarta.',
                'harga' => 2750000.00,
                'durasi' => '4 hari 3 malam',
                'destinasi' => 'Candi Borobudur, Keraton, Malioboro, Goa Pindul',
                'include' => 'Penginapan, Transportasi AC, Makan 3x sehari, Guide lokal',
                'exclude' => 'Tiket pesawat/kereta, Biaya optional tour',
                'itinerary' => 'itinerary_jogja_heritage.pdf',
                'information_trip' => 'Tour edukatif dan menyenangkan yang cocok untuk semua kalangan, terutama pecinta sejarah dan budaya.',
                'foto' => 'jogja_heritage.jpg',
                'created_at' => Carbon::parse('2024-08-03 07:54:05'),
                'updated_at' => Carbon::parse('2024-08-03 07:54:05'),
            ],
        ];

        DB::table('pakets')->insert($pakets);
    }

}
