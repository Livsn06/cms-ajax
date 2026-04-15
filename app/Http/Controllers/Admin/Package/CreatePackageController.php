<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

use function Symfony\Component\String\s;

class CreatePackageController extends Controller
{
    public function index()
    {
        return view('admin.package.create-package');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Rename and store
        $extension = $request->file('image_path')->getClientOriginalExtension();
        $renamedImage = time() . '.' . $extension;
        $path = $request->file('image_path')->storeAs('packages', $renamedImage, 'public');

        Package::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image_path' => $path
        ]);

        // RETURN JSON ONLY - No ->with() or session here
        return response()->json([
            'success' => true,
            'message' => 'Package created successfully'
        ]);
    }
}
