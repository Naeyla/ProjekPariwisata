<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Models\Comment;


Route::get('/', function () {
    return view('landingpage');
});

Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'store'])->name('register.store');

Route::get('/homepageuser', function () {
    $hiddenIds = session('hidden_article_ids', []);
    $userId = session('user_id');
    $articles = Article::where('status', 'published')
        ->whereNotIn('id', $hiddenIds)
        ->withCount(['likes', 'comments'])
        ->latest()
        ->get();
    $savedArticleIds = $userId ? (\App\Models\User::find($userId)?->savedArticles()->pluck('articles.id')->toArray() ?? []) : [];
    return view('user.homepageu', compact('articles', 'savedArticleIds'));
})->name('user.homepage');

Route::get('/libraryuser', function () {
    $userId = session('user_id');
    $savedArticles = $userId ? \App\Models\User::find($userId)?->savedArticles()->where('status', 'published')->withCount(['likes', 'comments'])->orderByPivot('created_at', 'desc')->get() : collect();
    return view('user.librarypageu', compact('savedArticles'));
});

Route::get('/homepagewriter', function () {
    $hiddenIds = session('hidden_article_ids', []);
    $userId = session('user_id');
    $articles = Article::where('status', 'published')
        ->whereNotIn('id', $hiddenIds)
        ->withCount(['likes', 'comments'])
        ->latest()
        ->get();
    $savedArticleIds = $userId ? (\App\Models\User::find($userId)?->savedArticles()->pluck('articles.id')->toArray() ?? []) : [];
    return view('writer.homepagew', compact('articles', 'savedArticleIds'));
})->name('writer.homepage');

Route::get('/librarywriter', function () {
    $userId = session('user_id');
    $savedArticles = $userId ? \App\Models\User::find($userId)?->savedArticles()->where('status', 'published')->withCount(['likes', 'comments'])->orderByPivot('created_at', 'desc')->get() : collect();
    return view('writer.librarypagew', compact('savedArticles'));
});

Route::get('/storieswriter', [App\Http\Controllers\Writer\StoriesController::class, 'index']);
Route::delete('/writer/stories/{id}', [App\Http\Controllers\Writer\StoriesController::class, 'destroy']);

Route::get('/writer/write', [App\Http\Controllers\Writer\WriteController::class, 'index']);
Route::post('/writer/write/save-draft', [App\Http\Controllers\Writer\WriteController::class, 'saveDraft']);
Route::match(['put', 'post'], '/writer/write/update-draft/{id}', [App\Http\Controllers\Writer\WriteController::class, 'updateDraft']);
Route::post('/writer/write/publish', [App\Http\Controllers\Writer\WriteController::class, 'publish']);
Route::post('/writer/write/upload-image', [App\Http\Controllers\Writer\WriteController::class, 'uploadImage']);
Route::post('/writer/write/upload-video', [App\Http\Controllers\Writer\WriteController::class, 'uploadVideo']);

Route::get('/homepageadmin', function () {
    $hiddenIds = session('hidden_article_ids', []);
    $userId = session('user_id');
    $articles = Article::where('status', 'published')
        ->whereNotIn('id', $hiddenIds)
        ->withCount(['likes', 'comments'])
        ->latest()
        ->get();
    $savedArticleIds = $userId ? (\App\Models\User::find($userId)?->savedArticles()->pluck('articles.id')->toArray() ?? []) : [];
    return view('admin.homepagea', compact('articles', 'savedArticleIds'));
})->name('admin.homepage');

Route::get('/libraryadmin', function () {
    $userId = session('user_id');
    $savedArticles = $userId ? \App\Models\User::find($userId)?->savedArticles()->where('status', 'published')->withCount(['likes', 'comments'])->orderByPivot('created_at', 'desc')->get() : collect();
    return view('admin.librarypagea', compact('savedArticles'));
});

Route::get('/managementadmin', function () {

    $tab = request('tab', 'articles');

    $articles = Article::latest()->paginate(10);

    $commentsQuery = Comment::with(['user', 'article'])->latest();

    if (request('article_id')) {
        $commentsQuery->where('id_article', request('article_id'));
    }

    $comments = $commentsQuery->paginate(10)->withQueryString();

    $usersQuery = \App\Models\User::latest();
    if (request('role')) {
        $usersQuery->where('role', request('role'));
    }
    $users = $usersQuery->paginate(10)->withQueryString();

    return view('admin.managementpagea', compact(
        'tab',
        'articles',
        'comments',
        'users'
    ));
});

Route::delete('/managementadmin/article/{article}', function (Article $article) {
    $article->delete();
    return redirect()->back()->with('success', 'Artikel berhasil dihapus.');
})->name('managementadmin.article.destroy');

Route::delete('/managementadmin/user/{user}', function (\App\Models\User $user) {
    if ($user->role === 'admin') {
        return redirect()->back()->with('error', 'Admin tidak dapat dihapus.');
    }
    $user->delete();
    return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
})->name('managementadmin.user.destroy');

Route::get('/article/{article}', [App\Http\Controllers\ArticleController::class, 'show'])->name('article.show');
Route::post('/article/{article}/like', [App\Http\Controllers\ArticleController::class, 'toggleLike'])->name('article.like');
Route::post('/article/{article}/comment', [App\Http\Controllers\ArticleController::class, 'storeComment'])->name('article.comment');
Route::post('/article/{article}/save', [App\Http\Controllers\ArticleController::class, 'toggleSave'])->name('article.save');
Route::post('/article/{article}/hide', [App\Http\Controllers\ArticleController::class, 'hide'])->name('article.hide');



