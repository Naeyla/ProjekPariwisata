<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('users')->latest()->paginate(10);
        return view('admin.managementpagea', compact('articles'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function update($id)
    {
        $article = Article::findOrFail($id);
        $article->update(request()->only('title', 'content', 'cover_image'));

        return redirect()->route('admin.articles.index');
    }

    public function destroy($id)
    {
        Article::findOrFail($id)->delete();
        return back();
    }
}
