<?php

namespace App\Http\Controllers;

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

        $reviews = DB::table('reviews')->where('status', 1)->get();


        return view('review.review', ['reviews' => $reviews]);
    }

    public function create()
{
    return view('adminreview.create');
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
            'photo' => 'nullable|image|max:2048', // Maksimal 2MB untuk gambar
            'status' => 'nullable|boolean',
        ]);

        $review = new Review($validated);

        if ($request->hasFile('photo')) {
            $review->photo = $request->file('photo')->store('photos', 'public');
        } else {
            $review->photo = 'images/default-avatar.jpg'; // avatar default (letakkan di public/images)
        }


        $review->save();

        return redirect()->route('review.review')->with('success', 'Review has been created please check again later.');
    }


    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('adminreview.edit', compact('review'));
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
            'name' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'rating' => 'required|integer|between:1,5',
            'isi_testimoni' => 'required|string',
            'photo' => 'nullable|image|max:2048', // Maksimal 2MB untuk gambar
            'status' => 'nullable|boolean',
        ]);

        $review->fill($validated);

        if ($request->hasFile('photo')) {
            if ($review->photo && Storage::disk('public')->exists($review->photo)) {
                Storage::disk('public')->delete($review->photo); // delete old photo
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
    $reviews = DB::table('reviews')->get(); // tanpa filter status
    return view('adminreview.index', compact('reviews'));
}




}
