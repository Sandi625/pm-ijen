<?php

namespace App\Http\Controllers;


use App\Models\Guide;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Subkriteria;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenilaian = Penilaian::count();
        $totalKriteria = Kriteria::count();
        $totalSubkriteria = Subkriteria::count();
        $recentPenilaians = Penilaian::latest()->limit(5)->get(); // Mengambil 5 penilaian terbaru
        $guides = Guide::all(); // Ambil semua data guide

        return view('dashboard', compact('totalPenilaian', 'totalKriteria', 'totalSubkriteria', 'recentPenilaians','guides'));
    }
}
