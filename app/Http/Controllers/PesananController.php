<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Paket;
use App\Models\Pesanan;
use App\Models\Kriteria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\OrderStoredMail;
use App\Traits\KriteriaTrait;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Services\ProfileMatchingService;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderStoredNotification;
use App\Traits\ProfileMatchingTrait; // Pastikan sudah pakai trait ini di controller!




class PesananController extends Controller
{
   public function index(Request $request)
{
    // Mulai query builder
    $query = Pesanan::with(['kriteria', 'paket', 'guide']);

    // Cek apakah ada parameter pencarian (q)
    if ($request->filled('q')) {
        $search = $request->q;
        $query->where(function ($q) use ($search) {
            $q->where('order_id', 'like', '%' . $search . '%')
              ->orWhere('nama', 'like', '%' . $search . '%');
        });
    }

    // Ambil data
    $pesanans = $query->orderBy('created_at', 'desc')->get();

    // Kirim ke view
    return view('pesanan.index', compact('pesanans'));
}

    public function show($id)
{
    // Mencari data pesanan berdasarkan ID, termasuk relasi kriteria, paket, dan guide
    $pesanan = Pesanan::with(['kriteria', 'paket', 'guide'])->findOrFail($id);

    // Mengirim data pesanan ke view show
    return view('pesanan.show', compact('pesanan'));
}



    public function create($id_paket = null)
    {
        $kriterias = Kriteria::all();
        $pakets = Paket::all();
        $selectedPaketId = $id_paket; // Ambil id_paket yang diterima dari URL

        // Ambil data paket berdasarkan id_paket yang dipilih
        $paketDetail = null;
        if ($id_paket) {
            $paketDetail = Paket::find($id_paket); // Menyimpan data paket berdasarkan id_paket
        }

        return view('pesanan.create', compact('kriterias', 'pakets', 'selectedPaketId', 'paketDetail'));
    }









    public function store(Request $request)
    {
        // Validasi input data
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'nomor_telp' => 'required|string|max:20',
            'id_kriteria' => 'required|exists:kriterias,id',
            'id_paket' => 'required|exists:pakets,id',
            'tanggal_pesan' => 'required|date',
            'tanggal_keberangkatan' => 'required|date|after_or_equal:tanggal_pesan',
            'jumlah_peserta' => 'required|integer|min:1',
            'negara' => 'required|string|max:100',
            'bahasa' => 'required|string|max:100',
            'riwayat_medis' => 'required|string',
            'paspor' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Maksimal 5MB
            'special_request' => 'nullable|string',
            'status' => 'nullable|boolean',  // Menambahkan validasi untuk status (nullable dan boolean)
            'id_guide' => 'nullable|exists:guides,id',  // Menambahkan validasi id_guide
        ], [
            'tanggal_keberangkatan.after_or_equal' => 'The departure date must be the same as or after the booking date.',
        ]);


        // Simpan file paspor jika ada
        if ($request->hasFile('paspor')) {
            // Menyimpan file paspor dan mendapatkan path
            $pasporPath = $request->file('paspor')->store('paspor', 'public');
            $validated['paspor'] = $pasporPath;  // Menambahkan path paspor ke data yang tervalidasi
        }

        // Tambahkan 'id_guide' ke dalam data yang divalidasi
        $validated['id_guide'] = $request->id_guide;  // Pastikan id_guide ada di request

        $validated['order_id'] = 'ORDER' . now()->format('Ymd') . strtoupper(Str::random(4));


        // Simpan pesanan ke database
        $pesanan = Pesanan::create($validated);  // Pastikan model pesanan dapat menangani atribut yang diberikan

        // Kirim notifikasi ke email
        try {
            Mail::to('sandipermadi625@gmail.com')->send(new OrderStoredMail($pesanan));
        } catch (\Exception $e) {
            // Log error jika gagal mengirim email
            Log::error('Gagal mengirim email: ' . $e->getMessage());
        }

        // Redirect ke halaman create ulang dengan pesan sukses
        return redirect()->route('pesanan.create', ['id_paket' => $request->id_paket])
            ->with('success', 'Order saved successfully!');
    }












use KriteriaTrait;
use ProfileMatchingTrait; // <-- pakai trait ini

protected $profileMatchingService; // <-- property untuk service injection

public function __construct(ProfileMatchingService $profileMatchingService)
{
    $this->profileMatchingService = $profileMatchingService; // Inject service
}

public function edit($id)
{
    $pesanan = Pesanan::with(['kriteria', 'guide.penilaians.detailPenilaians.subkriteria.kriteria'])->findOrFail($id);

    $kriterias = Kriteria::all();
    $pakets = Paket::all();
    $guides = Guide::with(['kriteria', 'penilaians.detailPenilaians.subkriteria.kriteria'])
    ->where('status', 'aktif')
    ->get();

    foreach ($guides as $guide) {
        $penilaian = $guide->penilaians->first();

        if ($penilaian) {
            $hasil = $this->hitungProfileMatching($penilaian);
            $kriteriaUnggul = $this->tentukanKriteriaUnggulanshow($hasil);
        } else {
            $kriteriaUnggul = 'Belum Dinilai';
        }

        $guide->kriteria_unggulan = $kriteriaUnggul;
    }

    return view('pesanan.edit', compact('pesanan', 'kriterias', 'pakets', 'guides'));
}







    public function update(Request $request, $id)
    {
        // Validasi input data
        $request->validate([
            'nama' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'nomor_telp' => 'required|string|max:20',
            'id_kriteria' => 'required|exists:kriterias,id',
            'id_paket' => 'required|exists:pakets,id',
            'tanggal_pesan' => 'required|date',
            'tanggal_keberangkatan' => 'required|date|after_or_equal:tanggal_pesan',
            'jumlah_peserta' => 'required|integer|min:1',
            'negara' => 'required|string|max:100',
            'bahasa' => 'required|string|max:100',
            'riwayat_medis' => 'required|string',
            'paspor' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Maksimal 5MB
            'special_request' => 'nullable|string',
            'status' => 'nullable|boolean',
            'id_guide' => 'nullable|exists:guides,id',  // Validasi id_guide yang nullable
        ]);

        // Cari pesanan yang ingin diupdate
        $pesanan = Pesanan::findOrFail($id);

        // Jika ada file paspor yang diupload, simpan file dan perbarui path-nya
        if ($request->hasFile('paspor')) {
            // Hapus paspor lama jika ada
            if ($pesanan->paspor && Storage::exists('public/' . $pesanan->paspor)) {
                Storage::delete('public/' . $pesanan->paspor);
            }

            // Simpan file paspor yang baru
            $pasporPath = $request->file('paspor')->store('paspor', 'public');
        } else {
            // Jika tidak ada file paspor baru, gunakan path lama
            $pasporPath = $pesanan->paspor;
        }

        // Update data pesanan
        $pesanan->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_telp' => $request->nomor_telp,
            'id_kriteria' => $request->id_kriteria,
            'id_paket' => $request->id_paket,
            'tanggal_pesan' => $request->tanggal_pesan,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'jumlah_peserta' => $request->jumlah_peserta,
            'negara' => $request->negara,
            'bahasa' => $request->bahasa,
            'riwayat_medis' => $request->riwayat_medis,
            'paspor' => $pasporPath,  // Mempertahankan file paspor yang lama atau menggantinya jika baru
            'special_request' => $request->special_request,
            'status' => $request->has('status') ? $request->status : 0,
            'id_guide' => $request->id_guide,  // Update id_guide jika ada
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diperbarui.');
    }







    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Hapus data pesanan
        $pesanan->delete();

        return redirect()->route('pesanan.index', $id)->with('success', 'Pesanan berhasil dihapus');
    }
}
