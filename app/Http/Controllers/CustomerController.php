<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function create()
    {
        $admin = Auth::user();
        return view('adminBackend.customers.create', compact('admin'));
    }

    public function store(Request $request)
{
    Log::info('Incoming Request:', $request->all());

    try {
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

        // Create customer
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $customerImagePath,
            'barcode_number' => $barcodeNumber,
            'barcode_image' => 'baackend_images/customer_barcodes/' . $barcodeNumber . '.png',
        ]);

        return response()->json([
            'success' => true,
            'customer' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
            ],
        ]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}

public function customerSearch(Request $request)
{
    $query = Customer::query();

    // Add search filters based on user input
    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('email', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('phone', 'LIKE', '%' . $searchTerm . '%')
              ->orWhere('barcode_number', 'LIKE', '%' . $searchTerm . '%');
        });
    }

    // Get the filtered customers and return them as JSON
    $customers = $query->get();

    return response()->json([
        'customers' => $customers
    ]);
}

    

}
