<?php

namespace Olipacks\Mito\Commands;

use Illuminate\Console\Command;
use Olipacks\Mito\Models\Post;

class PublishScheduledPostsCommand extends Command
{
    public $signature = 'mito:publish-scheduled-posts';

    public function handle(): void
    {
        Post::scheduled()
            ->where('published_at', '<=', now())
            ->get()
            ->each(function (Post $post) {
                $this->comment("Publishing post `{$post->title}`");

                $post->markAsPublished();
            });

        $this->info('All done');
    }
}
