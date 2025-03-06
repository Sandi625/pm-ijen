<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        return view('paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('paket.create');
    }

     public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_paket' => 'required|string|max:150',
            'deskripsi_paket' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
            'durasi' => 'required|integer|min:1',
            'destinasi' => 'required|string|max:255',
            'include_exclude' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Proses upload foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('paket_fotos', 'public');
        }

        // Simpan ke database
        Paket::create([
            'nama_paket' => $request->nama_paket,
            'deskripsi_paket' => $request->deskripsi_paket,
            'harga' => $request->harga,
            'durasi' => $request->durasi,
            'destinasi' => $request->destinasi,
            'include_exclude' => $request->include_exclude,
            'foto' => $fotoPath,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    public function edit($id)
{
    $paket = Paket::findOrFail($id);
    return view('paket.edit', compact('paket'));
}

public function update(Request $request, $id)
{
    $paket = Paket::findOrFail($id);

    // Validasi data
    $request->validate([
        'nama_paket'      => 'required|string|max:150',
        'deskripsi_paket' => 'nullable|string',
        'harga'           => 'required|numeric|min:0',
        'durasi'          => 'required|integer|min:1',
        'destinasi'       => 'required|string|max:255',
        'include_exclude' => 'nullable|string',
        'foto'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // Update data
    $paket->nama_paket = $request->nama_paket;
    $paket->deskripsi_paket = $request->deskripsi_paket;
    $paket->harga = $request->harga;
    $paket->durasi = $request->durasi;
    $paket->destinasi = $request->destinasi;
    $paket->include_exclude = $request->include_exclude;

    // Handle foto upload (jika ada file baru)
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($paket->foto) {
            Storage::delete('public/' . $paket->foto);
        }

        // Simpan foto baru
        $fotoPath = $request->file('foto')->store('paket', 'public');
        $paket->foto = $fotoPath;
    }

    $paket->save();

    return redirect()->route('paket.index')->with('success', 'Paket berhasil diperbarui!');
}

public function destroy($id)
{
    $paket = Paket::findOrFail($id);

    // Hapus foto jika ada
    if ($paket->foto) {
        Storage::delete('public/' . $paket->foto);
    }

    // Hapus data paket
    $paket->delete();

    return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus!');
}



}
