<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory;

    // Define the fields that can be mass assigned
    protected $fillable = [
        'uuid',
        'product_id',
        'sku',
        'product_barcode',
        'category_barcode',
        'category_barcode_image',
        'name',
        'description',
        'original_price',
        'buy_price',
        'sell_price',
        'discount_percentage',
        'discounted_price',
        'image',
        'image_gallery',
        'category_id',
        'stock_quantity',
        'brand',
        'product_type',
        'weight',
        'length',
        'width',
        'height',
        'is_featured',
        'is_active',
    ];

    // Define the relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Automatically generate UUID and SKU
    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (!$product->uuid) {
                $product->uuid = (string) Str::uuid();  // Generate UUID
            }

            if (!$product->product_id) {
                $product->product_id = 'PROD-' . strtoupper(Str::random(8));  // Generate product ID
            }

            if (!$product->sku) {
                $product->sku = strtoupper(Str::random(8));  // Generate SKU
            }
        });
    }

    /**
     * Generate a unique identifier.
     *
     * @return string
     */
    public static function generateUniqueIdentifier()
    {
        do {
            $identifier = 'PROD-' . strtoupper(Str::random(8));
        } while (self::where('Product_id', $identifier)->exists());

        return $identifier;
    }

    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'categoryid', 'categoryid');
    // }

}
