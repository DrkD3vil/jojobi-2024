<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //
    public function generateBarcode()
    {
        do {
            $barcode = random_int(1000000000, 9999999999);
            $existsInCategories = Category::where('category_barcode', $barcode)->exists();
            $existsInProducts = Product::where('product_barcode', $barcode)->exists(); // Adjust field name if necessary
        } while ($existsInCategories || $existsInProducts);

        return response()->json(['barcode' => $barcode]);
    }

    public function validateBarcode(Request $request)
    {
        $barcode = $request->input('barcode');

        // Check for barcode existence in Category and Product tables
        $existsInCategories = Category::where('category_barcode', $barcode)->exists();
        $existsInProducts = Product::where('product_barcode', $barcode)->exists();

        // Combine results for a comprehensive validation
        $isUnique = !$existsInCategories && !$existsInProducts;

        return response()->json([
            'valid' => $isUnique,
            'message' => $isUnique ? 'Barcode is valid and unique.' : 'Barcode already exists in the system.'
        ]);
    }
}
