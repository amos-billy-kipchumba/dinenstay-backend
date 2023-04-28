<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    protected $table = 'post_comment';
    protected $fillable = [
        'title',
        'published_at',
        'post_id',
        'user_id',
    ];
}
