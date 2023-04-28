<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table = 'user_address';
    protected $fillable = [
        'address_line_1',
        'address_line_2',
        'city',
        'postal_code',
        'country',
        'telephone',
        'mobile',
        'email',
        'user_id',
    ];
}
