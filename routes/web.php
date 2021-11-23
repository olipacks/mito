<?php

use Illuminate\Support\Facades\Route;
use Mito\Http\Livewire\EditPost;
use Mito\Http\Livewire\FeatureImage;
use Mito\Http\Livewire\ShowPosts;
use Mito\Http\Middleware\EnsureUserIsAuthorized;

Route::prefix('mito')
    ->middleware(['web', EnsureUserIsAuthorized::class])
    ->group(function () {
        Route::redirect('/', '/mito/posts');
        Route::get('/posts', ShowPosts::class)->name('mito.posts.index');
        Route::get('/posts/{post}/edit', EditPost::class)->name('mito.posts.edit');

        Route::get('/concept/feature-image', FeatureImage::class);
    });
