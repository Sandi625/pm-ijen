<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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
            'photo' => 'nullable|image',
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





}
