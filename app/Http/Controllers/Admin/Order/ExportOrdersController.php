<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportOrdersController extends Controller
{
    public function export()
    {
        $bookings = Booking::with('package')->get();

        $date = date('Y-m-d');
        $fileName = 'bookings_report_' . $date . '.csv';
        return (new FastExcel($bookings))->download($fileName, function ($booking) {
            return [
                'Booking ID'    => $booking->id,
                'Customer Name' => $booking->fullname,
                'Phone Number'  => $booking->phone,
                'Event Date'    => $booking->event_date,
                'Package Used'  => $booking->package->name ?? 'N/A',
                'Total Price'   => '₱' . number_format($booking->total_price, 2),
                'Status'        => ucfirst($booking->status),
                'Created At'    => $booking->created_at->format('Y-m-d H:i'),
            ];
        });
    }
}
