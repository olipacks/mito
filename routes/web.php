<?php

use Illuminate\Support\Facades\Route;
use Mito\Http\Livewire\CreatePost;
use Mito\Http\Livewire\EditPost;
use Mito\Http\Livewire\ShowPosts;

Route::prefix('mito')
    ->middleware('web')
    ->group(function () {
        Route::get('/posts', ShowPosts::class)->name('mito.posts.index');
        Route::get('/posts/create', CreatePost::class)->name('mito.posts.create');
        Route::get('/posts/{post}/edit', EditPost::class)->name('mito.posts.edit');
    });
