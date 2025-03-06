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

    public function create()
{
    $kriterias = Kriteria::all();
    $pakets = Paket::all();
    return view('pesanan.create', compact('kriterias', 'pakets'));
}


public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:150',
        'email' => 'required|email|max:150|unique:pesanans,email',
        'nomor_telp' => 'required|string|max:20',
        'id_kriteria' => 'required|exists:kriterias,id',
        'id_paket' => 'required|exists:pakets,id',
        'tanggal_pesan' => 'required|date',
        'tanggal_keberangkatan' => 'required|date|after_or_equal:tanggal_pesan',
        'jumlah_peserta' => 'required|integer|min:1',
    ]);

    Pesanan::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'nomor_telp' => $request->nomor_telp,
        'id_kriteria' => $request->id_kriteria,
        'id_paket' => $request->id_paket,
        'tanggal_pesan' => $request->tanggal_pesan,
        'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
        'jumlah_peserta' => $request->jumlah_peserta,
    ]);

    return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan!');
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
