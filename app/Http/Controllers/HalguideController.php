<?php

namespace App\Http\Controllers;

use App\Models\Pesanan; // Make sure to import the Pesanan model
use Illuminate\Http\Request;

class HalguideController extends Controller
{
public function index()
{
    $pesanans = Pesanan::with('guide')->where('status', 1)->get();
    return view('halamanguide.index', compact('pesanans'));
}



public function showguide($id)
    {
        $pesanan = Pesanan::with(['guide', 'paket', 'kriteria'])->findOrFail($id);
        return view('halamanguide.show', compact('pesanan'));
    }




}
