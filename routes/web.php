<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\search;

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About', 'Owner' => 'Syauqillah Hadie Ahsana']);
});

Route::get('/blog', function () {
    return view('blog', ['title' => 'Blog', 'posts' => Post::filter(request(['search','category', 'author']))->latest()->get()]);
});

Route::get('/post/{post:slug}', function (Post $post) {
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

Route::get('/authors/{user:username}', function (User $user) {
    // $posts = $user->posts->load('category','author');
    return view('blog', ['title' => count($user->posts) . ' Articles by ' . $user->name, 'posts' =>$user->posts]);
});

Route::get('/categories/{category:slug}', function (Category $category) {
    // $posts = $category->posts->load('category','author');
    return view('blog', ['title' => count($category->posts) . ' Articles in ' . $category->name, 'posts' => $category->posts]);
});
