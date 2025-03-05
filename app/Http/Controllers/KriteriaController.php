<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    // Menampilkan daftar kriteria
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('kriteria.index', compact('kriterias'));
    }

    // Menampilkan form untuk menambah kriteria baru
    public function create()
    {
        return view('kriteria.create');
    }

    // Menyimpan kriteria baru
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'deskripsi' => 'nullable',
    ]);

    // Mendapatkan kode kriteria terakhir
    $lastKriteria = Kriteria::orderBy('kode', 'desc')->first();
    
    if ($lastKriteria) {
        // Jika ada kriteria sebelumnya, increment nomor
        $lastNumber = intval(substr($lastKriteria->kode, 1));
        $newNumber = $lastNumber + 1;
    } else {
        // Jika belum ada kriteria, mulai dari 1
        $newNumber = 1;
    }

    // Format kode baru
    $newKode = 'K' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    // Buat kriteria baru
    Kriteria::create([
        'kode' => $newKode,
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
}

    // Menampilkan form untuk mengedit kriteria
    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    // Memperbarui kriteria
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|unique:kriterias,kode,' . $id,
            'nama' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $kriteria = Kriteria::find($id);

        $kriteria->update($request->all());

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    // Menghapus kriteria
    public function destroy($id)
    {

        $kriteriaFind = Kriteria::findOrFail($id);  
        $kriteriaFind->delete();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
