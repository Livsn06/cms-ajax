<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditPackageController extends Controller
{
    public function index(Package $package): \Illuminate\Contracts\View\View
    {
        return view('admin.package.edit-package', compact('package'));
    }

    public function update(Request $request, int $id)
    {
        $package = Package::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image_path')) {
            // Remove old image if it exists
            if ($package->image_path) {
                Storage::disk('public')->delete($package->image_path);
            }

            // Store new image
            $path = $request->file('image_path')->store('packages', 'public');
            $validated['image_path'] = $path;
        }

        $package->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image_path' => $path !== null ? $path : $package->image_path
        ]);

        return response()->json([
            'message' => 'Package updated successfully',
            'package' => $package
        ]);
    }
}
