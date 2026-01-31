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
            'article_id' => $request->article_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::with('article.users')->findOrFail($id);
        $user = Auth::user();

        if (
            $user->role === 'admin' ||
            $comment->user_id === $user->id ||
            $comment->article->users->contains($user->id)
        ) {
            $comment->delete();
        }

        return back();
    }
}
