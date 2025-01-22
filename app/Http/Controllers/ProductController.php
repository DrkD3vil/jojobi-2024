<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ProductController extends Controller
{
    // Display a listing of all products
    public function index()
    {
        $user = Auth::user();
        $products = Product::paginate(10); // Paginate the products
        return view('adminBackend.products.index', compact('products', 'user'));
    }


// Check for products Expire date and Alart
// public function checkProductExpiry(Request $request) {
//     $user = Auth::user();
//     // Get current date and date 7 days from now
//     $currentDate = Carbon::now();
//     $sevenDaysFromNow = Carbon::now()->addDays(7);

//     // Query products based on expiry status
//     $expiredProducts = Product::where('expire_date', '<', $currentDate)
//                                 ->where('stock_quantity', '>', 0) // Skip out-of-stock products
//                                 ->get(); // Expired products
//     $todayExpiringProducts = Product::whereDate('expire_date', '=', $currentDate)
//                                      ->where('stock_quantity', '>', 0) // Skip out-of-stock products
//                                      ->get(); // Expiring today
//     $productsExpiringSoon = Product::whereBetween('expire_date', [$currentDate, $sevenDaysFromNow])
//                                     ->whereDate('expire_date', '>', $currentDate)
//                                     ->where('stock_quantity', '>', 0) // Skip out-of-stock products
//                                     ->get(); // Products expiring in the next 7 days

//     // Count of products expiring today and in the next 7 days
//     $expiringTodayCount = Product::whereDate('expire_date', '=', $currentDate)
//                                  ->where('stock_quantity', '>', 0)
//                                  ->count();
//     $expiringSoonCount = Product::whereBetween('expire_date', [$currentDate, $sevenDaysFromNow])
//                                 ->whereDate('expire_date', '>', $currentDate)
//                                 ->where('stock_quantity', '>', 0)
//                                 ->count();

//     $notificationCount = $expiringTodayCount + $expiringSoonCount;

//     // Pass this data to the view
//     return view('adminBackend.notifications.index', compact('expiredProducts', 'todayExpiringProducts', 'productsExpiringSoon', 'notificationCount', 'user'));
// }

public function checkProductExpiry(Request $request) {
    $user = Auth::user();
    
    // Get current date and date 7 days from now
    $currentDate = Carbon::now();
    $sevenDaysFromNow = Carbon::now()->addDays(7);

    // Query products based on expiry status
    $expiredProducts = Product::where('expire_date', '<', $currentDate)
                                ->where('stock_quantity', '>', 0) // Skip out-of-stock products
                                ->get(); // Expired products

    $todayExpiringProducts = Product::whereDate('expire_date', '=', $currentDate)
                                     ->where('stock_quantity', '>', 0) // Skip out-of-stock products
                                     ->get(); // Expiring today

    $productsExpiringSoon = Product::whereBetween('expire_date', [$currentDate, $sevenDaysFromNow])
                                   ->whereDate('expire_date', '>', $currentDate)
                                   ->where('stock_quantity', '>', 0) // Skip out-of-stock products
                                   ->get(); // Products expiring in the next 7 days

    // Count of products expiring today and in the next 7 days
    $expiringTodayCount = Product::whereDate('expire_date', '=', $currentDate)
                                 ->where('stock_quantity', '>', 0)
                                 ->count();
    $expiringSoonCount = Product::whereBetween('expire_date', [$currentDate, $sevenDaysFromNow])
                               ->whereDate('expire_date', '>', $currentDate)
                               ->where('stock_quantity', '>', 0)
                               ->count();
    

    $notificationCount = $expiringTodayCount + $expiringSoonCount;

    // Pass this data to the notification view
    return view('adminBackend.notifications.index', compact('expiredProducts', 'todayExpiringProducts', 'productsExpiringSoon', 'notificationCount', 'user'));
}


    // Show the form to create a new product
    public function create()
    {
        $user = Auth::user();
        // Fetch categories to populate the category select dropdown
        $categories = Category::all();
        $suppliers = Supplier::all(); // Fetch suppliers to populate the supplier select dropdown
        return view('adminBackend.products.add-product', compact('categories', 'suppliers', 'user'));
    }

    // Store a new product in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'original_price' => 'required|numeric',
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'discount_percentage' => 'nullable|numeric|max:100',
            'discounted_price' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'stock_quantity' => 'required|integer',
            'brand' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'product_type' => 'nullable|string',
            'manufacture_date' => 'nullable|date',
    'expire_date' => 'nullable|date|after_or_equal:manufacture_date',
            'weight' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            // Create a new Product instance
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->original_price = $request->original_price;
            $product->buy_price = $request->buy_price;
            $product->sell_price = $request->sell_price;
            $product->discount_percentage = $request->discount_percentage ?? 0;
            $product->discounted_price = $request->discounted_price ?? ($request->sell_price - ($request->sell_price * ($request->discount_percentage / 100)));
            $product->stock_quantity = $request->stock_quantity;
            $product->brand = $request->brand;
            $product->product_type = $request->product_type;
            $product->manufacture_date = $request->manufacture_date;
$product->expire_date = $request->expire_date;
            $product->weight = $request->weight;
            $product->length = $request->length;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->is_featured = $request->is_featured ?? false;
            $product->is_active = $request->is_active ?? true;

            // Fetch the category details
            $category = Category::find($validatedData['category_id']);
            if (!$category) {
                return redirect()->back()->withErrors(['category_id' => 'Invalid category selected.']);
            }

            // Fetch the category details
            $supplier = Supplier::find($validatedData['supplier_id']);
            if (!$supplier) {
                return redirect()->back()->withErrors(['supplier_id' => 'Invalid supplier selected.']);
            }


            // Assign category barcode details
            $product->category_barcode = $category->category_barcode;
            $product->category_barcode_image = $category->category_barcode_image;
            $product->supplier_name = $supplier->supplier_name;


            // Handle image upload for product image
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $productsDirectory = public_path('baackend_images/products');

                // Ensure the directory exists
                if (!File::exists($productsDirectory)) {
                    File::makeDirectory($productsDirectory, 0755, true);
                }

                $file->move($productsDirectory, $filename);
                $product->image = 'products/' . $filename;
            }

            // Generate a scannable barcode image
            $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
            $barcodeData = $request->product_barcode;

            // Generate barcode (Code 128)
            $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_CODE_128);

            // Save the barcode image
            $barcodeDirectory = public_path('baackend_images/products_barcodes');
            if (!File::exists($barcodeDirectory)) {
                File::makeDirectory($barcodeDirectory, 0755, true);
            }

            $barcodeFilename = time() . '_' . $barcodeData . '.png';
            $barcodePath = $barcodeDirectory . '/' . $barcodeFilename;
            file_put_contents($barcodePath, $barcodeImage);

            $product->product_barcode = $barcodeData;
            $product->product_barcode_image = 'products_barcodes/' . $barcodeFilename;

            // Generate UUID and unique product ID
            $product->uuid = (string) Str::uuid();
            $product->product_id = Product::generateUniqueIdentifier();
            $product->save();

            return redirect()->route('products.create')->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error adding product: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while adding the product.');
        }
    }

    // Display the form to edit a product
    public function edit($uuid)
    {
        $user = Auth::user();
        $product = Product::where('uuid', $uuid)->firstOrFail(); // Fetch the product to edit by UUID
        return view('adminBackend.products.edit', compact('product', 'user'));
    }


    // Update the product in the database

    public function update(Request $request, $uuid)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sell_price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image',
            'product_barcode' => 'required|string|unique:products,product_barcode,' . $uuid . ',uuid', // Validate the barcode is unique by UUID
        ]);

        try {
            // Fetch the product to update
            $product = Product::where('uuid', $uuid)->firstOrFail(); // Find the product by UUID

            // Update basic product details
            $product->name = $request->name;
            $product->description = $request->description;
            $product->sell_price = $request->sell_price;
            $product->stock_quantity = $request->stock_quantity;

            // Handle product image update
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($product->image && File::exists(public_path('baackend_images/' . $product->image))) {
                    File::delete(public_path('baackend_images/' . $product->image));
                }

                // Save the new image
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;

                $productsDirectory = public_path('baackend_images/products');
                if (!File::exists($productsDirectory)) {
                    File::makeDirectory($productsDirectory, 0755, true);
                }

                $file->move($productsDirectory, $filename);
                $product->image = 'products/' . $filename;
            }

            // Handle barcode update
            if ($product->product_barcode !== $request->product_barcode) {
                // Update the barcode field
                $product->product_barcode = $request->product_barcode;

                // Generate a new barcode image
                $generator = new BarcodeGeneratorPNG();
                $barcodeData = $request->product_barcode;

                $barcodeImage = $generator->getBarcode($barcodeData, BarcodeGeneratorPNG::TYPE_CODE_128);
                $barcodeDirectory = public_path('baackend_images/products_barcodes');

                if (!File::exists($barcodeDirectory)) {
                    File::makeDirectory($barcodeDirectory, 0755, true);
                }

                // Delete the old barcode image if it exists
                if ($product->product_barcode_image && File::exists(public_path('baackend_images/' . $product->product_barcode_image))) {
                    File::delete(public_path('baackend_images/' . $product->product_barcode_image));
                }

                $barcodeFilename = time() . '_' . $barcodeData . '.png';
                $barcodePath = $barcodeDirectory . '/' . $barcodeFilename;
                file_put_contents($barcodePath, $barcodeImage);

                // Store the new barcode image path
                $product->product_barcode_image = 'products_barcodes/' . $barcodeFilename;
            }

            // Save the updated product details
            $product->save();

            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            // Log the error and return an error message
            Log::error('Error updating product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the product.');
        }
    }

    // Delete a product from the database
    public function destroy($uuid)
    {
        try {
            // Fetch the product to delete
            $product = Product::where('uuid', $uuid)->firstOrFail(); // Find the product by UUID

            // Delete the product's image
            if ($product->image && File::exists(public_path('baackend_images/' . $product->image))) {
                File::delete(public_path('baackend_images/' . $product->image));
            }

            // Delete the product's barcode image
            if ($product->product_barcode_image && File::exists(public_path('baackend_images/' . $product->product_barcode_image))) {
                File::delete(public_path('baackend_images/' . $product->product_barcode_image));
            }

            // Delete the product
            $product->delete();

            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            // Log the error and return an error message
            Log::error('Error deleting product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the product.');
        }
    }

    // show product

    public function show($uuid)
    {
        try {
            // Authenticate the user
            $user = Auth::user();

            // Fetch the product by UUID
            $product = Product::where('uuid', $uuid)->firstOrFail();

            if (!$product) {
                // If no product found, log the error and redirect
                Log::error('Product with UUID ' . $uuid . ' not found.');
                return redirect()->route('products.index')->with('error', 'Product not found.');
            }

            // Find the category using the product's category ID
            $category = Category::find($product->category_id);

            // Return the view with the product details
            return view('adminBackend.products.show', compact('product', 'user', 'category'));
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error fetching product details: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }
    }

    // Preview PDF
    public function previewProductsPDF()
    {
        // Fetch all products
        $products = Product::all();

        // Add absolute image paths to each product and handle missing images
        try {
            $products->map(function ($product) {
                // Check if the product barcode image exists
                if (File::exists(public_path('baackend_images/' . $product->product_barcode_image))) {
                    $product->barcode_image_path = public_path('baackend_images/' . $product->product_barcode_image);
                } else {
                    $product->barcode_image_path = public_path('baackend_images/default_barcode.png'); // Fallback barcode image
                }

                // Check if the category barcode image exists
                if (File::exists(public_path('baackend_images/' . $product->category_barcode_image))) {
                    $product->category_barcode_image_path = public_path('baackend_images/' . $product->category_barcode_image);
                } else {
                    $product->category_barcode_image_path = public_path('baackend_images/default_barcode.png'); // Fallback barcode image
                }

                // Check if the product image exists
                if (File::exists(public_path('baackend_images/' . $product->image))) {
                    $product->image_path = public_path('baackend_images/' . $product->image);
                } else {
                    $product->image_path = public_path('baackend_images/default_product.png'); // Fallback product image
                }

                return $product;
            });

            // Load the PDF view and pass the updated products
            $pdf = PDF::loadView('adminBackend.products.pdf', compact('products'));

            // Render the PDF in the browser
            return $pdf->stream('products-preview.pdf');
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while generating the PDF.');
        }
    }

    // Export Excel file
    /**
     * Export products to Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportToExcel()
    {
        // File name for the exported Excel file
        $fileName = 'products_' . date('Y_m_d_His') . '.xlsx';

        // Return the download response
        return Excel::download(new ProductsExport, $fileName);
    }


    public function importFromExcel(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    try {
        Excel::import(new ProductsImport, $request->file('file'));
        Log::info('File uploaded: ' . $request->file('file')->getRealPath());

        return redirect()->route('products.index')
            ->with('success', 'Products imported successfully!');
    } catch (\Exception $e) {
        Log::error('Import failed: ' . $e->getMessage()); // Log the error for debugging
        dd($e->getMessage());
        return redirect()->back()
            ->with('error', 'There was an issue importing the file: ' . $e->getMessage());
    }
}



    public function downloadImportFormat()
    {
        return Excel::download(new ProductsExport, 'product_import_format.xlsx');
    }
}
