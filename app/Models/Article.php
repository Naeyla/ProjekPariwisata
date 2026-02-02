<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'cover_image',
        'status',
        'scheduled_at',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'article_user');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_article');
    }

    public function likes()
    {
        return $this->belongsToMany(\App\Models\User::class, 'article_likes', 'article_id', 'user_id')->withTimestamps();
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_saved_articles', 'article_id', 'user_id')->withTimestamps();
    }
}
