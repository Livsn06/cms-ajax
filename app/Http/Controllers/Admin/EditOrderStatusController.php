<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class EditOrderStatusController extends Controller
{
    public function update(Request $request, int $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);
        return response()->json(['success' => true, 'message' => 'Booking status updated successfully']);
    }
}
