<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'slug',
        'blog_post',
        'featured_img',
        'status'
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
