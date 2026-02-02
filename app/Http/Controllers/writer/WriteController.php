<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WriteController extends Controller
{
    public function index()
    {
        return view('writer.writepage');
    }

    public function saveDraft(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|string',
        ]);

        $userId = session('user_id');
        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $article = Article::create([
            'user_id' => $userId,
            'title' => $request->title ?? '',
            'content' => $request->content ?? '',
            'cover_image' => $request->cover_image,
            'status' => 'draft',
        ]);

        return response()->json([
            'success' => true,
            'article_id' => $article->id,
            'message' => 'Draft saved successfully'
        ]);
    }

    public function updateDraft(Request $request, $id)
    {
        $userId = session('user_id');
        $article = Article::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $article->update([
            'title' => $request->title ?? '',
            'content' => $request->content ?? '',
            'cover_image' => $request->cover_image,
            'status' => 'draft',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Draft updated successfully'
        ]);
    }

    public function publish(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'publish_type' => 'required|in:now,scheduled',
            'scheduled_at' => 'required_if:publish_type,scheduled|date|nullable',
        ]);

        $userId = session('user_id');

        $article = Article::create([
            'user_id' => $userId,
            'title' => $request->title,
            'content' => $request->content,
            'cover_image' => $request->cover_image,
            'status' => $request->publish_type === 'scheduled' ? 'scheduled' : 'published',
            'scheduled_at' => $request->publish_type === 'scheduled'
                ? $request->scheduled_at
                : null,
        ]);

        return response()->json([
            'success' => true,
            'article_id' => $article->id,
            'message' => 'Article saved successfully'
        ]);
    }


    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image')->store('images/articles', 'public');

        return response()->json([
            'success' => true,
            'url' => asset('storage/' . $path)
        ]);
    }


    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,avi,mov,wmv|max:10240',
        ]);

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos/articles', 'public');
            return response()->json([
                'success' => true,
                'url' => Storage::url($path)
            ]);
        }

        return response()->json(['error' => 'No video uploaded'], 400);
    }
}
