<?php

namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Review;
use Illuminate\Http\Request;
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
        $reviews = DB::table('reviews')
            ->join('guides', 'reviews.guide_id', '=', 'guides.id')
            ->where('reviews.status', 1)
            ->select('reviews.*', 'guides.nama_guide')
            ->get();

        $guides = DB::table('guides')->get(); // fetch all guides

        return view('review.review', [
            'reviews' => $reviews,
            'guides' => $guides
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
            'guide_id' => 'required|exists:guides,id', // Make sure guide_id exists
            'photo' => 'nullable|image|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $review = new Review($validated);

        if ($request->hasFile('photo')) {
            $review->photo = $request->file('photo')->store('photos', 'public');
        } else {
            $review->photo = 'images/default-avatar.jpg';
        }

        $review->save();

        return redirect()->route('review.review')->with('success', 'Review has been created please check again later.');
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


    public function allReviews()
    {
        $reviews = DB::table('reviews')
            ->join('guides', 'reviews.guide_id', '=', 'guides.id')
            ->select('reviews.*', 'guides.nama_guide')
            ->get();

        return view('adminreview.index', compact('reviews'));
    }
}
