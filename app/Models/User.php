<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // admin / writer / user
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 🔗 RELATIONSHIPS

    // user ↔ article (many to many)
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_user');
    }

    // user → comment (one to many)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
