<?php

namespace Mito;

use Illuminate\View\Compilers\BladeCompiler;
use Livewire\LivewireManager;
use Mito\Commands\PublishScheduledPostsCommand;
use Mito\Components\Markdown;
use Mito\Http\Livewire\DeletePost;
use Mito\Http\Livewire\EditPost;
use Mito\Http\Livewire\ManagePostSettings;
use Mito\Http\Livewire\ShowPosts;
use Mito\Http\Livewire\UpdatePostStatusModal;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MitoServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('mito')
            ->hasViews()
            ->hasViewComponent('mito', Markdown::class)
            ->hasAssets()
            ->hasRoute('web')
            ->hasMigration('create_mito_posts_table')
            ->hasCommand(PublishScheduledPostsCommand::class);
    }

    public function packageRegistered(): void
    {
        $this->app->afterResolving(BladeCompiler::class, function () {
            $this->registerLivewireComponents();
        });
    }

    protected function registerLivewireComponents(): void
    {
        app(LivewireManager::class)->component('mito::posts.edit-post', EditPost::class);
        app(LivewireManager::class)->component('mito::posts.show-post', ShowPosts::class);
        app(LivewireManager::class)->component('mito::posts.manage-post-settings', ManagePostSettings::class);
        app(LivewireManager::class)->component('mito::posts.delete-post', DeletePost::class);
        app(LivewireManager::class)->component('mito::posts.update-post-status-modal', UpdatePostStatusModal::class);
    }
}
