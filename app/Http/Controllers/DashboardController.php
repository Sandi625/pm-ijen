<?php

namespace App\Http\Controllers;


use App\Models\Penilaian;
use App\Models\Kriteria;
use App\Models\Subkriteria;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenilaian = Penilaian::count();
        $totalKriteria = Kriteria::count();
        $totalSubkriteria = Subkriteria::count();
        $recentPenilaians = Penilaian::latest()->limit(5)->get(); // Mengambil 5 penilaian terbaru

        return view('dashboard', compact('totalPenilaian', 'totalKriteria', 'totalSubkriteria', 'recentPenilaians'));
    }
}
