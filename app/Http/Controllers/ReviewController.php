<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Review;
use App\Models\Pesanan;
use App\Models\Penilaian;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use App\Models\DetailPesanan;
use App\Models\DetailPenilaian;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;


class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $reviews = DB::table('reviews')
            ->join('guides', 'reviews.guide_id', '=', 'guides.id')
            ->where('reviews.status', 1)
            ->select('reviews.*', 'guides.nama_guide')
            ->get();

        $guides = DB::table('guides')->get();

        $pesanan = null;
        if ($user) {
            $pesanan = DB::table('pesanans')->where('email', $user->email)->latest('created_at')->first();
        }

        $selectedGuideId = $pesanan ? $pesanan->id_guide : ($guides->isNotEmpty() ? $guides->first()->id : null);

        return view('review.review', [
            'reviews' => $reviews,
            'guides' => $guides,
            'selectedGuideId' => $selectedGuideId,
            'pesanan' => $pesanan,  // tambahkan ini
        ]);
    }
















    public function show($id)
    {
        // Ambil data review beserta guide
        $review = DB::table('reviews')
            ->leftJoin('guides', 'reviews.guide_id', '=', 'guides.id')
            ->select('reviews.*', 'guides.nama_guide')
            ->where('reviews.id', $id)
            ->first();

        // Jika tidak ditemukan, lempar 404
        if (!$review) {
            abort(404, 'Review tidak ditemukan');
        }

        // Kirim data ke view review.show
        return view('adminreview.show', compact('review'));
    }





    public function create()
    {
        $guides = Guide::orderBy('nama_guide')->get();

        return view('adminreview.create', compact('guides'));
    }



    /**
     * Store a newly created review in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|string|max:100',
        'rating' => 'required|integer|between:1,5',
        'isi_testimoni' => 'required|string',
        'guide_id' => 'required|exists:guides,id',
        'pesanan_id' => 'required|exists:pesanans,id',
        'photo' => 'nullable|image|max:2048',
        'status' => 'nullable|boolean',
    ]);

    DB::transaction(function () use ($validated, $request) {
        $review = new Review($validated);

        if ($request->hasFile('photo')) {
            $review->photo = $request->file('photo')->store('photos', 'public');
        } else {
            $review->photo = 'images/default-avatar.jpg';
        }

        $review->save();

        // Ambil detail pesanan terkait pesanan_id di review
        $detailPesanans = DetailPesanan::where('pesanan_id', $review->pesanan_id)->get();

        // Nilai prioritas core factor dan secondary factor jika rating tertinggi (5)
        $nilaiByPrioritasCore = [
            1 => 5,
            2 => 3,
            3 => 1,
        ];

        $nilaiByPrioritasSecondary = [
            1 => 3,
            2 => 2,
            3 => 1,
        ];

        // Tetapkan prioritas berdasar rating yang sama untuk semua kriteria
        $nilaiKriteria = [];
        foreach ($detailPesanans as $detail) {
            $nilaiKriteria[$detail->kriteria_id] = $review->rating;
        }
        arsort($nilaiKriteria);

        $prioritas = 1;
        foreach ($nilaiKriteria as $kriteria_id => $nilai) {
            DetailPesanan::where('pesanan_id', $review->pesanan_id)
                ->where('kriteria_id', $kriteria_id)
                ->update(['prioritas' => $prioritas]);
            $prioritas++;
        }

        // Buat atau ambil penilaian
        $penilaian = Penilaian::firstOrCreate([
            'guide_id' => $review->guide_id,
            'id_pesanan' => $review->pesanan_id,
        ]);

        foreach ($detailPesanans as $detail) {
            $prioritas = $detail->prioritas;

            $subkriterias = Subkriteria::where('kriteria_id', $detail->kriteria_id)->get();

            foreach ($subkriterias as $subkriteria) {
                // Ambil nilai dasar dari prioritas, default rating user jika tidak ada mapping
                $nilaiDasar = ($subkriteria->jenis_faktor === 'Core Factor')
                    ? ($nilaiByPrioritasCore[$prioritas] ?? $review->rating)
                    : ($nilaiByPrioritasSecondary[$prioritas] ?? $review->rating);

                // Skala nilai supaya mengikuti rating user:
                // Jika rating user < nilaiDasar, turunkan nilaiDasar ke rating user tapi minimal 1
                $nilaiSub = min($nilaiDasar, max(1, $review->rating));

                DetailPenilaian::create([
                    'penilaian_id' => $penilaian->id,
                    'subkriteria_id' => $subkriteria->id,
                    'nilai' => $nilaiSub,
                    'detail_pesanan_id' => $detail->id,
                    'sumber' => 'pelanggan',
                ]);
            }
        }
    });

    return redirect()->route('review.review')->with('success', 'Review has been created and linked to penilaian.');
}


















    public function edit($id)
    {
        $review = Review::with('guide')->findOrFail($id);
        $guides = Guide::all(); // Ambil semua guide untuk select

        return view('adminreview.edit', compact('review', 'guides'));
    }



    /**
     * Update the specified review in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'guide_id' => 'required|exists:guides,id',
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'rating' => 'required|integer|between:1,5',
            'isi_testimoni' => 'required|string',
            'photo' => 'nullable|image|max:2048', // Maksimal 2MB untuk gambar
            'status' => 'nullable|boolean',
        ]);

        // Isi data validated
        $review->guide_id = $validated['guide_id'];
        $review->name = $validated['name'];
        $review->email = $validated['email'];
        $review->rating = $validated['rating'];
        $review->isi_testimoni = $validated['isi_testimoni'];
        $review->status = $validated['status'] ?? 0; // default ke 0 kalau null

        // Cek dan ganti foto jika ada upload baru
        if ($request->hasFile('photo')) {
            if ($review->photo && Storage::disk('public')->exists($review->photo)) {
                Storage::disk('public')->delete($review->photo); // Hapus foto lama
            }
            $review->photo = $request->file('photo')->store('photos', 'public');
        }

        $review->save();

        return redirect()->route('review.all')->with('success', 'Review has been updated.');
    }


    /**
     * Remove the specified review from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->photo && Storage::disk('public')->exists($review->photo)) {
            Storage::disk('public')->delete($review->photo);
        }

        $review->delete();

        return redirect()->route('review.all')->with('success', 'Review has been deleted.');
    }


    public function allReviews(Request $request)
    {
        $query = DB::table('reviews')
            ->join('guides', 'reviews.guide_id', '=', 'guides.id')
            ->select('reviews.*', 'guides.nama_guide');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('guides.nama_guide', 'like', '%' . $search . '%')
                    ->orWhere('reviews.rating', 'like', '%' . $search . '%');
            });
        }

        $reviews = $query->get();

        return view('adminreview.index', compact('reviews'));
    }



    public function getActiveReviews()
    {
        $reviews = Review::with('guide') // pastikan relasi 'guide' ada di model Review
            ->where('status', 1)
            ->latest()
            ->get();

        return view('welcome', compact('reviews'));
    }
}
