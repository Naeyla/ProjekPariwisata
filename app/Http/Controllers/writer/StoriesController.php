<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class StoriesController extends Controller
{

    public function index()
    {
        $userId = session('user_id');
        if (!$userId) return redirect()->route('login');

        $drafts = Article::where('user_id', $userId)
            ->where('status', 'draft')
            ->latest()
            ->get();

        $scheduled = Article::where('user_id', $userId)
            ->where('status', 'scheduled')
            ->latest()
            ->get();

        $published = Article::where('user_id', $userId)
            ->where('status', 'published')
            ->latest()
            ->get();

        return view('writer.storiespagew', compact('drafts', 'scheduled', 'published'));
    }

    public function destroy($id)
    {
        $userId = session('user_id');

        $article = Article::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $article->delete();

        return back()->with('success', 'Article deleted successfully');
    }
}

