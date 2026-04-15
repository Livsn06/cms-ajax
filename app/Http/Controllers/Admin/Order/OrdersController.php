<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $bookings = Booking::with('package')->orderBy('created_at', 'desc')->get();
        return view('admin.order.orders', compact('bookings'));
    }
}
