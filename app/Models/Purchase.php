<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchase';
    protected $fillable = [
        'first_name',
        'last_name',
        'country',
        'street_address',
        'street_address2',
        'city',
        'state',
        'zip_code',

        'total_price',
        'paid',
        'mpesa_message',
        'bank_message',
        'purchase_phone',

        'shipped',
        'received',

        'user_id',
        'pay_type',

        'mpesa_id',
        'bank_id',
        'seller_id'

    ];
}
