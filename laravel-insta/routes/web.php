<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');

    // Post
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}/show', [PostController::class, 'show'])->name('post.show');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{id}/update', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}/delete', [PostController::class, 'delete'])->name('post.delete');

    // Comment
    Route::post('/comment/{post_id}/store', [CommentController::class, 'store'])->name('comment.store');

});