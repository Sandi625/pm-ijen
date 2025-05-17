<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pesanan;
use App\Models\Kriteria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\OrderStoredMail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class HalPelangganController extends Controller
{
    /**
     * Show all packages for customers.
     */
    public function showPackages()
    {
        $pakets = Paket::all();
        return view('halamanpelanggan.dashboardpelanggan', compact('pakets'));
    }

    /**
     * Show order creation form with optional package id.
     */
    // public function ($package_id = null)
    // {
    //     $kriterias = Kriteria::all();
    //     $pakets = Paket::all();
    //     $selectedPaketId = $package_id;

    //     $paketDetail = null;
    //     if ($package_id) {
    //         $paketDetail = Paket::find($package_id);
    //     }

    //     return view('halamanpelanggan.create', compact('kriterias', 'pakets', 'selectedPaketId', 'paketDetail'));
    // }

    //  public function showCreateOrderForm($id_paket = null)
    // {
    //     $kriterias = Kriteria::all();
    //     $pakets = Paket::all();
    //     $selectedPaketId = $id_paket; // Ambil id_paket yang diterima dari URL

    //     // Ambil data paket berdasarkan id_paket yang dipilih
    //     $paketDetail = null;
    //     if ($id_paket) {
    //         $paketDetail = Paket::find($id_paket); // Menyimpan data paket berdasarkan id_paket
    //     }

    //     return view('halamanpelanggan.create', compact('kriterias', 'pakets', 'selectedPaketId', 'paketDetail'));
    // }

    /**
     * Store new order.
     */
    // public function storeOrder(Request $request)
    // {
    //     $validated = $request->validate([
    //         'nama' => 'required|string|max:100',
    //         'email' => 'required|email|max:100',
    //         'nomor_telp' => 'required|string|max:20',
    //         'id_kriteria' => 'required|exists:kriterias,id',
    //         'id_paket' => 'required|exists:pakets,id',
    //         'tanggal_pesan' => 'required|date',
    //         'tanggal_keberangkatan' => 'required|date|after_or_equal:tanggal_pesan',
    //         'jumlah_peserta' => 'required|integer|min:1',
    //         'negara' => 'required|string|max:100',
    //         'bahasa' => 'required|string|max:100',
    //         'riwayat_medis' => 'required|string',
    //         'paspor' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
    //         'special_request' => 'nullable|string',
    //         'status' => 'nullable|boolean',
    //         'id_guide' => 'nullable|exists:guides,id',
    //     ], [
    //         'tanggal_keberangkatan.after_or_equal' => 'The departure date must be the same as or after the booking date.',
    //     ]);

    //     if ($request->hasFile('paspor')) {
    //         $pasporPath = $request->file('paspor')->store('paspor', 'public');
    //         $validated['paspor'] = $pasporPath;
    //     }

    //     $validated['id_guide'] = $request->id_guide;
    //     $validated['order_id'] = 'ORDER' . now()->format('Ymd') . strtoupper(Str::random(4));

    //     $pesanan = Pesanan::create($validated);

    //     try {
    //         Mail::to('sandipermadi625@gmail.com')->send(new OrderStoredMail($pesanan));
    //     } catch (\Exception $e) {
    //         Log::error('Failed to send email: ' . $e->getMessage());
    //     }

    //     return redirect()->route('order.create', ['package_id' => $request->id_paket])
    //         ->with('success', 'Order saved successfully!');
    // }
}


