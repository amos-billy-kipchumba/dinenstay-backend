<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    use HasFactory;
    protected $table = 'user_payment';
    protected $fillable = [
        'payment_type',
        'provider',
        'account_no',
        'expiry_date',
        'user_id',
    ];
}
