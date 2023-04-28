<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseTheme extends Model
{
    use HasFactory;
    protected $table = 'house_theme';
    protected $fillable = [
        'content',
        'image',
    ];
}
