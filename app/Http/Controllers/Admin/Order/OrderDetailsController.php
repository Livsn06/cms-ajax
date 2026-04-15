<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    public function index(Booking $booking)
    {
        $booking->load('package');
        return view('admin.order.order-details', compact('booking'));
    }
}
