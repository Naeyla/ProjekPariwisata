<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::whereHas('users', function ($q) {
            $q->where('users.id', Auth::id());
        })->latest()->paginate(10);

        return view('writer.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('writer.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'cover_image' => 'nullable|string',
        ]);

        $article = Article::create($request->only('title', 'content', 'cover_image'));

        $article->users()->attach(Auth::id());

        return redirect()->route('writer.articles.index');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        abort_unless($article->users->contains(Auth::id()), 403);

        return view('writer.articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        abort_unless($article->users->contains(Auth::id()), 403);

        $article->update($request->only('title', 'content', 'cover_image'));

        return redirect()->route('writer.articles.index');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        abort_unless($article->users->contains(Auth::id()), 403);

        $article->delete();

        return back();
    }
}
