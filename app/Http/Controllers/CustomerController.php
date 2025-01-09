<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\File;


class CustomerController extends Controller
{
    public function create()
    {
        $admin = Auth::user();
        return view('adminBackend.customers.create', compact('admin'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:customers',
        'phone' => 'required|string|unique:customers',
        'address' => 'required|string|max:500',
        'image' => 'nullable|image',
    ]);

    // Save the barcode image
    $barcodeDirectory = public_path('baackend_images/customer_barcodes');
    if (!File::exists($barcodeDirectory)) {
        File::makeDirectory($barcodeDirectory, 0755, true);
    }

    // Generate barcode number and image
    $barcodeNumber = 'CUST-' . time();
    $generator = new BarcodeGeneratorPNG();
    $barcodeImageContent = $generator->getBarcode($barcodeNumber, $generator::TYPE_CODE_128);
    $barcodeImagePath = $barcodeDirectory . '/' . $barcodeNumber . '.png';

    // Save barcode image to the barcode directory
    file_put_contents($barcodeImagePath, $barcodeImageContent);

    // Save the customer's image
    $customerImagePath = null;
    if ($request->hasFile('image')) {
        $customerImageDirectory = public_path('baackend_images/customers');
        if (!File::exists($customerImageDirectory)) {
            File::makeDirectory($customerImageDirectory, 0755, true);
        }
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move($customerImageDirectory, $imageName);
        $customerImagePath = 'baackend_images/customers/' . $imageName;
    }

    // Save customer data
    Customer::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'image' => $customerImagePath,
        'barcode_number' => $barcodeNumber,
        'barcode_image' => 'baackend_images/customer_barcodes/' . $barcodeNumber . '.png',
    ]);

    return redirect()->route('customers.create')->with('success', 'Customer added successfully!');
}


}

