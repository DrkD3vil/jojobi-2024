<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid', 
        'type', 
        'amount', 
        'note', 
        'date', 
        'category', 
        'user_id', 
        'image' // Add the 'image' field
    ];
}
