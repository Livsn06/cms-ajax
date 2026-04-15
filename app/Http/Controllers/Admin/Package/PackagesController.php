<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $packages = Package::all();
        return view('admin.package.packages', compact('packages'));
    }
}
