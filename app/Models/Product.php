<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_name',
        'user_id',
        'quantity',
        'discount',
        'image_one',
        'image_two',
        'new_old',
        'subcategory_name',
    ];
}
