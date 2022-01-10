<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mito_tags', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index('created_at');
        });

        Schema::create('mito_posts_tags', function (Blueprint $table) {
            $table->bigInteger('post_id');
            $table->bigInteger('tag_id');

            $table->unique(['post_id', 'tag_id']);
        });
    }
};
