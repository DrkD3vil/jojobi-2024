<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Import this trait
use Maatwebsite\Excel\Concerns\WithMapping; // For custom row mapping
use Maatwebsite\Excel\Facades\Excel;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::all();
    }

    public function downloadTemplate()
{
    // Generate the Excel template with headings
    return Excel::download(new ProductsExport, 'product_template.xlsx');
}

    /**
     * Map each product's data to a row.
     *
     * @param \App\Models\Product $product
     * @return array
     */
    public function map($product): array
    {
        return [
            $product->uuid,
            $product->product_id,
            $product->sku,
            $product->product_barcode,
            asset('baackend_images/' . $product->product_barcode_image),
            $product->category_barcode,
            asset('baackend_images/' . $product->category_barcode_image),
            $product->name,
            $product->description,
            $product->original_price,
            $product->buy_price,
            $product->sell_price,
            $product->discount_percentage,
            $product->discounted_price,
            asset('baackend_images/' . $product->image),
            $product->image_gallery,
            $product->category_id,
            $product->stock_quantity,
            $product->brand,
            $product->product_type,
            $product->weight,
            $product->length,
            $product->width,
            $product->height,
            $product->is_featured ? 'Yes' : 'No',
            $product->is_active ? 'Yes' : 'No',
        ];
    }

    /**
     * Define headings for the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'UUID',
            'Product ID',
            'SKU',
            'Product Barcode',
            'Product Barcode Image',
            'Category Barcode',
            'Category Barcode Image',
            'Name',
            'Description',
            'Original Price',
            'Buy Price',
            'Sell Price',
            'Discount Percentage',
            'Discounted Price',
            'Product Image',
            'Image Gallery',
            'Category ID',
            'Stock Quantity',
            'Brand',
            'Product Type',
            'Weight',
            'Length',
            'Width',
            'Height',
            'Is Featured',
            'Is Active',
        ];
    }
}
