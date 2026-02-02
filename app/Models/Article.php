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
        return $this->hasMany(Comment::class);
    }
}
