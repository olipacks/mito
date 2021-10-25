<?php

use Illuminate\Support\Facades\Route;
use Mito\Http\Livewire\EditPost;
use Mito\Http\Livewire\ShowPosts;

Route::prefix('mito')
    ->middleware('web')
    ->group(function () {
        Route::redirect('/', '/mito/posts');
        Route::get('/posts', ShowPosts::class)->name('mito.posts.index');
        Route::get('/posts/{post}/edit', EditPost::class)->name('mito.posts.edit');
    });
