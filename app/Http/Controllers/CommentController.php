<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required',
            'comment' => 'required'
        ]);

        Comment::create([
            'id_article' => $request->article_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::with('article')->findOrFail($id);
        $user = Auth::user();

        if (
            $user->role === 'admin' ||                      // admin
            $comment->user_id === $user->id ||              // owner komentar
            (
                $user->role === 'writer' &&
                $comment->article->user_id === $user->id    // writer pemilik artikel
            )
        ) {
            $comment->delete();
        }

        return back();
    }
}
