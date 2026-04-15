<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class DeleteOrderController extends Controller
{
    public function destroy(int $id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        return response()->json(['success' => true, 'message' => 'Booking deleted successfully']);
    }
}
