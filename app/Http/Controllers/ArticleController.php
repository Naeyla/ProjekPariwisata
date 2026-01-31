<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(6);
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::with(['users', 'comments.user'])->findOrFail($id);
        return view('articles.show', compact('article'));
    }
}
