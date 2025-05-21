<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Review;

class LandingPageController extends Controller
{
public function index()
{
    $pakets = Paket::latest()->get();
    $reviews = Review::with('guide')->where('status', 1)->latest()->get();

    return view('welcome', compact('pakets', 'reviews'));
}


}

