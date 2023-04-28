<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activeUsers extends Model
{
    use HasFactory;

    protected $table = 'active_users';
    protected $fillable = [
        'time',
        'email',
        'username',
        'month',
        'year',
        'longitude',
        'latitude',
        'user_id',
    ];
}
