<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class DeletePackageController extends Controller
{
    public function destroy(int $id)
    {
        $package = Package::find($id);
        $package->delete();
        return response()->json(['message' => 'Package deleted successfully']);
    }
}
