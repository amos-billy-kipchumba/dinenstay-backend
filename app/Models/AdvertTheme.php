<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertTheme extends Model
{
    use HasFactory;
    protected $table = 'advert_theme';
    protected $fillable = [
        'content',
        'image',
        'link'
    ];
}
