<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'categoryid',
        'category_name', // updated to match the form field name
        'category_barcode',
        'category_barcode_image',
        'category_description', // updated to match the form field name
        'category_image', // updated to match the form field name
        'uuid',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->categoryid = self::generateUniqueIdentifier();
            if (!$category->uuid) {
                $category->uuid = (string) str::uuid(); // Generate UUID if not set
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
            $identifier = 'C' . strtoupper(Str::random(5));
        } while (self::where('categoryid', $identifier)->exists());

        return $identifier;
    }

    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'categoryid', 'categoryid');
    // }
}