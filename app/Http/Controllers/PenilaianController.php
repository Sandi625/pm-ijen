<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guide;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use App\Services\ProfileMatchingService;

class PenilaianController extends Controller
{

    protected $profileMatchingService;

    public function __construct(ProfileMatchingService $profileMatchingService){
        $this->profileMatchingService = $profileMatchingService;
    }

    public function index()
    {
        $penilaians = Penilaian::with('guide')->get(); // Pastikan relasi di-load
        return view('penilaian.index', compact('penilaians'));
    }



    public function create()
{
    $kriterias = Kriteria::with('subkriterias')->get();
    $guides = Guide::all(); // Ambil semua guide dari database
    return view('penilaian.create', compact('kriterias', 'guides'));
}

public function store(Request $request)
{
    // dd($request->all()); // Debugging, cek apakah guide_id terkirim

    $request->validate([
        'guide_id' => 'required|exists:guides,id',
        'nilai' => 'required|array',
        'nilai.*' => 'required|integer|min:1|max:5',
    ]);

    $penilaian = Penilaian::create([
        'guide_id' => $request->guide_id,
    ]);

    foreach ($request->nilai as $subkriteriaId => $nilai) {
        $penilaian->detailPenilaians()->create([
            'subkriteria_id' => $subkriteriaId,
            'nilai' => $nilai,
        ]);
    }

    return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil ditambahkan.');
}




public function show(Penilaian $penilaian)
{
    $penilaian->load(['guide', 'detailPenilaians.subkriteria.kriteria']);
    $hasil = $this->hitungProfileMatching($penilaian);

    $kriteriaUnggulan = $this->tentukanKriteriaUnggulanshow($hasil); // tanpa perlu $kriterias

    return view('penilaian.show', compact('penilaian', 'hasil', 'kriteriaUnggulan'));
}





    private function hitungProfileMatching(Penilaian $penilaian)
{
    $hasilPerhitungan = [];
    $nilaiTotalKriteria = [];

    foreach ($penilaian->detailPenilaians as $detail) {
        $subkriteria = $detail->subkriteria;
        $kriteria = $subkriteria->kriteria;

        $gap = $this->profileMatchingService->hitungGap($detail->nilai, $subkriteria->profil_standar);
        $bobotNilai = $this->profileMatchingService->konversiGap($gap);

        if (!isset($hasilPerhitungan[$kriteria->id])) {
            $hasilPerhitungan[$kriteria->id] = [
                'nama' => $kriteria->nama,
                'core_factor' => [],
                'secondary_factor' => [],
                'detail' => []
            ];
        }

        $faktorKey = $subkriteria->is_core_factor ? 'core_factor' : 'secondary_factor';
        $hasilPerhitungan[$kriteria->id][$faktorKey][] = $bobotNilai;

        $hasilPerhitungan[$kriteria->id]['detail'][] = [
            'subkriteria_id' => $subkriteria->id,
            'nama_subkriteria' => $subkriteria->nama,
            'nilai' => $detail->nilai,
            'profil_standar' => $subkriteria->profil_standar,
            'gap' => $gap,
            'bobot_nilai' => $bobotNilai,
            'is_core_factor' => $subkriteria->is_core_factor
        ];
    }

    foreach ($hasilPerhitungan as $kriteriaId => $hasil) {
        $nilaiCoreFactor = !empty($hasil['core_factor']) ? array_sum($hasil['core_factor']) / count($hasil['core_factor']) : 0;
        $nilaiSecondaryFactor = !empty($hasil['secondary_factor']) ? array_sum($hasil['secondary_factor']) / count($hasil['secondary_factor']) : 0;

        $nilaiTotalKriteria[$kriteriaId] = $this->profileMatchingService->hitungNilaiTotalKriteria($nilaiCoreFactor, $nilaiSecondaryFactor);

        $hasilPerhitungan[$kriteriaId]['nilai_cf'] = $nilaiCoreFactor;
        $hasilPerhitungan[$kriteriaId]['nilai_sf'] = $nilaiSecondaryFactor;
        $hasilPerhitungan[$kriteriaId]['nilai_total'] = $nilaiTotalKriteria[$kriteriaId];
    }

    $nilaiAkhir = $this->profileMatchingService->hitungNilaiAkhir($nilaiTotalKriteria);



    return [
        'detail' => $hasilPerhitungan,
        'nilai_akhir' => $nilaiAkhir
    ];
}

public function edit(Penilaian $penilaian)
{
    $kriterias = Kriteria::with('subkriterias')->get();
    $guides = Guide::all(); // Ambil daftar guide
    $penilaian->load('detailPenilaians', 'guide'); // Tambahkan relasi guide
    return view('penilaian.edit', compact('penilaian', 'kriterias', 'guides'));
}


    public function update(Request $request, Penilaian $penilaian)
    {
        $request->validate([
            // 'nama_kandidat' => 'required',
            'nilai' => 'required|array',
            'nilai.*' => 'required|integer|min:1|max:5',
        ]);

        // $penilaian->update([
        //     'nama_kandidat' => $request->nama_kandidat,
        // ]);

        foreach ($request->nilai as $subkriteriaId => $nilai) {
            $penilaian->detailPenilaians()->updateOrCreate(
                ['subkriteria_id' => $subkriteriaId],
                ['nilai' => $nilai]
            );
        }

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy(Penilaian $penilaian)
    {
        $penilaian->delete();
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil dihapus.');
    }

    public function all()
{
    $penilaians = Penilaian::with(['detailPenilaians.subkriteria.kriteria', 'guide'])->get(); // Tambah guide
    $kriterias = Kriteria::with('subkriterias')->get();

    $hasilPenilaians = $penilaians->map(function ($penilaian) use ($kriterias) {
        $hasil = $this->hitungProfileMatching($penilaian);
        return [
            'penilaian' => $penilaian,
            'hasil' => $hasil,
            'kriteria_unggulan' => $this->tentukanKriteriaUnggulan([
                'penilaian' => $penilaian,
                'hasil' => $hasil,
            ], $kriterias)
        ];
    });


    $hasilPerKriteria = $this->groupHasilByKriteria($hasilPenilaians, $kriterias);

    $rankingKandidat = $hasilPenilaians->sortByDesc(function ($item) {
        return $item['hasil']['nilai_akhir'];
    })->values();



    return view('penilaian.all', compact('hasilPerKriteria', 'rankingKandidat', 'kriterias'));
}


    private function groupHasilByKriteria(Collection $hasilPenilaians, Collection $kriterias)
    {
        $hasilPerKriteria = [];

        foreach ($kriterias as $kriteria) {
            $hasilPerKriteria[$kriteria->id] = [
                'nama_kriteria' => $kriteria->nama,
                'subkriterias' => $kriteria->subkriterias,
                'kandidat_results' => []
            ];

            foreach ($hasilPenilaians as $hasil) {
                $kriteriaResult = $hasil['hasil']['detail'][$kriteria->id] ?? null;
                if ($kriteriaResult) {
                    $hasilPerKriteria[$kriteria->id]['kandidat_results'][] = [
                        'nama_guide' => $hasil['penilaian']->guide->nama_guide ?? 'Tidak Diketahui',
                        'nilai_cf' => $kriteriaResult['nilai_cf'],
                        'nilai_sf' => $kriteriaResult['nilai_sf'],
                        'nilai_total' => $kriteriaResult['nilai_total'],
                        'detail' => $kriteriaResult['detail']
                    ];
                }
            }
        }

        return $hasilPerKriteria;
    }



public function generateCandidatesReport()
{
    // Retrieve all candidates from the penilaian table
    $penilaians = Penilaian::with('detailPenilaians.subkriteria.kriteria')->get();

    $hasilPenilaians = $penilaians->map(function ($penilaian) {
            return [
                'penilaian' => $penilaian,
                'hasil' => $this->hitungProfileMatching($penilaian)
            ];
        });

    $rankingKandidat = $hasilPenilaians->sortByDesc(function ($item) {
            return $item['hasil']['nilai_akhir'];
        })->values();

    // Generate filename based on current date and time
    $filename = 'laporan_kandidat_' . Carbon::now()->format('d-m-Y_His') . '.pdf';

    // Load the view and pass the candidates data
    $pdf = Pdf::loadView('pdf.candidates', compact('rankingKandidat'));

    // Download the PDF with the timestamped filename
    return $pdf->download($filename);
}

public function generatePenilaianPdf($status = 'all')
{
    $penilaians = Penilaian::with('detailPenilaians.subkriteria.kriteria')->get();
    $kriterias = Kriteria::with('subkriterias')->get();

    $hasilPenilaians = $penilaians->map(function ($penilaian) {
        return [
            'penilaian' => $penilaian,
            'hasil' => $this->hitungProfileMatching($penilaian)
        ];
    });

    $rankingKandidat = $hasilPenilaians->sortByDesc(function ($item) {
        return $item['hasil']['nilai_akhir'];
    })->values();

    // Filter results based on status
    if ($status === 'accepted') {
        $rankingKandidat = $rankingKandidat->take(1); // Only the top candidate
    } elseif ($status === 'rejected') {
        $rankingKandidat = $rankingKandidat->slice(1); // All except the top candidate
    }

    $hasilPerKriteria = $this->groupHasilByKriteria($rankingKandidat, $kriterias);

    // Generate filename based on current date and time and status
    $filename = 'laporan_penilaian_' . $status . '_' . Carbon::now()->format('d-m-Y_His') . '.pdf';

    // Load the view and pass the candidates data
    $pdf = Pdf::loadView('pdf.penilaian', compact('hasilPerKriteria', 'rankingKandidat', 'kriterias'));

    return $pdf->download($filename);
}


// private function tentukanKriteriaUnggulanshow($hasil)
// {
//     $max = null;
//     $kriteriaUnggul = null;

//     foreach ($hasil['detail'] as $kriteriaId => $kriteriaDetail) {
//         $nilai = $kriteriaDetail['nilai_total'] ?? null;
//         if ($nilai !== null && ($max === null || $nilai > $max)) {
//             $max = $nilai;
//             $kriteriaUnggul = $kriteriaDetail['nama_kriteria'] ?? 'Tidak Diketahui';
//         }
//     }

//     return $kriteriaUnggul;
// }

public function tentukanKriteriaUnggulan($hasil, $kriterias)
{
    $max = null;
    $kriteriaUnggul = null;

    foreach ($kriterias as $kriteria) {
        $nilai = $hasil['hasil']['detail'][$kriteria->id]['nilai_total'] ?? null;
        if ($nilai !== null && ($max === null || $nilai > $max)) {
            $max = $nilai;
            $kriteriaUnggul = $kriteria->nama;
        }
    }

    return $kriteriaUnggul;
}

public function tentukanKriteriaUnggulanshow($hasil)
{
    $max = null;
    $kriteriaUnggul = 'Tidak Diketahui';

    foreach ($hasil['detail'] as $detail) {
        $nilai = $detail['nilai_total'] ?? null;
        if ($nilai !== null && ($max === null || $nilai > $max)) {
            $max = $nilai;
            $kriteriaUnggul = $detail['nama']; // langsung ambil nama dari detail
        }
    }

    return $kriteriaUnggul;
}




}
