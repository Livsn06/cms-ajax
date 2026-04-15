<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;

class EditOrderController extends Controller
{
    public function index(Booking $booking)
    {
        $packages = Package::all();
        $booking->load('package');
        return view('admin.order.edit-order', compact('booking', 'packages'));
    }


    public function update(Request $request, int $id)
    {
        $request->validate([
            'package_id' => 'required',
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'guest_count' => 'required|integer|min:1',
            'event_date' => 'required|date',
            'total_price' => 'required|numeric|min:0',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($request->all());
        return response()->json(['success' => true, 'message' => 'Booking updated successfully']);
    }
}
