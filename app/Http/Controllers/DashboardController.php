<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Guide;
use App\Models\Paket;
use App\Models\Review;
use App\Models\Pesanan;
use App\Models\Kriteria;
use App\Models\Penilaian;

use App\Models\Subkriteria;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenilaian = Penilaian::count();
        $totalKriteria = Kriteria::count();
        $totalSubkriteria = Subkriteria::count();
        $recentPenilaians = Penilaian::latest()->limit(5)->get();
        $guides = Guide::all();
        $reviews = Review::latest()->limit(5)->get();
        $pesanans = Pesanan::latest()->limit(5)->get();

        $totalReviews = Review::count();
        $totalPesananBulanIni = Pesanan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $totalPaket = Paket::count(); // ✅ Tambahan

        return view('dashboard', compact(
            'totalPenilaian', 'totalKriteria', 'totalSubkriteria',
            'recentPenilaians', 'guides', 'reviews', 'pesanans',
            'totalPesananBulanIni', 'totalReviews', 'totalPaket'
        ));
    }




    public function chartPesananPerBulan()
{
    $pesananPerBulan = DB::table('pesanans')
        ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();

    $bulanLabels = [];
    $dataTotal = [];

    for ($i = 1; $i <= 12; $i++) {
        $bulanLabels[] = date('F', mktime(0, 0, 0, $i, 1)); // nama bulan Inggris
        $dataTotal[] = $pesananPerBulan->firstWhere('bulan', $i)->total ?? 0;
    }

    return response()->json([
        'labels' => $bulanLabels,
        'data' => $dataTotal,
    ]);
}

public function chartPenilaianGuide()
{
    $guides = Guide::with('penilaians.detailPenilaians')->get();

    $data = collect(); // ini untuk menyimpan hasil akhir

    foreach ($guides as $guide) {
        $nilai = $guide->penilaians->flatMap->detailPenilaians
            ->where('sumber', 'pelanggan')
            ->pluck('nilai');

        $data->push([
            'guide' => $guide->nama_guide,
            'rata_rata' => round($nilai->avg() ?? 0, 2)
        ]);
    }

    return response()->json([
        'labels' => $data->pluck('guide'),
        'data' => $data->pluck('rata_rata'),
    ]);
}



}
