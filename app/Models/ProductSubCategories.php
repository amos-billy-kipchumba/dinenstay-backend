<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategories extends Model
{
    use HasFactory;
    protected $table = 'product_sub_categories';
    protected $fillable = [
        'name',
        'category_id',
    ];
}
