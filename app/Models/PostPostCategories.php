<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPostCategories extends Model
{
    use HasFactory;
    protected $table = 'post_post_categories';
    protected $fillable = [
        'post_id',
        'post_category_id',
    ];
}
