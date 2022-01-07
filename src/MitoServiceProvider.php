<?php

namespace Olipacks\Mito;

use Illuminate\View\Compilers\BladeCompiler;
use Livewire\LivewireManager;
use Olipacks\Mito\Commands\PublishScheduledPostsCommand;
use Olipacks\Mito\Components\Markdown;
use Olipacks\Mito\Http\Livewire\DeletePost;
use Olipacks\Mito\Http\Livewire\EditPost;
use Olipacks\Mito\Http\Livewire\ManagePostSettings;
use Olipacks\Mito\Http\Livewire\ShowPosts;
use Olipacks\Mito\Http\Livewire\UpdatePostStatusModal;
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
            ->hasMigration('create_mito_tags_tables')
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
