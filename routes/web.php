<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my-posts'); // Show only the authenticated user's posts
    Route::post('posts', [PostController::class, 'store'])->name('posts.store'); // This should be POST for storing
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create'); // This should be GET
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // DELETE for destroying posts
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store'); //Comment storing for post owner
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy'); //DELETE for destroying comments
});

Route::middleware('auth')->group(function () {
    Route::get('/comment', [CommentController::class, 'index'])->name('posts.comment');
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});


require __DIR__.'/auth.php';
