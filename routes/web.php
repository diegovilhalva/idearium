<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/@{user:username}',[PublicProfileController::class,'show'])->name('profile.show');
Route::get('/posts/{post:id}/comments', [CommentController::class, 'index'])->name('comments.show');
Route::get('/', [PostController::class, 'index'])->name('dashboard');
Route::get('/@{username}/{post:slug}',[PostController::class,'show'])->name('post.show');
Route::get('/category/{slug}',[PostController::class,'category'])->name('post.byCategory');
Route::get('/search', [PostController::class, 'search'])->name('post.search');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::post('/follow/{user:username}',[FollowerController::class,'followUnfollow'])->name('follow');
    Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('post.like');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('post.update');
    Route::get('/my-posts', [PostController::class, 'userPosts'])->name('post.mine');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
