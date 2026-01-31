<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'cover_image',
    ];

    // 🔗 RELATIONSHIPS

    // article ↔ user (multi-writer)
    public function users()
    {
        return $this->belongsToMany(User::class, 'article_user');
    }

    // article → comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
