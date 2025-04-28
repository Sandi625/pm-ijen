<?php

namespace App\Http\Controllers;

use App\Models\Pesanan; // Make sure to import the Pesanan model
use Illuminate\Http\Request;

class HalguideController extends Controller
{
    public function index()
{
    // Fetch all pesanan records from the database
    $pesanans = Pesanan::all(); // You can modify this to include pagination or any other filters

    // Return the view with the pesanan data
    return view('halamanguide.index', compact('pesanans'));
}


}
