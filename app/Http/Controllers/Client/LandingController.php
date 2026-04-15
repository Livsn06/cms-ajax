<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('client.landingpage', compact('packages'));
    }
}
