<?php

use Mito\Http\Livewire\ManagePostSettings;
use Mito\Models\Post;

beforeEach(function () {
    $this->draft = Post::factory()->draft()->create();
});

it('can schedule post', function () {

});

it('validates a required date', function () {

});

it('validates date', function () {

});
