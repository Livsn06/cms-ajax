<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;

class CreateBookingController extends Controller
{

    public function index()
    {
        $packages = Package::all();
        return view('admin.order.create-order', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|integer',
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'guest_count' => 'required|integer|min:1',
            'event_date' => 'required|date',
            'total_price' => 'required|numeric|min:0',
        ]);

        Booking::create($request->all());
        return response()->json(['success' => true, 'message' => 'Booking created successfully']);
    }
}
