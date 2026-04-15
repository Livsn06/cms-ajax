<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Package $package)
    {
        return view('client.bookingpage', compact('package'));
    }
}
