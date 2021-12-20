<?php

use Olipacks\Mito\Commands\PublishScheduledPostsCommand;
use Olipacks\Mito\Models\Post;
use function Pest\Laravel\artisan;
use Symfony\Component\Console\Command\Command;

it('can publish a scheduled post', function () {
    $scheduledPost = Post::factory()->scheduled()->state([
        'published_at' => now()->subMinutes(5),
    ])->create();

    expect($scheduledPost->isScheduled())->toBeTrue();

    artisan(PublishScheduledPostsCommand::class)->assertExitCode(Command::SUCCESS);

    expect($scheduledPost->fresh()->isPublished())->toBeTrue();
});
