<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Traits\KriteriaTrait;
use App\Traits\ProfileMatchingTrait; // <--- tambahkan ini
use App\Services\ProfileMatchingService; // kalau butuh inject service

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuideController extends Controller
{
    use KriteriaTrait;
    use ProfileMatchingTrait; // <--- pakai trait ini

    protected $profileMatchingService; // <--- tambah ini

    public function __construct(ProfileMatchingService $profileMatchingService)
    {
        $this->profileMatchingService = $profileMatchingService; // inject service
    }

    public function index()
    {
        $guides = Guide::with(['kriteria', 'penilaians.detailPenilaians.subkriteria.kriteria'])->get();

        foreach ($guides as $guide) {
            // Ambil penilaian pertama
            $penilaian = $guide->penilaians->first();

            if ($penilaian) {
                // Hitung profile matching untuk penilaian ini
                $hasil = $this->hitungProfileMatching($penilaian);

                // Tentukan kriteria unggulan dari hasil itu
                $kriteriaUnggul = $this->tentukanKriteriaUnggulanshow($hasil);
            } else {
                $kriteriaUnggul = 'Belum Dinilai';
            }

            // Tambahkan atribut baru ke guide
            $guide->kriteria_unggulan = $kriteriaUnggul;
        }

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
            'status' => 'required|in:1,2,3',  // Validasi untuk status: 1 (Aktif), 2 (Sedang Guiding), 3 (Tidak Aktif)
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
            'status' => $request->status,  // Menyimpan status sesuai dengan pilihan 1, 2, atau 3
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
        'status' => 'required|in:1,2,3',  // Mengubah validasi untuk status agar mendukung 1 (Aktif), 2 (Sedang Guiding), 3 (Tidak Aktif)
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
        'status' => $request->status,  // Menyimpan status yang dipilih (1, 2, atau 3)
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
