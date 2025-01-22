<?php
namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        try {
            // Log the incoming row data for debugging
            Log::info('Processing row: ' . json_encode($row));

            // Ensure category exists in the database
            $category = Category::find($row['category_id']);
            if (!$category) {
                Log::error('Invalid category ID in row: ' . json_encode($row));
                return null; // Skip this row if category is invalid
            }

            // Determine the barcode to use: use given barcode or generate new one
            $barcodeData = $this->getBarcode($row['product_barcode']); // Check if barcode exists, otherwise generate

            // Generate barcode image based on barcode data
            $barcodeImage = $this->generateBarcodeImage($barcodeData);

            // Calculate discounted price based on percentage
            $discountedPrice = $row['discount_percentage'] > 0 
                ? $row['sell_price'] - ($row['sell_price'] * $row['discount_percentage'] / 100)
                : $row['sell_price'];

            // Log calculated discounted price for debugging
            Log::info('Calculated discounted price for product: ' . $discountedPrice);

            // Create new Product instance and assign values
            $product = new Product([
                'product_barcode' => $barcodeData, // Unique barcode
                'name' => $row['name'],
                'description' => $row['description'],
                'original_price' => $row['original_price'],
                'buy_price' => $row['buy_price'],
                'sell_price' => $row['sell_price'],
                'discount_percentage' => $row['discount_percentage'] ?? 0,
                'discounted_price' => $discountedPrice,
                'category_id' => $category->id,
                'category_barcode' => $category->category_barcode,
                'category_barcode_image' => $category->category_barcode_image,
                'stock_quantity' => $row['stock_quantity'],
                'brand' => $row['brand'],
                'product_type' => $row['product_type'],
                'weight' => $row['weight'],
                'length' => $row['length'],
                'width' => $row['width'],
                'height' => $row['height'],
                'is_featured' => $row['is_featured'] === 'Yes',
                'is_active' => $row['is_active'] === 'Yes',
                'uuid' => (string) Str::uuid(),
                'product_id' => Product::generateUniqueIdentifier(), // Assuming a custom function to generate unique product ID
                'product_barcode_image' => $barcodeImage,
            ]);

            // Log product data before saving
            Log::info('Saving product: ' . json_encode($product));

            // Save the product to the database
            $product->save();

            return $product;
        } catch (\Exception $e) {
            // Log error for debugging
            Log::error('Error processing row: ' . json_encode($row) . ' - ' . $e->getMessage());
            return null; // Skip invalid rows
        }
    }

    // Check if barcode is provided, otherwise generate a unique one
    private function getBarcode($barcodeData)
    {
        // If barcode is empty, generate a unique barcode
        if (empty($barcodeData)) {
            $barcodeData = Str::random(12); // Generate a unique barcode
        }

        // Ensure barcode is unique by checking if it already exists
        while (Product::where('product_barcode', $barcodeData)->exists()) {
            $barcodeData = Str::random(12); // Regenerate barcode if it already exists
        }

        return $barcodeData;
    }

    // Generate barcode image
    private function generateBarcodeImage($barcodeData)
    {
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($barcodeData, $generator::TYPE_CODE_128);

        // Save barcode image to the server
        $barcodeDirectory = public_path('baackend_images/products_barcodes');
        if (!File::exists($barcodeDirectory)) {
            File::makeDirectory($barcodeDirectory, 0755, true);
        }

        $barcodeFilename = time() . '_' . $barcodeData . '.png';
        $barcodePath = $barcodeDirectory . '/' . $barcodeFilename;
        file_put_contents($barcodePath, $barcodeImage);

        return 'products_barcodes/' . $barcodeFilename;
    }
}

