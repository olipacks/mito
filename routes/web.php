<?php

use Illuminate\Support\Facades\Route;
use Olipacks\Mito\Http\Livewire\EditPost;
use Olipacks\Mito\Http\Livewire\ShowPosts;
use Olipacks\Mito\Http\Middleware\EnsureUserIsAuthorized;

Route::prefix('mito')
    ->middleware(['web', EnsureUserIsAuthorized::class])
    ->group(function () {
        Route::redirect('/', '/mito/posts');
        Route::get('/posts', ShowPosts::class)->name('mito.posts.index');
        Route::get('/posts/{post}/edit', EditPost::class)->name('mito.posts.edit');
    });
