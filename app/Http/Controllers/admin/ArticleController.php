<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('users')->latest()->paginate(10);
        return view('admin.managementpagea', compact('articles'));
    }

    public function edit($id)
    {
    
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $article->update($request->only('title', 'content'));

        // Redirect kembali ke tab articles
        return redirect()->route('managementadmin', ['tab' => 'articles'])
                 ->with('success', 'Artikel berhasil diupdate!');
    }

    public function destroy($id)
    {
        Article::findOrFail($id)->delete();
        return back();
    }
}
