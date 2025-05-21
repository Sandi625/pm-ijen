<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Guide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotifGuideController extends Controller
{

public function guidesWithPesanan()
{
    $guides = Guide::whereHas('pesanans')->get();

    return view('notifguide.index', compact('guides'));
}



public function sendNotifToGuide($id)
{
    $guide = Guide::findOrFail($id);

    // Ganti "0" di awal nomor jadi "62" untuk format internasional
    $phone = preg_replace('/^0/', '62', $guide->nomer_hp);

    // Kirim pesan via Fonnte
        $response = Http::withHeaders([
            'Authorization' => 'HbHggEjszXST3WxTchcd' // Ganti dengan API key dari Fonnte
        ])->post('https://api.fonnte.com/send', [
            'target' => $phone,
            'message' => "Haloo {$guide->nama_guide}, Anda terpilih untuk melakukan guiding.\nSilakan login untuk melihat detailnya:\nhttp://localhost:8000/login",
        ]);


    if ($response->successful()) {
        return back()->with('success', 'Pesan berhasil dikirim via Fonnte!');
    } else {
        return back()->with('error', 'Gagal kirim pesan: ' . $response->body());
    }
}
}
