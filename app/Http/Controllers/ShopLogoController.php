<?php

namespace App\Http\Controllers;

use App\Models\ShopLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ShopLogoController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        return view('adminBackend.shoplogos.create', compact('user')); // The view where the form will be displayed
    }

    public function store(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();
    
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'notes' => 'nullable|string',
        ]);
    
        // Handle image upload for shop_logos image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
    
            // Define the public backend_images path for shop_logos
            $shop_logosDirectory = public_path('baackend_images/shop_logos');
    
            // Ensure the directory exists
            if (!File::exists($shop_logosDirectory)) {
                File::makeDirectory($shop_logosDirectory, 0755, true); // Create the directory with permissions
            }
    
            // Move the file to the public backend_images folder
            $file->move($shop_logosDirectory, $filename);
    
            // Store the relative path in the database
            $imagePath = 'baackend_images/shop_logos/' . $filename;
        }
    
        // Create a new shop logo record in the database
        ShopLogo::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'image' => $imagePath, // Store the path to the uploaded image
            'uploaded_by' => $user->name, // Store the name of the user who uploaded the logo
            'notes' => $request->notes,
        ]);
    
        // Redirect back to the index page with a success message
        return redirect()->route('shop_logos.index')->with('success', 'Shop logo uploaded successfully!');
    }

    public function index()
    {
        $user = Auth::user();
        // Fetch all shop logos, ordered by the latest first
        $shopLogos = ShopLogo::latest()->paginate(10);

        return view('adminBackend.shoplogos.index', compact('shopLogos','user'));
    }

    // Show the details of a specific logo
    public function show($uuid)
    {
        $user = Auth::user();
        // Retrieve the shop logo by UUID
        $logo = ShopLogo::where('uuid', $uuid)->firstOrFail();

        // Return the 'show' view with the logo details
        return view('adminBackend.shopLogos.show', compact('logo', 'user'));
    }

    // Show the form for editing the specified logo
    public function edit($uuid)
    {
        $user = Auth::user();

        // Retrieve the shop logo by UUID
        $logo = ShopLogo::where('uuid', $uuid)->firstOrFail();

        // Return the 'edit' view with the logo details
        return view('adminBackend.shopLogos.edit', compact('logo','user'));
    }

    // Update the specified logo in the database
    public function update(Request $request, $uuid)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'notes' => 'nullable|string',
        ]);

        // Retrieve the shop logo by UUID
        $logo = ShopLogo::where('uuid', $uuid)->firstOrFail();

        // Update the logo details
        $logo->name = $request->name;
        $logo->notes = $request->notes;

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('baackend_images/shop_logos'), $filename);
            $logo->image = 'baackend_images/shop_logos/' . $filename;
        }

        // Save the updated logo
        $logo->save();

        // Redirect back to the shop logos index page with success message
        return redirect()->route('shop_logos.index')->with('success', 'Shop logo updated successfully!');
    }
}
