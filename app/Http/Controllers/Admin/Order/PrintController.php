<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function index(Booking $booking)
    {
        $booking->load('package', 'payments');
        return view('admin.order.print-order', compact('booking'));
    }
}
