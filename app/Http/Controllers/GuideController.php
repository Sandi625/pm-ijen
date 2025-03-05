<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::all();
        return view('guide.index', compact('guides'));
    }

    public function create()
    {
        return view('guide.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guide' => 'required|string|max:100',
            'salary' => 'required|numeric|min:0',
            'deskripsi_guide' => 'required|string',
            'nomer_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:guides,email',
            'bahasa' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
        ]);

        // Simpan data guide
        Guide::create([
            'nama_guide' => $request->nama_guide,
            'salary' => $request->salary,
            'deskripsi_guide' => $request->deskripsi_guide,
            'nomer_hp' => $request->nomer_hp,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'bahasa' => $request->bahasa,
            'foto' => $request->file('foto') ? $request->file('foto')->store('guides', 'public') : null,
            'status' => $request->status,
        ]);

        return redirect()->route('guide.index')->with('success', 'Guide berhasil ditambahkan!');
    }









    public function edit($id)
{
    $guide = Guide::findOrFail($id);
    return view('guide.edit', compact('guide'));
}









public function update(Request $request, $id)
{
    $request->validate([
        'nama_guide' => 'required|string|max:255',
        'salary' => 'required|numeric|min:0',
        'deskripsi_guide' => 'nullable|string',
        'nomer_hp' => 'required|string|max:15',
        'alamat' => 'required|string',
        'email' => 'required|email|unique:guides,email,' . $id . ',id',
        'bahasa' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'status' => 'required|boolean',
    ]);

    $guide = Guide::findOrFail($id);

    // Cek jika ada file foto yang diunggah
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($guide->foto) {
            Storage::disk('public')->delete($guide->foto);
        }
        // Simpan foto baru
        $fotoPath = $request->file('foto')->store('guides', 'public');
        $guide->foto = $fotoPath;
    }

    // Update data lainnya
    $guide->update([
        'nama_guide' => $request->nama_guide,
        'salary' => $request->salary,
        'deskripsi_guide' => $request->deskripsi_guide,
        'nomer_hp' => $request->nomer_hp,
        'alamat' => $request->alamat,
        'email' => $request->email,
        'bahasa' => $request->bahasa,
        'status' => $request->status,
    ]);

    return redirect()->route('guide.index')->with('success', 'Guide berhasil diperbarui.');
}




    public function destroy($id)
    {
        $guide = Guide::findOrFail($id);

        // Hapus foto jika ada
        if ($guide->foto) {
            Storage::disk('public')->delete($guide->foto);
        }

        $guide->delete();

        return redirect()->route('guide.index')->with('success', 'Guide berhasil dihapus.');
    }




}
