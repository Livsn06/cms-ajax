<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('admin.dashboard', $this->getDataReport());
    }



    private function getDataReport(): array
    {
        $bookingCount = Booking::count();
        $packageCount = Package::count();
        return [
            'bookingCount' => $bookingCount,
            'packageCount' => $packageCount
        ];
    }
}
