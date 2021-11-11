<?php

namespace Mito\Commands;

use Illuminate\Console\Command;
use Mito\Models\Post;

class PublishScheduledPostsCommand extends Command
{
    public $signature = 'mito:publish-scheduled-posts';

    public function handle()
    {
        Post::scheduled()
            ->whereDate('published_at', '<=', now())
            ->get()
            ->each(function (Post $post) {
                $this->comment("Publishing post `{$post->title}`");

                $post->markAsPublished();
            });

        $this->info('All done');
    }
}
