<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopTheme extends Model
{
    use HasFactory;
    protected $table = 'shop_theme';
    protected $fillable = [
        'content',
        'image',
    ];
}
