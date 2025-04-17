<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Pesanan;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['kriteria', 'paket'])->get();
        return view('pesanan.index', compact('pesanans'));
    }

    public function create($id_paket = null)
    {
        $kriterias = Kriteria::all();
        $pakets = Paket::all();
        $selectedPaketId = $id_paket; // Ambil id_paket yang diterima dari URL

        return view('pesanan.create', compact('kriterias', 'pakets', 'selectedPaketId'));
    }




    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'nomor_telp' => 'required|string|max:20',
            'id_kriteria' => 'required|exists:kriterias,id',
            'id_paket' => 'required|exists:pakets,id',
            'tanggal_pesan' => 'required|date',
            'tanggal_keberangkatan' => 'required|date|after_or_equal:tanggal_pesan',
            'jumlah_peserta' => 'required|integer|min:1',
        ]);

        // Simpan ke database
        Pesanan::create($validated);

        // Redirect ke halaman create ulang dengan pesan sukses
        return redirect()->route('pesanan.create', ['id_paket' => $request->id_paket])
            ->with('success', 'Order saved successfully!');
    }






public function edit($id)
{
    $pesanan = Pesanan::findOrFail($id);
    $kriterias = Kriteria::all(); // Mengambil semua data kriteria
    $pakets = Paket::all(); // Mengambil semua data paket
    return view('pesanan.edit', compact('pesanan', 'kriterias', 'pakets'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:150',
        'email' => 'required|email|max:150',
        'nomor_telp' => 'required|string|max:20',
        'id_kriteria' => 'required|exists:kriterias,id',
        'id_paket' => 'required|exists:pakets,id',
        'tanggal_pesan' => 'required|date',
        'tanggal_keberangkatan' => 'required|date|after_or_equal:tanggal_pesan',
        'jumlah_peserta' => 'required|integer|min:1',
    ]);

    $pesanan = Pesanan::findOrFail($id);
    $pesanan->update([
        'nama' => $request->nama,
        'email' => $request->email,
        'nomor_telp' => $request->nomor_telp,
        'id_kriteria' => $request->id_kriteria,
        'id_paket' => $request->id_paket,
        'tanggal_pesan' => $request->tanggal_pesan,
        'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
        'jumlah_peserta' => $request->jumlah_peserta,
    ]);

    return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui');
}


public function destroy($id)
{
    $pesanan = Pesanan::findOrFail($id);

    // Hapus data pesanan
    $pesanan->delete();

    return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus!');
}



}
