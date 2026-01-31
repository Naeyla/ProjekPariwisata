<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Models\Comment;


Route::get('/', function () {
    return view('landingpage');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/homepageuser', function () {
    return view('user.homepageu');
});

Route::get('/libraryuser', function () {
    return view('user.librarypageu');
});

Route::get('/homepagewriter', function () {
    return view('writer.homepagew');
});

Route::get('/librarywriter', function () {
    return view('writer.librarypagew');
});

Route::get('/storieswriter', function () {
    return view('writer.storiespagew');
});

Route::get('/homepageadmin', function () {
    return view('admin.homepagea');
});

Route::get('/libraryadmin', function () {
    return view('admin.librarypagea');
});

Route::get('/managementadmin', function () {

    $tab = request('tab', 'articles');

    $articles = Article::latest()->paginate(10);

    $commentsQuery = Comment::with(['user', 'article'])->latest();

    if (request('article_id')) {
        $commentsQuery->where('id_article', request('article_id'));
    }

    $comments = $commentsQuery->paginate(10)->withQueryString();

    $users = \App\Models\User::latest()->paginate(10);

    return view('admin.managementpagea', compact(
        'tab',
        'articles',
        'comments',
        'users'
    ));
});



