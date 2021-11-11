<?php

use Mito\Commands\PublishScheduledPostsCommand;
use Mito\Models\Post;
use Symfony\Component\Console\Command\Command;
use function Pest\Laravel\artisan;

it('can publish a scheduled post', function () {
    $scheduledPost = Post::factory()->scheduled()->state([
        'published_at' => now()->subMinutes(5),
    ])->create();

    expect($scheduledPost->isScheduled())->toBeTrue();

    artisan(PublishScheduledPostsCommand::class)->assertExitCode(Command::SUCCESS);

    expect($scheduledPost->fresh()->isPublished())->toBeTrue();
});
