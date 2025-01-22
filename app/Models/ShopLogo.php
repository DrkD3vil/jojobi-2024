<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopLogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'image',
        'uploaded_by',
        'notes',
    ];

    protected $casts = [
        'uuid' => 'string',
    ];
}
