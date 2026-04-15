<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class CreatePaymentController extends Controller
{
    public function index(Booking $booking)
    {
        $booking->load('package', 'payments');
        return view('admin.payment.create-payment', compact('booking'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|integer',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        $booking = Booking::find($request->booking_id);
        $booking->payments()->create($request->all());
        return response()->json(['success' => true, 'message' => 'Payment created successfully']);
    }
}
