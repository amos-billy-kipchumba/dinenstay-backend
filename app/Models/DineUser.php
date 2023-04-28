<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DineUser extends Model
{
    use HasFactory;
    protected $table = 'dineusers';
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'confirmed_email',
        'phone',
        'host_front_id',
        'host_back_id',
        'password',
        'user_type',
        'image',
        'online',
    ];
}
