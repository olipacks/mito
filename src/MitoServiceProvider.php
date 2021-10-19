<?php

namespace Mito;

use Illuminate\View\Compilers\BladeCompiler;
use Mito\Http\Livewire\ShowPosts;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Livewire\Livewire;
use Mito\Http\Livewire\CreatePost;
use Mito\Http\Livewire\EditPost;

class MitoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('mito')
            ->hasViews()
            ->hasRoute('web')
            ->hasMigration('create_mito_posts_table');
    }

    public function packageRegistered()
    {
        $this->app->afterResolving(BladeCompiler::class, function () {
            Livewire::component('mito::posts.show-posts', ShowPosts::class);
            Livewire::component('mito::posts.create-post', CreatePost::class);
            Livewire::component('mito::posts.edit-post', EditPost::class);
        });
    }
}
