<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

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

});