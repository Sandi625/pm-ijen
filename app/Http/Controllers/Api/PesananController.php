<?php

namespace App\Http\Controllers\Api;

use App\Models\Guide;
use App\Models\Paket;
use App\Models\Pesanan;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ProfileMatchingService;

use Illuminate\Support\Str;
use App\Mail\OrderStoredMail;
use App\Traits\KriteriaTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderStoredNotification;
use App\Traits\ProfileMatchingTrait; // Pastikan sudah pakai trait ini di controller!


class PesananController extends Controller
{
public function getKriteria($id)
{
    $pesanan = Pesanan::with('kriteria')->find($id);

    if (!$pesanan) {
        return response()->json([
            'status' => 'error',
            'message' => 'Pesanan tidak ditemukan'
        ], 404);
    }

    // Ambil ID kriteria dari pesanan
    $pesananKriteriaId = $pesanan->id_kriteria;

    // Ambil semua guide dengan penilaiannya
    $guides = Guide::with('penilaians.detail_penilaians.subkriteria.kriteria')->get();

    $matchingGuides = [];

    foreach ($guides as $guide) {
        foreach ($guide->penilaians as $penilaian) {
            foreach ($penilaian->detail_penilaians as $detail) {
                if (
                    $detail->subkriteria &&
                    $detail->subkriteria->kriteria &&
                    $detail->subkriteria->kriteria->id == $pesananKriteriaId
                ) {
                    $matchingGuides[] = $guide->nama_guide;
                    break 3; // Keluar dari semua loop jika satu cocok
                }
            }
        }
    }

    return response()->json([
        'status' => 'success',
        'kriteria_pesanan' => $pesanan->kriteria,
        'matching_guides' => $matchingGuides,
    ]);
}

use KriteriaTrait;
use ProfileMatchingTrait; // <-- pakai trait ini

protected $profileMatchingService; // <-- property untuk service injection

public function __construct(ProfileMatchingService $profileMatchingService)
{
    $this->profileMatchingService = $profileMatchingService; // Inject service
}
public function editApi($id)
{
    $pesanan = Pesanan::with('kriteria')->find($id);

    if (!$pesanan) {
        return response()->json([
            'status' => 'error',
            'message' => 'Pesanan tidak ditemukan'
        ], 404);
    }

    $idKriteriaPesanan = $pesanan->id_kriteria; // Sesuai di form kamu

    if (!$idKriteriaPesanan) {
        return response()->json([
            'status' => 'error',
            'message' => 'Kriteria pada pesanan tidak ditemukan'
        ], 404);
    }

    $guides = Guide::with([
        'kriteria',
        'penilaians.detailPenilaians.subkriteria.kriteria'
    ])
    ->where('status', 'aktif')
    ->where('kriteria_id', $idKriteriaPesanan) // langsung filter guides yang kriteria sesuai pesanan
    ->get();

    $formattedGuides = $guides->map(function ($guide) use ($idKriteriaPesanan) {
        $penilaian = $guide->penilaians->first();

        if ($penilaian) {
            $hasil = $this->hitungProfileMatching($penilaian);

            // Contoh: kriteriaUnggul bisa berupa array atau objek, sesuaikan dengan hasil fungsi
            // Kita filter atau pilih kriteria unggulan yang ID-nya sama dengan pesanan
            if (is_array($hasil) || $hasil instanceof \Illuminate\Support\Collection) {
                $filtered = collect($hasil)->filter(function($item) use ($idKriteriaPesanan) {
                    // misal $item->id atau $item['id'] adalah id kriteria
                    return $item->id == $idKriteriaPesanan;
                })->first();

                $kriteriaUnggul = $filtered ?? 'Belum Dinilai';
            } else {
                // kalau cuma satu string/id
                $kriteriaUnggul = ($hasil == $idKriteriaPesanan) ? $hasil : 'Belum Dinilai';
            }

        } else {
            $kriteriaUnggul = 'Belum Dinilai';
        }

        return [
            'id' => $guide->id,
            'nama_guide' => $guide->nama, // sesuaikan nama field guide
            'kriteria' => $guide->kriteria,
            'kriteria_unggulan' => $kriteriaUnggul,
        ];
    });

    return response()->json([
        'status' => 'success',
        'data' => [
            'kriteria_pesanan' => $pesanan->kriteria,
            'guides' => $formattedGuides,
        ]
    ]);
}







}
