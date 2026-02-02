<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        if ($article->status !== 'published') {
            abort(404);
        }
        $article->load(['comments' => fn($q) => $q->with('user')->latest()]);
        $likesCount = $article->likes()->count();
        $userId = session('user_id');
        $userLiked = $userId ? $article->likes()->where('user_id', $userId)->exists() : false;

        return view('article.detail', compact('article', 'likesCount', 'userLiked'));
    }

    public function toggleLike(Request $request, Article $article)
    {
        if ($article->status !== 'published') {
            return redirect()->back();
        }
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->with('message', 'Login untuk menyukai artikel.');
        }
        $liked = $article->likes()->where('user_id', $userId)->exists();
        if ($liked) {
            $article->likes()->detach($userId);
        } else {
            $article->likes()->attach($userId);
        }
        return redirect()->back();
    }

    public function storeComment(Request $request, Article $article)
    {
        if ($article->status !== 'published') {
            return redirect()->back();
        }
        $request->validate([
            'comment' => 'required|string|max:2000',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->with('message', 'Login untuk berkomentar.');
        }
        Comment::create([
            'id_article' => $article->id,
            'user_id' => $userId,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);
        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function toggleSave(Request $request, Article $article)
    {
        if ($article->status !== 'published') {
            return redirect()->back();
        }
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login')->with('message', 'Login untuk menyimpan artikel.');
        }
        $user = \App\Models\User::find($userId);
        if ($user->savedArticles()->where('article_id', $article->id)->exists()) {
            $user->savedArticles()->detach($article->id);
        } else {
            $user->savedArticles()->attach($article->id);
        }
        return redirect()->back();
    }

    public function hide(Request $request, Article $article)
    {
        $hidden = session('hidden_article_ids', []);
        if (!in_array($article->id, $hidden)) {
            $hidden[] = $article->id;
            session(['hidden_article_ids' => $hidden]);
        }
        return redirect()->back();
    }
}
