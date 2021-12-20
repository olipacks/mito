<?php

use Olipacks\Mito\Tests\TestCase;

uses(TestCase::class)
    ->beforeEach(fn () => ray()->clearScreen())
    ->in(__DIR__);
