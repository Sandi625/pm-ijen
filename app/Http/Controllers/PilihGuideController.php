<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Pesanan;

use App\Models\Subkriteria;
use Illuminate\Http\Request;
use App\Models\DetailPesanan;
use App\Http\Controllers\Controller;
use App\Services\ProfileMatchingService;
use App\Traits\ProfileMatchingTrait; // Pastikan sudah pakai trait ini di controller!

class PilihGuideController extends Controller
{
    public function index()
    {
$pesanans = Pesanan::with(['kriterias', 'detailPesanans.guide'])->get();
        return view('pilihguide.index', compact('pesanans'));
    }

    // Tampilkan form pilih guide untuk satu pesanan
  use ProfileMatchingTrait;

    protected $profileMatchingService;

    public function __construct(ProfileMatchingService $profileMatchingService)
    {
        $this->profileMatchingService = $profileMatchingService;
    }





    // Fungsi helper untuk cari guide terbaik
    protected function getBestGuideIdForPesanan(Pesanan $pesanan)
    {
        $guideScores = [];

        // Kamu bisa isi standar nilai kriteria pesanan jika perlu, misal:
        $kriteriaPesanan = [];

        // Ambil semua guide yang sudah dipilih di detail_pesanan untuk pesanan ini
        $guideIds = DetailPesanan::where('pesanan_id', $pesanan->id)
            ->pluck('guide_id')
            ->unique();

            foreach ($guideIds as $guideId) {
                // Asumsikan ada relasi penilaian di Guide model yang terfilter berdasarkan pesanan
            $penilaian = Guide::find($guideId)
            ->penilaian()
            ->where('pesanan_id', $pesanan->id)
            ->first();

            if (!$penilaian) continue;

            $hasil = $this->hitungProfileMatching($penilaian, $kriteriaPesanan);
            $guideScores[$guideId] = $hasil['nilai_akhir'];
        }

        if (empty($guideScores)) {
            return null;
        }

        arsort($guideScores); // Urutkan descending berdasarkan nilai_akhir

        return key($guideScores); // Ambil guide dengan nilai tertinggi
    }

    public function edit($pesananId)
    {
        $pesanan = Pesanan::with('kriterias.subkriterias')->findOrFail($pesananId);
        $kriteriaIds = $pesanan->kriterias->pluck('id');

        $subkriteriaIds = Subkriteria::whereIn('kriteria_id', $kriteriaIds)->pluck('id');

        $kriteriaPesanan = [];
        foreach ($pesanan->kriterias as $kriteria) {
            foreach ($kriteria->subkriterias as $sub) {
                $kriteriaPesanan[$sub->id] = $sub->profil_standar;
        }
    }

    $rekomendasi = Guide::with('penilaians.detailPenilaians.subkriteria.kriteria')
        ->get()
        ->map(function ($guide) use ($subkriteriaIds, $kriteriaPesanan) {
            $nilaiTerbaik = 0;

            foreach ($guide->penilaians as $penilaian) {
                $filteredDetailPenilaians = $penilaian->detailPenilaians->filter(function ($detail) use ($subkriteriaIds) {
                    return $subkriteriaIds->contains($detail->subkriteria_id);
                });

                $penilaianFiltered = clone $penilaian;
                $penilaianFiltered->setRelation('detailPenilaians', $filteredDetailPenilaians);

                $hasil = $this->hitungProfileMatching($penilaianFiltered, $kriteriaPesanan);

                if ($hasil['nilai_akhir'] > $nilaiTerbaik) {
                    $nilaiTerbaik = $hasil['nilai_akhir'];
                }
            }

            return [
                'guide' => $guide,
                'nilai_total' => $nilaiTerbaik,
            ];
        })
        ->sortByDesc('nilai_total')
        ->values();

        return view('pilihguide.edit', [
        'pesanan' => $pesanan,
        'rekomendasi' => $rekomendasi,
    ]);
}


public function update(Request $request, $pesananId)
{
    $request->validate([
        'guide_id' => 'required|exists:guides,id',
    ]);

    $pesanan = Pesanan::with('kriterias')->findOrFail($pesananId);

    // Cek apakah guide sudah dipakai di tanggal yang sama untuk pesanan lain
    $guideSudahDipakai = Pesanan::where('id_guide', $request->guide_id)
        ->where('tanggal_keberangkatan', $pesanan->tanggal_keberangkatan)
        ->where('id', '!=', $pesananId) // selain pesanan ini
        ->exists();

    if ($guideSudahDipakai) {
        return redirect()->back()->withErrors(['guide_id' => 'Guide sudah memiliki pesanan lain di tanggal ini.'])->withInput();
    }

    // Update detail pesanan
    foreach ($pesanan->kriterias as $kriteria) {
        DetailPesanan::updateOrCreate(
            [
                'pesanan_id' => $pesananId,
                'kriteria_id' => $kriteria->id,
            ],
            [
                'guide_id' => $request->guide_id,
            ]
        );
    }

    $pesanan->id_guide = $request->guide_id;
    $pesanan->save();

    return redirect()->route('pilihguide.index')->with('success', 'Pilihan guide berhasil diperbarui.');
}





}
//  public function create($pesananId)
// {
//     $pesanan = Pesanan::with('kriterias.subkriterias')->findOrFail($pesananId);
//     $kriteriaIds = $pesanan->kriterias->pluck('id');

//     // Ambil semua subkriteria dari kriteria pesanan
//     $subkriteriaIds = Subkriteria::whereIn('kriteria_id', $kriteriaIds)->pluck('id');

//     // Siapkan array kriteriaPesanan (standar nilai dari pesanan, misal subkriteria_id => nilai)
//     // Kamu harus siapkan ini sesuai data pesanan, misal:
//     $kriteriaPesanan = [];
//     foreach ($pesanan->kriterias as $kriteria) {
//         foreach ($kriteria->subkriterias as $sub) {
//             // misal default nilai standar dari pesanan, kalau ada
//             $kriteriaPesanan[$sub->id] = $sub->profil_standar;
//         }
//     }

//     $rekomendasi = Guide::with('penilaians.detailPenilaians.subkriteria.kriteria')
//         ->get()
//         ->map(function ($guide) use ($subkriteriaIds, $kriteriaPesanan) {
//             $nilaiTerbaik = 0;

//             foreach ($guide->penilaians as $penilaian) {
//                 // Filter detailPenilaians hanya untuk subkriteria yang di pesanan
//                 $filteredDetailPenilaians = $penilaian->detailPenilaians->filter(function ($detail) use ($subkriteriaIds) {
//                     return $subkriteriaIds->contains($detail->subkriteria_id);
//                 });

//                 // Buat objek Penilaian sementara dengan detail yang sudah difilter
//                 $penilaianFiltered = clone $penilaian;
//                 $penilaianFiltered->setRelation('detailPenilaians', $filteredDetailPenilaians);

//                 // Hitung profile matching dari trait
//                 $hasil = $this->hitungProfileMatching($penilaianFiltered, $kriteriaPesanan);

//                 if ($hasil['nilai_akhir'] > $nilaiTerbaik) {
//                     $nilaiTerbaik = $hasil['nilai_akhir'];
//                 }
//             }

//             return [
//                 'guide' => $guide,
//                 'nilai_total' => $nilaiTerbaik,
//             ];
//         })
//         ->sortByDesc('nilai_total')
//         ->values();

//     return view('pilihguide.create', [
//         'pesanan' => $pesanan,
//         'rekomendasi' => $rekomendasi,
//     ]);
// }





// public function store(Request $request, $pesananId)
// {
//     $request->validate([
//         'guide_id' => 'required|exists:guides,id',
//     ]);

//     // Simpan pilihan guide di semua detail pesanan kriteria yang terkait
//     $pesanan = Pesanan::with('kriterias')->findOrFail($pesananId);

//     foreach ($pesanan->kriterias as $kriteria) {
//         DetailPesanan::updateOrCreate(
//             [
//                 'pesanan_id' => $pesananId,
//                 'kriteria_id' => $kriteria->id,
//             ],
//             [
//                 'guide_id' => $request->guide_id,
//             ]
//         );
//     }

//     // Update field id_guide di pesanan (pilihan guide utama)
//     $pesanan->id_guide = $request->guide_id;
//     $pesanan->save();

//     return redirect()->route('pilihguide.index')->with('success', 'Guide berhasil dipilih untuk semua kriteria.');
// }
